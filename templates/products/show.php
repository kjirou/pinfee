<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title><?= h($product['title']) ?> | Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <?php if ($notification) : ?>
  <p><?= h($notification) ?></p>
  <?php endif ?>

  <div>
    <h2><?= h($product['title']) ?></h2>

    <ul>
      <li><a href="<?= h($product['url']) ?>" target="_blank"><?= h($product['url']) ?></a></li>
      <?php if ($product['description']) : ?>
        <li><?= h($product['description']) ?></li>
      <?php endif ?>
    </ul>

    <ul>
    <?php foreach ($comments as $index => $comment) : ?>
      <li>(<?= h($comment['created_at']) ?>) <?= h($comment['body']) ?></li>
    <?php endforeach ?>
    </ul>
  </div>

  <?php render('partials/footer.php') ?>
</body>
</html>
