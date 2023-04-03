<?php

$signupController = function () {
    $pagePayload = ['validationErrors' => ['email' => '', 'password' => '', 'fullname' => '', 'nickname' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $email = validate($_POST['email']);
            $fullname = validate($_POST['fullname']);
            $nickname = validate($_POST['nickname']);
            $password = validate($_POST['password']);
            if ($nickname === '') {
                $pagePayload['validationErrors']['nickname'] = "Имя пользователя не может быть пустым";
            }
            if (!validateLength($nickname, 3, 15)) {
                $pagePayload['validationErrors']['nickname'] = "Длина имени пользователя должна быть от 3 до 15 символов.";
            }
            if ($password === '') {
                $pagePayload['validationErrors']['password'] = "Пароль не может быть пустым";
            }
            if (preg_match('/[^A-Za-z0-9]/', $nickname)) {
                $pagePayload['validationErrors']['nickname'] = "В имени пользователя только латинские буквы и цифры.";
            }
            if (!validateLength($password, 6, 15)) {
                $pagePayload['validationErrors']['password'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $pagePayload['validationErrors']['email'] = 'Некорректный email';
            }
            if (checkValidation($pagePayload['validationErrors'])) {
                $user = DB::request("SELECT email, nickname FROM accounts WHERE email = '$email' OR nickname = '$nickname'")[0];
                if ($user['email'] === $email)
                    $pagePayload['error'] = 'Эта почта уже зарегистрирована';
                if ($user['nickname'] === $nickname)
                    $pagePayload['error'] = 'Это имя пользователя занято';
                if (empty($user)) {
                    $registration_date = time();
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    DB::insert(
                        'accounts',
                        ['nickname', 'password', 'fullname', 'email', 'signup_date'],
                        [[$nickname, $hashed_password, $fullname, $email, $registration_date]]
                    );
                    $_SESSION['auth'] = true;
                    $_SESSION['user'] = DB::request("SELECT * FROM accounts JOIN roles ON accounts.role = roles.id WHERE email = '$email'")[0];
                    header('Location: ' . $GLOBALS['URLS']['main']);
                }
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $content = renderTemplate('pages/accounts/signupContent.php', $pagePayload);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Регистрация']);
}
    ?>