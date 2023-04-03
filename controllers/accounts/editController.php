<?php
$editController = function () {
    $pagePayload = ['validationErrors' => ['fullname' => '', 'nickname' => '', 'about' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $fullname = validate($_POST['fullname']);
            $nickname = validate($_POST['nickname']);
            $about = substr(strip_tags(validate($_POST['about'])), 0, 127);
            $nn = $_SESSION['user']['nickname'];
            if ($fullname === '')
                $pagePayload['validationErrors']['fullname'] = 'Это поле должно быть заполнено';
            if ($nickname === '')
                $pagePayload['validationErrors']['nickname'] = 'Это поле должно быть заполнено';
            if ($nickname !== $_SESSION['user']['nickname']) {
                $user = DB::request("SELECT * FROM accounts WHERE nickname = '$nn'");
                if (!empty($user)) {
                    $pagePayload['validationErrors']['nickname'] = 'Это имя пользователя занято';
                }
            }
            if (checkValidation($pagePayload['validationErrors'])) {
                DB::request("UPDATE accounts SET fullname = '$fullname', nickname = '$nickname', about = '$about' WHERE nickname = '$nn'");
                $_SESSION['user']['fullname'] = $fullname;
                $_SESSION['user']['nickname'] = $nickname;
                $_SESSION['user']['about'] = $about;
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $item = renderTemplate('pages/accounts/editContent.php', $pagePayload);
    $page = renderTemplate('pages/edit/edit.php', ['content' => $item]);
    $settingsIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'settings', 'class' => 'navbar__icon']);
    $content = renderTemplate('templates/Main/main.php', [
        'content' => $page,
        'header' => "<button id='settings-open-btn'>$settingsIcon</button>"
    ]);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Настройки']);
}
    ?>