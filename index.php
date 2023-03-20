<?php
require_once './functions.php';
require_once './Router.php';
require './API/api.php';
session_start();
$app = new Router();
$accounts = new Router('/accounts');
$app->use($accounts);
$app->use($api);

$accounts->any('/login', [], function () {
    $content = renderTemplate('pages/login/loginContent.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Логин']);
});

$accounts->get('/reset', [], function () {
    $content = renderTemplate('pages/reset/resetContent.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Востановление пароля']);
});

$accounts->any('/signup', [], function () {
    $content = renderTemplate('pages/signup/signupContent.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Регистрация']);
});

$accounts->get('/logout', [], function () {
    session_start();
    $_SESSION['auth'] = false;
    header('Location: /sn/accounts/login');
});

$auth = function ($res, $req) {
    if (isset($_SESSION['auth']))
        return $_SESSION['auth'];
    header('Location: /sn/accounts/login');
    return false;
};

$app->any('/', [], function () {
    $content = renderTemplate('pages/main/main.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Главная']);
});

$app->any('/chat', [$auth], function () {
    $content = renderTemplate('pages/main/main.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Сообщения']);
});

$app->any('/profile', [$auth], function () {
    $content = renderTemplate('pages/main/main.php');
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Профиль']);
});

$app->handle();

?>