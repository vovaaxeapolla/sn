<?php
$authMiddleware = function () {
    if (isset($_SESSION['auth']) && $_SESSION['auth']) {
        return true;
    }
    header("Location: " . $GLOBALS['URLS']['login']);
    return false;
}
;
?>