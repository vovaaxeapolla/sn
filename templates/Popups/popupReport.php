<?php
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Отправить отчёт'
    ]
);
?>

<form action="" method="post" class="popupReport">
    <textarea placeholder="Опишите проблему"></textarea>
    <?= $submitInput ?>
</form>