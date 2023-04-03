<?php
$changeController = function () {
    $pagePayload = ['validationErrors' => ['oldPassword' => '', 'newPassword' => '', 'confirmPassword' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $oldPassword = validate($_POST['oldPassword']);
            $newPassword = validate($_POST['newPassword']);
            $confirmPassword = validate($_POST['confirmPassword']);
            if (!validateLength($oldPassword, 6, 15)) {
                $pagePayload['validationErrors']['oldPassword'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if (!validateLength($newPassword, 6, 15)) {
                $pagePayload['validationErrors']['newPassword'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if (!validateLength($confirmPassword, 6, 15)) {
                $pagePayload['validationErrors']['confirmPassword'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if ($newPassword !== $confirmPassword)
                $pagePayload['validationErrors']['confirmPassword'] = "Пароли должны совпадать";
            if (checkValidation($pagePayload['validationErrors'])) { {
                    $hashed_password = $_SESSION['user']['password'];
                    if (password_verify($oldPassword, $hashed_password)) {
                        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                        DB::request("UPDATE accounts SET password = '$hashed_password'");
                        $_SESSION['user']['password'] = $hashed_password;
                    } else {
                        $pagePayload['error'] = "Неверный пароль";
                    }
                }
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $item = renderTemplate('pages/accounts/changeContent.php', $pagePayload);
    $page = renderTemplate('pages/edit/edit.php', ['content' => $item]);
    $settingsIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'settings', 'class' => 'navbar__icon']);
    $content = renderTemplate('templates/Main/main.php', [
        'content' => $page,
        'header' => "<button id='settings-open-btn'>$settingsIcon</button>"
    ]);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Смена пароля']);
}
    ?>