<?php
include_once("templates/header.php");
// PHP Intelephense bug
include_once("data/posts.php");

?>
<main>
    <div id="title-container">
        <h1>Blog Code</h1>
        <p>your programming blog</p>
    </div>
    <div id="posts-container">
        <?php foreach ($posts as $post): ?>
            <div class="post-box">
                <img src="<?= $BASE_URL ?>/img/<?= $post['img'] ?>" alt="<?= $post['title'] ?>">
                <h2 class="post-title">
                    <a href="<?= $BASE_URL ?>/post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                </h2>

                <p class="post-description"><?= $post['description'] ?></p>
                <div class="tags-container">
                    <?php foreach ($post['tags'] as $tag): ?>
                        <a href="http://"><?= $tag ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php
include_once("templates/footer.php");
?>