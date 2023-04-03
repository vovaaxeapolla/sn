<?php
$emailInput = renderTemplate('./templates/UI/FormInputText.php', ['name' => 'email', 'type' => 'email', 'placeholder' => 'Почта', 'error' => $validationErrors['email']]);
$submitInput = renderTemplate('./templates/UI/FormInputSubmit.php', ['name' => 'submit', 'value' => 'Получить ссылку для входа']);
echo renderTemplate(
    './templates/AccountsBody/AccountsBody.php',
    [
        'action' => '',
        'method' => 'post',
        'icon' => 'lock',
        'title' => 'Не удаётся войти?',
        'content' => $emailInput . $submitInput . '<div class="separatorOR"><span></span>ИЛИ<span></span></div><a class="underline-anim" href="' . $GLOBALS['URLS']['signup'] . '">Создать новый аккаунт</a>',
        'extraSection' => '<a class="underline-anim" href="' . $GLOBALS['URLS']['login'] . '">Вернуться к входу</a>'
    ]
);
?>