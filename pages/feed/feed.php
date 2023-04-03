<?php
if (!isset($content))
    $content = '';
if (!isset($type))
    $type = 'all';
if (!isset($my))
    $my = 'false';
Bundler::add(__DIR__ . '/feed.css');
Bundler::add(__DIR__ . './feed.js', 'js')
    ::add('JStemplates/Input.js', 'js')
    ::add('JStemplates/Slider.js', 'js')
    ::add('JStemplates/Comments.js', 'js')
    ::add('JStemplates/Dropdown.js', 'js')
    ::add('JStemplates/Post.js', 'js');

?>
<div class="feed">
    <div class="posts">
        <?= $content ?>
    </div>
</div>
<script>
    let page = 1;
    async function loadPosts(page) {
        const result = await fetch('/api/posts/<?= $type ?>/?page=' + page);
        const data = await result.json();
        console.log(data);
        if (Array.isArray(data))
            data.forEach(p => {
                Post(p, <?= $my ?>);
            });
    }
    loadPosts(page++);
</script>