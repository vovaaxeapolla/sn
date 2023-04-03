<?php
if (!isset($class))
    $class = '';
if (!isset($icon))
    $icon = '';
$i = renderTemplate('./assets/icons/' . $icon . '.svg');
?>
<i class="Icon<?= ' ' . $class ?>">
    <?= $i ?>
</i>