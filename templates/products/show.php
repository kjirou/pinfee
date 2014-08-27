<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title><?= h($product['title']) ?> | Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <?php if ($notification) : ?>
  <?php render('partials/notification.php', array('notification' => $notification)) ?>
  <?php endif ?>

  <div>
    <h2><?= h($product['title']) ?></h2>

    <ul>
      <li><a href="<?= h($product['url']) ?>" target="_blank"><?= h($product['url']) ?></a></li>
      <?php if ($product['description']) : ?>
        <li><?= h($product['description']) ?></li>
      <?php endif ?>
      <li><?= h($product['comment_count']) ?> comment(s)</li>
      <li><?= h($product['like_count']) ?> like(s)</li>
    </ul>

    <div>
      <?php if ($product['comment_count'] > 0) : ?>
      <p><?= $product['comment_count'] ?> のレビューをいただいています。</p>
      <?php endif ?>

      <div>
        <a href="#comment_form">レビューを書く</a>
      </div>

      <ul>
      <?php foreach ($comments as $index => $comment) : ?>
        <li>(<?= h($comment['created_at']) ?>) <?= h($comment['body']) ?></li>
      <?php endforeach ?>
      </ul>

      <form id="comment_form" action="/comments/create.php?product_id=<?= h($product['id']) ?>" method="post">
        <div>
          <textarea name="body"></textarea>
        </div>
        <div>
          <input type="submit" value="レビューを投稿する" />
        </div>
      </form>
    </div>
  </div>

  <?php render('partials/footer.php') ?>
</body>
</html>
