<?php
Bundler::add(__DIR__ . './edit.css');
Bundler::add(__DIR__ . './edit.js', 'js');
?>
<div class="edit">
    <div class="edit__wrapper">
        <div class="edit__menu edit__menu-closed">
            <ul>
                <li>
                    <button id="edit__menu-close-btn">
                        Закрыть меню
                    </button>
                </li>
                <li><a href="<?= $GLOBALS['URLS']['edit'] ?>">Редактировать профиль</a></li>
                <li><a href="<?= $GLOBALS['URLS']['change'] ?>">Сменить пароль</a></li>
                <li><a href="<?= $GLOBALS['URLS']['delete'] ?>">Удалить аккаунт</a></li>
            </ul>
        </div>
        <div class="edit__content">
            <?= $content ?>
        </div>
    </div>
</div>