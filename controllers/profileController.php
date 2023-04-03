<?php
$profileController = function ($params) {
    $pagePayload = ['followed' => false, 'my' => false, 'fullname' => '', 'nickname' => $_SESSION['user']['nickname'], 'about' => '', 'avatar' => '', 'error' => ''];
    if ($params['nickname'] === $_SESSION['user']['nickname']) {
        $pagePayload['my'] = true;
    }
    $nickname = $params['nickname'];
    $result = DB::request("
    SELECT accounts.id as id, avatar, about, fullname, nickname,
    (SELECT COUNT(*) 
    FROM accounts 
    JOIN posts
    ON accounts.id = posts.account_id
    WHERE nickname = '$nickname') AS 'posts_number',
    (SELECT COUNT(*) 
    FROM accounts 
    JOIN followers
    ON accounts.id = followers.account_id
    WHERE nickname = '$nickname') AS 'followers_number',
    (SELECT COUNT(*) 
    FROM accounts 
    JOIN followers
    ON accounts.id = followers.follower_id
    WHERE nickname = '$nickname') AS 'followed_number'
    FROM accounts 
    WHERE nickname = '$nickname'");
    if (!empty($result[0]['nickname'])) {
        $pagePayload['avatar'] = $result[0]['avatar'];
        $pagePayload['about'] = $result[0]['about'];
        $pagePayload['fullname'] = $result[0]['fullname'];
        $pagePayload['posts_number'] = $result[0]['posts_number'];
        $pagePayload['followers_number'] = $result[0]['followers_number'];
        $pagePayload['followed_number'] = $result[0]['followed_number'];
        $pagePayload['nickname'] = $params['nickname'];
        $id = $result[0]['id'];
        $myid = $_SESSION['user']['id'];
        $result = DB::request("SELECT * FROM followers WHERE account_id = '$id' AND follower_id = '$myid'");
        if (!empty($result))
            $pagePayload['followed'] = true;
    } else {
        $pagePayload['error'] = 1;
    }
    $page = renderTemplate('pages/profile/profile.php', $pagePayload);
    $content = renderTemplate('templates/Main/main.php', ['content' => $page]);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Профиль']);
}
    ?>