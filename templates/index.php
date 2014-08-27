<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title>Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <?php if ($notification) : ?>
  <?php render('partials/notification.php', array('notification' => $notification)) ?>
  <?php endif ?>

  <?php foreach ($products as $index => $product) : ?>
  <div>
    <h3><a href="/products/show.php?id=<?= h($product['id']) ?>"><?= h($product['title']) ?></a></h3>
    <ul>
      <li><a href="<?= h($product['url']) ?>" target="_blank"><?= h($product['url']) ?></a></li>
      <?php if ($product['description']) : ?>
        <li><?= h($product['description']) ?></li>
      <?php endif ?>
      <li><?= h($product['like_count']) ?> like(s)</li>
      <li><?= h($product['comment_count']) ?> comment(s)</li>
    </ul>
  </div>
  <?php endforeach ?>

  <div class="more">
    <a href="#">もっと見る</a>
  </div>

  <?php render('partials/footer.php') ?>
</body>
</html>
