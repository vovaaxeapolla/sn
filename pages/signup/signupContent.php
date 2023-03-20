<?php
require_once './config/db.php';
$validationErrors = ['email' => '', 'namelastname' => '', 'nickname' => '', 'password' => ''];
$error = "";

try {
    $connection = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
    if (!empty($_POST)) {
        $email = validate($_POST['email']);
        $namelastname = validate($_POST['namelastname']);
        $nickname = validate($_POST['nickname']);
        $password = validate($_POST['password']);

        if ($nickname === '') {
            $validationErrors['nickname'] = "Имя пользователя не может быть пустым";
        }
        if (!validateLength($nickname, 3, 15)) {
            $validationErrors['nickname'] = "Длина имени пользователя должна быть от 3 до 15 символов.";
        }
        if ($password === '') {
            $validationErrors['password'] = "Пароль не может быть пустым";
        }
        if (preg_match('/[^A-Za-z0-9]/', $nickname)) {
            $validationErrors['nickname'] = "В имени пользователя только латинские буквы и цифры.";
        }
        if (!validateLength($password, 6, 15)) {
            $validationErrors['password'] = "Длина пароля должна быть от 6 до 15 символов.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'Некорректный email';
        }
        if (chechValivation($validationErrors)) {
            $query = "SELECT * FROM accounts WHERE email = '$email'";
            $user = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if (empty($user)) {
                $registration_date = time();
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO accounts 
                SET 
                nickname = '$nickname', 
                password = '$hashed_password', 
                namelastname ='$namelastname',
                email ='$email', 
                signup_date = '$registration_date'";
                mysqli_query($connection, $query) or die(mysqli_error($connection));
                $_SESSION['auth'] = true;
                header('Location: /sn/');
            } else {
                $error = "Эта почта уже зарегистрирована";
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
$namelastnameInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'namelastname',
        'type' => 'text',
        'placeholder' => 'Имя и фамилия',
        'error' => $validationErrors['namelastname']
    ]
);
$nicknameInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'nickname',
        'type' => 'text',
        'placeholder' => 'Имя пользователя',
        'error' => $validationErrors['nickname']
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
        'value' => 'Регистрация'
    ]
);
echo renderTemplate(
    './templates/AccountsBody.php',
    [

        'action' => '',
        'method' => 'post',
        'icon' => 'login',
        'title' => 'Регистрация',
        'content' => $emailInput . $namelastnameInput . $nicknameInput . $passwordInput . $formError . $submitInput,
        'extraSection' => 'Есть аккаунт?<a href="' . $URLS['accounts/login'] . '">Вход</a>'
    ]
);
?>