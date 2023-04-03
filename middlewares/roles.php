<?php
$roleMiddleware = function () {
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'full') {
        return true;
    }
    return false;
};
?>