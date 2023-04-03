<?php
$logoutController = function () {
    $_SESSION['auth'] = false;
    unset($_SESSION['auth']);
    header('Location: ' . $GLOBALS['URLS']['login']);
}
    ?>