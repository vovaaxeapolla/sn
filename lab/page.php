<?php
session_start();

if (!empty($_SESSION['auth'])) {
    echo "Вы зашли как ".$_SESSION['login'];
}else{
    echo "Пожалуйста авторизуйтесь ";
    echo "<a href='login.php'>Войти</a>";
}
?>