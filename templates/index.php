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

  <div class="js-products">
    <?php foreach ($products as $index => $product) : ?>
    <div class="js-products-item">
      <h3><a href="/products/show.php?id=<?= h($product['id']) ?>"><?= h($product['title']) ?></a></h3>
      <ul>
        <li><a href="<?= h($product['url']) ?>" target="_blank"><?= h($product['url']) ?></a></li>
        <?php if ($product['description']) : ?>
          <li><?= h($product['description']) ?></li>
        <?php endif ?>
        <li><?= h($product['comment_count']) ?> comment(s)</li>
        <li><?= h($product['like_count']) ?> like(s)</li>
      </ul>
    </div>
    <?php endforeach ?>
  </div>

  <div class="more">
    <a href="javascript:void(0);" class="js-more-button">もっと見る</a>
  </div>

  <?php render('partials/footer.php') ?>

  <script>
    $('.js-more-button').on('mousedown', function(){
      Pinfee.showCover();
      Pinfee.autoPagerize('/index.php?page=1', '.js-products', '.js-products-item').then(function(){
        Pinfee.hideCover();
      });
    });
  </script>
</body>
</html>
