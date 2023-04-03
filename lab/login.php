<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'test');
mysqli_query($connection, "SET NAMES 'utf8'");
if(!empty($_POST)){
    $login = $_POST['login'];
    $query = "SELECT * FROM users WHERE login = '$login'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $user = mysqli_fetch_assoc($result);

    if(!empty($user)){
        $hashed_password = $user['password'];
        if(password_verify($_POST['password'], $hashed_password)){
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            header("Location: page.php");
        }else{
            echo "Неверный пароль";
        }
    }else{
        echo "Пользователя с таким логином не существует";
    }
}
if(empty($user)){
?>
<form method="post">
    <input type="text" name="login">
    <input type="text" name="password">
    <input type="submit" value="Войти">
</form>
<?php
}
?>