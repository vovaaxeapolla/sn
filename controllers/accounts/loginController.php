<?php
$loginController = function () {
    $pagePayload = ['validationErrors' => ['email' => '', 'password' => ''], 'error' => ''];
    try {
        if (!empty($_POST)) {
            $email = validate($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $pagePayload['validationErrors']['email'] = 'Некорректный email';
            }
            $password = validate($_POST['password']);
            if (!validateLength($password, 6, 15)) {
                $pagePayload['validationErrors']['password'] = "Длина пароля должна быть от 6 до 15 символов.";
            }
            if (checkValidation($pagePayload['validationErrors'])) {
                $user = DB::request("
                SELECT accounts.id, accounts.email, accounts.password, 
                accounts.fullname, accounts.nickname, accounts.signup_date,
                accounts.avatar, accounts.about, roles.role as 'role'
                FROM accounts 
                JOIN roles 
                ON accounts.role = roles.id 
                WHERE email = '$email'
                ");
                if (!empty($user)) {
                    $hashed_password = $user[0]['password'];
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['auth'] = true;
                        $_SESSION['user'] = $user[0];
                        header("Location: " . $GLOBALS['URLS']['main']);
                    } else {
                        $pagePayload['error'] = "Неверный логин или пароль";
                    }
                } else {
                    $pagePayload['error'] = "Пользователя с такой почтой не существует";
                }
            }
        }
    } catch (Throwable $th) {
        $pagePayload['error'] = "Серверная ошибка";
    }
    $content = renderTemplate('pages/accounts/loginContent.php', $pagePayload);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Логин']);
}
    ?>