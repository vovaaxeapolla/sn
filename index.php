<?php
// error_reporting(E_ERROR | E_PARSE);
session_start();
require_once './config/URLs.php';
require_once './functions.php';
require_once './Router.php';
require_once './middlewares/auth.php';
require_once './middlewares/roles.php';
require './API/api.php';
require './config/db.php';
require './controllers/profileController.php';
require './controllers/accounts/loginController.php';
require './controllers/accounts/signupController.php';
require './controllers/accounts/resetController.php';
require './controllers/accounts/logoutController.php';
require './controllers/accounts/changeController.php';
require './controllers/accounts/editController.php';
require './controllers/accounts/deleteController.php';

DB::config($db)::connect();

$app = new Router();
$accounts = new Router('/accounts');
$app->use($accounts);
$app->use($api);

$accounts->any('/login', [], $loginController);
$accounts->any('/signup', [], $signupController);
$accounts->get('/logout', [], $logoutController);
$accounts->any('/password/reset', [], $resetController);
$accounts->any('/password/change', [$authMiddleware], $changeController);
$accounts->any('/edit', [$authMiddleware], $editController);
$accounts->any('/delete', [$authMiddleware], $deleteController);


$app->any('/', [$authMiddleware], function () {
    $page = renderTemplate('pages/feed/feed.php', ['type' => 'all', 'content' => renderTemplate('./templates/Create/create.php')]);
    $content = renderTemplate('templates/Main/main.php', ['content' => $page]);
    echo renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Главная']);
});

$app->any('/chat', [$authMiddleware], function () {
    $page = "chat";
    $content = renderTemplate('templates/Main/main.php', ['content' => $page]);
    $body = renderTemplate('templates\body.php', ['content' => $content, 'title' => 'Сообщения']);
    echo $body;
});

$app->any('/search', [$authMiddleware], function () {
    $search = renderTemplate('templates/Search/search.php');
    $content = renderTemplate('templates/Main/main.php', ['content' => $search]);
    $body = renderTemplate('templates\body.php', ['content' => $content, 'title' => 'search']);
    echo $body;
});

$app->any('/dashboard', [$authMiddleware, $roleMiddleware], function () {
    $dashboard = renderTemplate('templates/Dashboard/dashboard.php');
    $content = renderTemplate('templates/Main/main.php', ['content' => $dashboard]);
    $body = renderTemplate('templates\body.php', ['content' => $content, 'title' => 'dashboard']);
    echo $body;
});

$app->any('/profile/:nickname', [$authMiddleware], $profileController);

$app->handle();

?>