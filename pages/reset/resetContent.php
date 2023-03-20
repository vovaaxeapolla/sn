<?php
require_once('./config/URLs.php');
$emailInput = renderTemplate('./templates/UI/FormInputText.php', ['name' => 'email', 'type' => 'email', 'placeholder' => 'Почта']);
$submitInput = renderTemplate('./templates/UI/FormInputSubmit.php', ['name' => 'submit', 'value' => 'Получить ссылку для входа']);
echo renderTemplate(
    './templates/AccountsBody.php',
    [
        'action' => '',
        'method' => 'post',
        'icon' => 'lock',
        'title' => 'Не удаётся войти?',
        'content' => $emailInput . $submitInput . '<div class="separatorOR"><span></span>ИЛИ<span></span></div><a href="' . $URLS['accounts/signup'] . '">Создать новый аккаунт</a>',
        'extraSection' => '<a href="' . $URLS['accounts/login'] . '">Вернуться к входу</a>'
    ]
);
?>