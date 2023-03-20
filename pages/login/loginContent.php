<?php
require_once './config/db.php';
$validationErrors = ['email' => '', 'password' => ''];
$error = "";
try {
    $connection = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
    mysqli_query($connection, "SET NAMES 'utf8'");
    if (!empty($_POST)) {
        $email = validate($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'Некорректный email';
        }
        $password = validate($_POST['password']);
        if ($password === '') {
            $validationErrors['password'] = "Пароль не может быть пустым";
        }
        if (!validateLength($password, 6, 15)) {
            $validationErrors['password'] = "Длина пароля должна быть от 6 до 15 символов.";
        }
        if (chechValivation($validationErrors)) {
            $query = "SELECT * FROM accounts WHERE email = '$email'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            $user = mysqli_fetch_assoc($result);
            if (!empty($user)) {
                $hashed_password = $user['password'];
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['auth'] = true;
                    header("Location: /sn/");
                } else {
                    $error = "Неверный логин или пароль";
                }
            } else {
                $error = "Пользователя с такой почтой не существует";
            }
        }
    }
} catch (Throwable $th) {
    $error = "Серверная ошибка";
}

require_once('./config/URLs.php');
$emailInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Почта',
        'error' => $validationErrors['email']
    ]
);
$passwordInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Пароль',
        'error' => $validationErrors['password']
    ]
);
$formError = renderTemplate(
    './templates/UI/FormError.php',
    [
        'error' => $error
    ]
);
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Войти'
    ]
);
echo renderTemplate(
    './templates/AccountsBody.php',
    [
        'action' => '',
        'method' => 'post',
        'icon' => 'login',
        'title' => 'Логин',
        'content' => $emailInput . $passwordInput . $formError . $submitInput . '<a href="' . $URLS['accounts/reset'] . '">Забыли пароль?</a>',
        'error' => $error,
        'extraSection' => "У вас ещё нет аккаунта? <a href='" . $URLS['accounts/signup'] . "'>Зарегистрироваться</a>"
    ]
);
?>