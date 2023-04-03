<?php
$GLOBALS['js']['profile'] = ['nickname' => $nickname];

Bundler::add(__DIR__ . '/profile.css');
Bundler::add(__DIR__ . '/profile.js', 'js');

$ImgAvatar = renderTemplate('./templates/UI/Img.php', ['src' => "../api/images/avatars/$avatar", 'alt' => "avatar"]);
$gear = renderTemplate('./templates/UI/Icon.php', ['icon' => 'settings']);
?>
<?php
if (!$error) {
    ?>
    <div class="profile-desktop">
        <div class="profile-desktop__header">
            <div class="profile-desktop__avatar">
                <div class="profile-desktop__avatar__img">
                    <?= $ImgAvatar ?>
                </div>
            </div>
            <div class="profile-desktop__info">
                <div class="profile-desktop__top">
                    <div class="profile-desktop__nickname">
                        <?= $nickname ?>
                    </div>
                    <?php
                    if ($my)
                        echo "<a href='../accounts/edit' class='profile-desktop__settings medium'>$gear</a>";
                    else
                        if ($followed)
                            echo "<button id='follow-btn' class='profile-desktop__settings'>Отписаться</button>";
                        else
                            echo '<button id="follow-btn" class="profile-desktop__settings submit color-white">Подписаться</button>';
                    ?>
                </div>
                <div class="profile-desktop__stats">
                    <div class="profile-desktop__posts" id="posts_number"><span class="bolder">
                            <?= $posts_number ?>
                        </span> публикаций</div>
                    <div class="profile-desktop__followers" id="followers_number"><span class="bolder">
                            <?= $followers_number ?>
                        </span> подписчиков</div>
                    <div class="profile-desktop__followed" id="followed_number"><span class="bolder">
                            <?= $followed_number ?>
                        </span> подписок</div>
                </div>
                <div class="profile-desktop__bottom">
                    <div class="profile-desktop__name bolder">
                        <?= $fullname ?>
                    </div>
                    <div class="profile-desktop__status">
                        <?= $about ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-mobile">
        <div class="profile-mobile__header">
            <div class="profile-mobile__info">
                <div class="profile-mobile__top">
                    <div class="profile-mobile__avatar">
                        <div class="profile-mobile__avatar__img">
                            <?= $ImgAvatar ?>
                        </div>
                    </div>
                    <div class="profile-mobile__wrapper">
                        <div class="profile-desktop__nickname bolder">
                            <?= $nickname ?>
                        </div>
                        <?php
                        if ($my)
                            echo "<a href='../accounts/edit' class='profile-mobile__settings medium'>$gear</a>";
                        else
                            if ($followed)
                                echo '<button id="follow-btn" class="profile-mobile__settings ">Отписаться</button>';
                            else
                                echo '<button id="follow-btn" class="profile-mobile__settings submit color-white">Подписаться</button>';
                        ?>
                    </div>
                </div>
                <div class="profile-mobile__middle">
                    <div class="profile-desktop__name bolder">
                        <?= $fullname ?>
                    </div>
                    <div class="profile-mobile__status">
                        <?= $about ?>
                    </div>
                </div>
                <div class="separator"></div>
                <div class="profile-mobile__stats">
                    <div class="profile-desktop__posts" id="posts_number"><span class="bolder">
                            <?= $posts_number ?>
                        </span> публикаций</div>
                    <div class="profile-desktop__followers" id="followers_number"><span class="bolder">
                            <?= $followers_number ?>
                        </span> подписчиков</div>
                    <div class="profile-desktop__followed" id="followed_number"><span class="bolder">
                            <?= $followed_number ?>
                        </span> подписок</div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile__gallery">
        <?= renderTemplate(
            './pages/feed/feed.php',
            [
                'type' => "@$nickname",
                'content' => $_SESSION['user']['nickname'] === $nickname ? renderTemplate('./templates/Create/create.php') : '',
                'my' => $_SESSION['user']['nickname'] === $nickname ? true : false
            ]
        ) ?>
    </div>
    <?php
} else {
    ?>
    <h1 class="profile__error">Пользователь не найден!</h1>
    <?php
}
?>