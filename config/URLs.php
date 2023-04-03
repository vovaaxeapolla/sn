<?php
$GLOBALS['URLS'] =
    [
        'delete' => '/accounts/delete',
        'edit' => '/accounts/edit',
        'change' => '/accounts/password/change',
        'reset' => '/accounts/password/reset',
        'signup' => '/accounts/signup',
        'login' => '/accounts/login',
        'logout' => '/accounts/logout',
        'main' => '/',
        'chat' => '/chat',
        'create' => '/create',
        'myprofile' => '/profile/' . (isset($_SESSION['user']['nickname']) ? $_SESSION['user']['nickname'] : ''),
        'dashboard' => '/dashboard',
        'search' => '/search'
    ];
?>