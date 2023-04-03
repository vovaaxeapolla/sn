<?php
$deleteController = function () {
    $pagePayload = ['validationErrors' => ['password' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $password = validate($_POST['password']);
            if (!validateLength($password, 6, 15)) {
                $pagePayload['validationErrors']['password'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if (checkValidation($pagePayload['validationErrors'])) {
                $nn = $_SESSION['user']['nickname'];
                $user = DB::request("SELECT * FROM accounts WHERE nickname = '$nn'")[0];
                if (password_verify($password, $user['password'])) {
                    if ($user['avatar'] !== 'noavatar.png') {
                        unlink('images/avatars/' . $_SESSION['user']['avatar']);
                    }
                    $user = DB::request("SELECT * FROM accounts WHERE nickname = '$nn'")[0];
                    $id = $user['id'];
                    $result = DB::request("
                    SELECT GROUP_CONCAT(image_path SEPARATOR ' ') as images 
                    FROM images 
                    LEFT JOIN posts 
                    ON post_id = posts.id 
                    LEFT JOIN accounts 
                    ON account_id = accounts.id 
                    WHERE accounts.id = '$id'");
                    $images = explode(' ', $result[0]['images']);
                    foreach ($images as $i) {
                        unlink('images/posts/' . $i);
                    }
                    DB::request("
                    DELETE FROM images WHERE id IN(
                    SELECT images.id FROM images 
                    JOIN posts 
                    ON post_id = posts.id 
                    WHERE account_id = '$id')");
                    DB::request("DELETE FROM followers WHERE account_id = '$id' OR follower_id = '$id'");
                    DB::request("DELETE FROM posts WHERE account_id = '$id'");
                    DB::request("DELETE FROM accounts WHERE id = '$id'");
                    DB::request("DELETE FROM comments WHERE account_id = '$id'");
                    unset($_SESSION['auth']);
                    unset($_SESSION['user']);
                    header('Location: /');
                }
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $item = renderTemplate('pages/accounts/deleteContent.php', $pagePayload);
    $page = renderTemplate('pages/edit/edit.php', ['content' => $item]);
    $settingsIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'settings', 'class' => 'navbar__icon']);
    $content = renderTemplate('templates/Main/main.php', [
        'content' => $page,
        'header' => "<button id='settings-open-btn'>$settingsIcon</button>"
    ]);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Настройки']);
}
    ?>