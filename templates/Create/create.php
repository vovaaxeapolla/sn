<?php
Bundler::add(__DIR__ . '/create.css');
Bundler::add(__DIR__ . '/create.js', 'js');
$photoIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'photo']);
$attachIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'attach_file']);
$sendIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'send']);
$validationErrors = ['text' => ''];
$error = "";
try {
    if (!empty($_POST) || !empty($_FILES)) {
        $images = [];
        foreach ($_FILES["photos"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["photos"]["tmp_name"][$key];
                $temp = explode('.', $_FILES["photos"]["name"][$key]);
                $name = uniqid('image', true) . '.' . end($temp);
                $images[] = $name;
                move_uploaded_file($tmp_name, "images/posts/$name");
            }
        }
        $text = '';
        if (isset($_POST['text']))
            $text = $_POST['text'];
        if ($text !== '' || !empty($images)) {
            DB::insert(
                'posts',
                ['account_id', 'date', 'text'],
                [
                    [
                        $_SESSION['user']['id'],
                        time(),
                        $text
                    ]
                ]
            );
            $values = [];
            foreach ($images as $i) {
                $values[] = [DB::id(), $i];
            }
            DB::insert(
                'images',
                ['post_id', 'image_path'],
                $values
            );
        }
    }
} catch (Throwable $th) {
    $error = "Серверная ошибка";
}
?>
<div class="create">
    <div class="create__wrapper">
        <div class="create__form">
            <div class="create__wrapper-input">
                <label for="photos" class="create__label mr create__attach">
                    <?= $attachIcon ?>
                    <input name="photos[]" id="photos" type="file" multiple accept=".png,.jpg,.jpeg" />
                </label>
                <div class="create__input" onsubmit='return copyContent()' contenteditable="true"
                    data-placeholder="Что у вас нового?"></div>
            </div>
            <button class="create__submit create__label ml create__send">
                <?= $sendIcon ?>
            </button>
        </div>
    </div>
</div>