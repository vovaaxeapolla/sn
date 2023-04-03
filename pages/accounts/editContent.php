<?php
$formError = renderTemplate(
    './templates/UI/FormError.php',
    [
        'error' => $error
    ]
);
$fullname = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'value' => $_SESSION['user']['fullname'],
        'name' => 'fullname',
        'type' => 'text',
        'placeholder' => 'Имя и фамилия',
        'error' => $validationErrors['fullname']
    ]
);
$nickname = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'value' => $_SESSION['user']['nickname'],
        'name' => 'nickname',
        'type' => 'text',
        'placeholder' => 'Имя пользователя',
        'error' => $validationErrors['nickname']
    ]
);
$about = renderTemplate(
    './templates/UI/FormTextarea.php',
    [
        'value' => $_SESSION['user']['about'],
        'name' => 'about',
        'placeholder' => 'О себе',
        'error' => $validationErrors['about']
    ]
);
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Сохранить изменения'
    ]
);
?>
<div class="edit__form-wrapper">
    <h1 class="edit__form__title">
        Настройки
    </h1>
    <div class="edit__row">
        <div class="edit__avatar">
            <img src="/api/images/avatars/<?= $_SESSION['user']['avatar'] ?>" data-avatar="avatar" alt="avatar">
        </div>
        <div class="edit__nickname"><?= $_SESSION['user']['nickname'] ?></div>
    </div>
    <button class="edit__avatar-change popup-btn" data-popup="change-avatar">
        Изменить фото профиля
    </button>
    <form action="" method="post" class="edit__form">
        <?= $fullname ?>
        <?= $nickname ?>
        <?= $about ?>
        <?= $formError ?>
        <?= $submitInput ?>
    </form>
</div>