<?php
Bundler::add(__DIR__ . '/main.css');
if (!isset($header))
    $header = '';
$navbar = renderTemplate('./templates/navbar/navbar.php');
$menuIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'menu', 'class' => 'navbar__icon']);
$arrowIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'arrow_upward']);
$popupReport = renderTemplate('./templates/popups/popupReport.php');
$popupChangeAvatar = renderTemplate('./templates/popups/popupChangeAvatar.php');
$popup = renderTemplate(
    './templates/UI/Popup.php',
    [
        'content' => $popupReport,
        'title' => 'Сообщение о проблеме',
        'id' => 'report'
    ]
);
$popupChangeAvatar = renderTemplate(
    './templates/UI/Popup.php',
    [
        'content' => $popupChangeAvatar,
        'title' => 'Изменить фото профиля',
        'id' => 'change-avatar'
    ]
);

?>
<div class="popups">
    <?= $popup ?>
    <?= $popupChangeAvatar ?>
</div>
<main class="main">
    <?= $navbar ?>
    <header class="header">
        <button id="navbar-open-btn">
            <?= $menuIcon ?>
        </button>
        <?= $header ?>
    </header>
    <div class="main__content">
        <button class="main__totop main__totop-hidden">
            <?= $arrowIcon ?>
        </button>
        <?= $content ?>
    </div>
</main>