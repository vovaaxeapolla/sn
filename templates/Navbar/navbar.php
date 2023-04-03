<?php
Bundler::add(__DIR__ . '/navbar.css');
$mainIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['main'] ? 'home_fill' : 'home', 'class' => 'navbar__icon']);
$messengerIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['chat'] ? 'chat_fill' : 'chat', 'class' => 'navbar__icon']);
$searchIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['search'] ? 'search_fill' : 'search', 'class' => 'navbar__icon']);
$profileIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['myprofile'] ? 'profile_fill' : 'profile', 'class' => 'navbar__icon']);
$dashboardIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['dashboard'] ? 'dashboard_fill' : 'dashboard', 'class' => 'navbar__icon']);
$menuIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'menu', 'class' => 'navbar__icon']);
$closeIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'close', 'class' => 'navbar__icon']);
$logoutIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'logout', 'class' => 'navbar__icon-red']);
?>

<nav class="navbar navbar-closed">
    <button class="navbar__item" id="navbar-close-btn">
        <?= $closeIcon ?>
        Закрыть меню
    </button>
    <div class="separator"></div>
    <ul class="navbar__bar">
        <li
            class="navbar__item<?= $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['main'] ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="<?= $GLOBALS['URLS']['main'] ?>">
                <?= $mainIcon ?>
                <p>Главная</p>
            </a>
        </li>
        <li
            class="navbar__item<?= $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['chat'] ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="<?= $GLOBALS['URLS']['chat'] ?>">
                <?= $messengerIcon ?>
                <p>Сообщения</p>
            </a>
        </li>
        <li
            class="navbar__item<?= $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['search'] ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="<?= $GLOBALS['URLS']['search'] ?>">
                <?= $searchIcon ?>
                <p>Поиск</p>
            </a>
        </li>
        <li
            class="navbar__item<?= $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['myprofile'] ? ' navbar__item-active' : '' ?>">
            <a class="navbar__link" href="<?= $GLOBALS['URLS']['myprofile'] ?>">
                <?= $profileIcon ?>
                <p>Профиль</p>
            </a>
        </li>
        <?php
        if ($_SESSION['user']['role'] === 'full') {
            ?>
            <li
                class="navbar__item<?= $_SERVER['REDIRECT_URL'] == $GLOBALS['URLS']['dashboard'] ? ' navbar__item-active' : '' ?>">
                <a class="navbar__link" href="<?= $GLOBALS['URLS']['dashboard'] ?>">
                    <?= $dashboardIcon ?>
                    <p>Dashboard</p>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="separator"></div>
    <div class="navbar__item">
        <button class="navbar__link dropdown-btn" data-dropdown="navbar">
            <?= $menuIcon ?>
            <p>
                Ещё
            </p>
        </button>
        <div class="navbar__menu dropdown-menu" data-dropdown="navbar">
            <div class="navbar__menu__item" id="change_theme">
                <p>
                    Сменить тему
                </p>
            </div>
            <div class="navbar__menu__item popup-btn" data-popup="report">
                <p>
                    Сообщение о проблеме
                </p>
            </div>
            <a href="<?= $GLOBALS['URLS']['logout'] ?>" class="navbar__menu__item">
                <p>
                    Выйти
                    <?= $logoutIcon ?>
                </p>
            </a>
        </div>
    </div>
</nav>