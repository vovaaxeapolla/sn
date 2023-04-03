<?php

function validateLength($input, $min, $max)
{
    $len = strlen($input);
    if ($len >= $min && $len <= $max)
        return true;
    return false;
}

function validate($name)
{
    if (empty($name) || trim($name) === '') {
        return '';
    }
    return $name;
}

$errors = [
    'login' => '',
    'password' => '',
    'email' => '',
    'birthday' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = mysqli_connect('localhost', 'root', '', 'test');
    $flag = false;

    $email = validate($_POST['email']);
    $login = validate($_POST['login']);
    $password = validate($_POST['password']);
    $birthday = validate($_POST['birthday']);
    $confirm = validate($_POST['confirm']);
    $country = validate($_POST['country']);

    if ($login === '') {
        $errors['login'] = join(' ', [$errors['login'], "Логин не может быть пустым"]);
        $flag = true;
    }
    if ($password === '') {
        $errors['password'] = join(' ', [$errors['password'], "Пароль не может быть пустым"]);
        $flag = true;
    }
    if (preg_match('/[^A-Za-z0-9]/', $login)) {
        $errors['login'] = join(' ', [$errors['login'], "В логине только латинские буквы и цифры."]);
        $flag = true;
    }
    if (!validateLength($login, 4, 10)) {
        $errors['login'] = join(' ', [$errors['login'], "Длина логина должна быть от 4 до 10 символов."]);
        $flag = true;
    }
    if (!validateLength($password, 6, 12)) {
        $errors['password'] = join(' ', [$errors['password'], "Длина пароля должна быть от 6 до 12 символов."]);
        $flag = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректный email';
        $flag = true;
    }
    $date = explode('.', $birthday);
    if (!preg_match('/\d\d\.\d\d\.\d\d\d\d/', $birthday) || !checkdate($date[1], $date[0], $date[2])) {
        $errors['birthday'] = 'Некорректная дата рождения';
        $flag = true;
    }
    if (!$flag) {
        if ($password == $confirm) {
            $query = "SELECT * FROM users WHERE login = '$login'";
            $user = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if (empty($user)) {
                $birthday = join('-', [$date[2], $date[1], $date[0]]);
                $registration_date = date("Y-m-d H:i:s");
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users 
        SET 
        country = '$country',
        login = '$login', 
        password = '$hashed_password', 
        email ='$email', 
        birthday = '$birthday', 
        registration_date = '$registration_date'";
                mysqli_query($connection, $query) or die(mysqli_error($connection));
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['id'] = mysqli_insert_id($connection);
            } else {
                echo "Логин занят";
            }
        } else {
            echo "Пароли не совпадают";
        }
    }
}
?>
<style>
    input,
    select {
        display: block;
    }
</style>
<form method="post">
    <select name="country">
        <option value="Россия">Россия</option>
        <option value="Германия">Германия</option>
        <option value="Индия">Индия</option>
    </select>
    <?= $errors['email'] ?>
    <input type="email" name="email">
    <?= $errors['birthday'] ?>
    <input name="birthday">
    <?= $errors['login'] ?>
    <input name="login">
    <?= $errors['password'] ?>
    <input type="password" name="password">
    <input type="password" name="confirm">
    <input type="submit" value="Зарегистрироваться">
</form>