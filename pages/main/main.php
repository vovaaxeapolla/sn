<?php
$navbar = renderTemplate('./templates/navbar.php');
// if (isset($_FILES["userfile"])) {
//     if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) {
//         if (move_uploaded_file($_FILES['userfile']['tmp_name'], 'images/' . $_FILES["userfile"]["name"])) {
//             rename('images/' . $_FILES["userfile"]["name"], uniqid('MyApp', true));
//         } else {

//         }
//     }
// }
$popupReport = renderTemplate('./templates/popups/popupReport.php');
$menuIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'menu', 'class' => 'navbar__icon']);
$popup = renderTemplate('./templates/UI/Popup.php', ['content' => $popupReport, 'title' => 'Сообщение о проблеме', 'id' => 'report']);
?>
<div class="popups">
    <?= $popup ?>
</div>
<main class="main">
    <?= $navbar ?>
    <div class="profile-desktop">
        <div class="profile-desktop__header">
            <div class="profile-desktop__avatar">
                <img src="https://sovapublish.com/wp-content/uploads/2018/07/cards_Posud_2018-04_RUS_Page_23.png" alt=""
                    class="profile-desktop__avatar__img">
            </div>
            <div class="profile-desktop__info">
                <div class="profile-desktop__top">
                    <div class="profile-desktop__nickname bolder">vovaaxeapolla</div>
                    <button class="profile-desktop__settings">Редактировать профиль</button>
                </div>
                <div class="profile-desktop__stats">
                    <div class="profile-desktop__posts"><span class="bolder">50</span> публикаций</div>
                    <div class="profile-desktop__followers"><span class="bolder">50</span> подписчиков</div>
                    <div class="profile-desktop__followed"><span class="bolder">50</span> подписок</div>
                </div>
                <div class="profile-desktop__bottom">
                    <div class="profile-desktop__name bolder">Владимир Фадеев</div>
                    <div class="profile-desktop__status">Лучше АУФ чем не АУФ</div>
                </div>
            </div>
        </div>
        <div class="separator"></div>
        <!-- <form enctype="multipart/form-data" action="/sn/profile-desktop" method="POST">
            Отправить этот файл: <input name="userfile" type="file" />
            <input type="submit" value="Отправить файл" />
        </form> -->
    </div>
    <div class="profile-mobile">
        <header class="header">
            <button id="navbar-open-btn">
                <?= $menuIcon ?>
            </button>
        </header>
        <div class="separator"></div>
        <div class="profile-mobile__header">
            <div class="profile-mobile__info">
                <div class="profile-mobile__top">
                    <div class="profile-mobile__avatar">
                        <img src="https://sovapublish.com/wp-content/uploads/2018/07/cards_Posud_2018-04_RUS_Page_23.png"
                            alt="" class="profile-desktop__avatar__img">
                    </div>
                    <div class="profile-mobile__wrapper">
                        <div class="profile-desktop__nickname bolder">vovaaxeapolla</div>
                        <button class="profile-mobile__settings">Редактировать профиль</button>
                    </div>
                </div>
                <div class="profile-mobile__middle">
                    <div class="profile-desktop__name bolder">Владимир Фадеев</div>
                    <div class="profile-desktop__status">Лучше АУФ чем не АУФ</div>
                </div>
                <div class="separator"></div>
                <div class="profile-mobile__stats">
                    <div class="profile-desktop__posts"><span class="bolder">50</span> публикаций</div>
                    <div class="profile-desktop__followers"><span class="bolder">50</span> подписчиков</div>
                    <div class="profile-desktop__followed"><span class="bolder">50</span> подписок</div>
                </div>
                <div class="separator"></div>
            </div>
        </div>
</main>