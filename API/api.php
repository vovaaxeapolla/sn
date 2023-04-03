<?php
$api = new Router('/api');
$api->get('/theme', [], function () {
    if (isset($_GET['theme'])) {
        switch ($_GET['theme']) {
            case 'dark':
                $_SESSION['theme'] = 'dark';
                break;
            case 'light':
                $_SESSION['theme'] = 'light';
                break;
            default:
                $_SESSION['theme'] = 'light';
                break;
        }
    }
});

$api->get('/posts/comment/:id', [$authMiddleware], function ($params) {
    $id = $params['id'];
    $result = DB::request("
    SELECT text, date, nickname, avatar 
    FROM comments 
    JOIN accounts 
    ON account_id = accounts.id 
    WHERE post_id = '$id'
    ");
    header('Content-type: application/json');
    echo json_encode($result);
});

$api->delete('/posts/:id', [$authMiddleware], function ($params) {
    $id = $params['id'];
    $result = DB::request("SELECT * FROM posts WHERE id = '$id'");
    if (!empty($result)) {
        $post = $result[0];
        if ($post['account_id'] === $_SESSION['user']['id']) {
            $result = DB::request("
            SELECT GROUP_CONCAT(image_path SEPARATOR ' ') as images 
            FROM images 
            WHERE post_id = '$id'");
            $images = explode(' ', $result[0]['images']);
            foreach ($images as $i) {
                unlink('images/posts/' . $i);
            }
            DB::request("DELETE FROM comments WHERE post_id = '$id'");
            DB::request("DELETE FROM images WHERE post_id = '$id'");
            DB::request("DELETE FROM posts WHERE id = '$id'");
        }
    }
});

$api->post('/posts/comment', [$authMiddleware], function () {
    $input = json_decode(file_get_contents("php://input"), true);
    DB::insert(
        'comments',
        ['post_id', 'account_id', 'text', 'date'],
        [[$input['id'], $_SESSION['user']['id'], $input['text'], time()]]
    );
});

$api->get('/posts/@:nickname', [$authMiddleware], function ($params) {
    $oneReqPosts = 5;
    $offset = ($_GET['page'] - 1) * $oneReqPosts;
    $result = '';
    $nickname = $params['nickname'];
    $result = DB::request(
        "SELECT distinct posts.id, posts.date, posts.text, (SELECT GROUP_CONCAT(image_path SEPARATOR ' ') 
                FROM images 
                WHERE post_id = posts.id) as images, nickname, avatar
                FROM posts 
                JOIN accounts 
                ON account_id = accounts.id
                WHERE nickname = '$nickname'
                ORDER BY  posts.date DESC
                LIMIT $oneReqPosts
                OFFSET $offset"
    );
    header('Content-type: application/json');
    echo json_encode($result);
});

$api->get('/posts/all', [$authMiddleware], function () {
    $oneReqPosts = 5;
    $offset = ($_GET['page'] - 1) * $oneReqPosts;
    $result = '';
    $result = DB::request(
        "SELECT distinct posts.id, posts.date, posts.text, (SELECT GROUP_CONCAT(image_path SEPARATOR ' ') 
                FROM images 
                WHERE post_id = posts.id) as images, nickname, avatar
                FROM posts 
                JOIN accounts 
                ON account_id = accounts.id
                ORDER BY  posts.date DESC
                LIMIT $oneReqPosts
                OFFSET $offset"
    );

    header('Content-type: application/json');
    echo json_encode($result);
});

$api->get('/images/:type/:name', [$authMiddleware], function ($params) {
    $imagePath = "images/" . $params['type'] . '/' . $params['name'];
    $image = file_get_contents($imagePath);
    header('Content-type: image/png');
    echo $image;
});

$api->delete('/avatar', [$authMiddleware], function () {
    if ($_SESSION['user']['avatar'] !== 'noavatar.png') {
        unlink('images/avatars/' . $_SESSION['user']['avatar']);
    }
    $nickname = $_SESSION['user']['nickname'];
    $_SESSION['user']['avatar'] = 'noavatar.png';
    DB::request("UPDATE accounts SET avatar = 'noavatar.png' WHERE nickname = '$nickname'");
});

$api->post('/avatar', [$authMiddleware], function () {
    header('Content-type: application/json');
    try {
        if (!empty($_FILES)) {
            if ($_SESSION['user']['avatar'] !== 'noavatar.png')
                unlink('images/avatars/' . $_SESSION['user']['avatar']);
            if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["avatar"]["tmp_name"];
                $temp = explode('.', $_FILES["avatar"]["name"]);
                $name = uniqid('image', true) . '.' . end($temp);
                move_uploaded_file($tmp_name, "images/avatars/$name");
                $nickname = $_SESSION['user']['nickname'];
                DB::request("UPDATE accounts SET avatar = '$name' WHERE nickname = '$nickname'");
                $_SESSION['user']['avatar'] = $name;
                echo json_encode($name);
            }
        }
    } catch (Throwable $th) {
        $error = "Серверная ошибка";
        echo json_encode($error);
    }
});

$api->get('/stats/:nickname', [$authMiddleware], function ($params) {
    $nickname = $params['nickname'];
    $result = DB::request("
    SELECT COUNT(*) AS 'posts_number',

    (
    SELECT COUNT(*) 
    FROM accounts 
    JOIN followers
    ON accounts.id = followers.account_id
    WHERE nickname = '$nickname'
    ) AS 'followers_number',

    (
        SELECT COUNT(*) 
        FROM accounts 
        JOIN followers
        ON accounts.id = followers.follower_id
        WHERE nickname = '$nickname'
    ) AS 'followed_number'

    FROM accounts 
    JOIN posts
    ON accounts.id = posts.account_id
    WHERE nickname = '$nickname'");
    header('Content-type: application/json');
    echo json_encode($result[0]);
});

$api->get('/follow/:nickname', [$authMiddleware], function ($params) {
    $myid = $_SESSION['user']['id'];
    $nickname = $params['nickname'];
    $id = DB::request("SELECT id FROM accounts WHERE nickname = '$nickname'")[0]['id'];
    $result = DB::request("SELECT * FROM followers WHERE account_id = '$id' AND follower_id = '$myid'")[0];
    if (empty($result))
        DB::insert('followers', ['account_id', 'follower_id'], [[$id, $myid]]);
});

$api->get('/unfollow/:nickname', [$authMiddleware], function ($params) {
    $myid = $_SESSION['user']['id'];
    $nickname = $params['nickname'];
    $id = DB::request("SELECT id FROM accounts WHERE nickname = '$nickname'")[0]['id'];
    $result = DB::request("SELECT * FROM followers WHERE account_id = '$id' AND follower_id = '$myid'")[0];
    write_log(json_encode($result));
    if (!empty($result))
        DB::request("DELETE followers FROM followers JOIN accounts ON account_id = id WHERE nickname = '$nickname' AND follower_id = '$myid'");
});

?>