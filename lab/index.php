<?php
session_start();
if (!empty($_SESSION['auth'])) {
    ?> 
    Только для авторизованных
    <?php 
}else{
    if(!empty($_SESSION['flash'])){
        echo $_SESSION['flash'];
        $_SESSION['flash'] = null;
    }
}
?>
Для всех