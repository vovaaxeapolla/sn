<?php
$mainIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == '/sn/' ? 'home_fill' : 'home', 'class' => 'navbar__icon']);
$messengerIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == '/sn/chat' ? 'chat_fill' : 'chat', 'class' => 'navbar__icon']);
$profileIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == '/sn/profile' ? 'profile_fill' : 'profile', 'class' => 'navbar__icon']);
$menuIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'menu', 'class' => 'navbar__icon']);
$closeIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'close', 'class' => 'navbar__icon']);
?>

<nav class="navbar navbar-closed">
    <button class="navbar__item" id="navbar-close-btn">
        <?= $closeIcon ?>
        Закрыть меню
    </button>
    <div class="separator"></div>
    <ul class="navbar__bar">
        <li class="navbar__item<?= $_SERVER['REDIRECT_URL'] == '/sn/' ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="/sn">
                <?= $mainIcon ?>
                <p>Главная</p>
            </a>
        </li>
        <li class="navbar__item<?= $_SERVER['REDIRECT_URL'] == '/sn/chat' ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="/sn/chat">
                <?= $messengerIcon ?>
                <p>Сообщения</p>
            </a>
        </li>
        <li class="navbar__item<?= $_SERVER['REDIRECT_URL'] == '/sn/profile' ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="/sn/profile">
                <?= $profileIcon ?>
                <p>Профиль</p>
            </a>
        </li>
    </ul>
    <div class="separator"></div>
    <button class="navbar__item">
        <div class="navbar__link" id="navbar__menu-btn">
            <?= $menuIcon ?>
            <p>Ещё</p>
        </div>
        <div class="navbar__menu" id="navbar__menu">
            <div class="navbar__menu__item" id="change_theme">
                <p style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                    Сменить тему
                </p>
            </div>
            <div class="navbar__menu__item" id="report-open">
                <p style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                    Сообщение о проблеме
                </p>
            </div>
            <a href="/sn/accounts/logout" class="navbar__menu__item">
                <p style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                    Выйти
                </p>
            </a>
        </div>
    </button>
</nav>