<?php
$resetController = function () {
    $pagePayload = ['validationErrors' => ['email' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $email = validate($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $pagePayload['validationErrors']['email'] = 'Некорректный email';
            }
            if (checkValidation($pagePayload['validationErrors'])) {
                $user = DB::request("SELECT * FROM accounts WHERE email = '$email'")[0];
                if (!empty($user)) {
                    mail($email, 'Reset password', 'Ваш новый пароль: 123123');
                } else {
                    $pagePayload['error'] = "Пользователя с такой почтой не существует";
                }
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $content = renderTemplate('pages/accounts/resetContent.php', $pagePayload);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Восстановление пароля']);
}
    ?>