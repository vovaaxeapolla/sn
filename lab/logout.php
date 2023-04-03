<?php
session_start();
$_SESSION['auth'] = null;
$_SESSION['flash'] = 'Вы вышли';
header('Location: index.php');
?>