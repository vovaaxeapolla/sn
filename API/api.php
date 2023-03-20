<?php
$api = new Router('/api');
$api->get('/theme', [], function () {
    if (isset($_GET['theme'])) {
        switch ($_GET['theme']) {
            case 'dark':
                $_SESSION['theme'] = 'dark';
                break;
            case 'light':
                $_SESSION['theme'] = 'light';
                break;
            default:
                $_SESSION['theme'] = 'light';
                break;
        }
    }
});
?>