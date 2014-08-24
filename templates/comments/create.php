<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title><?= h($product['title']) ?>のレビューを登録する | Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <h2><?= h($product['title']) ?>のレビューを登録する</h2>

  <form action="./create.php?product_id=<?= h($inputs['product_id']) ?>" method="post">
    <div>
      <textarea name="body" ><?= h($inputs['body']) ?></textarea>
      <?php if ($errors['body']) : ?>
      <p>必ず入力して下さい。</p>
      <?php endif ?>
    </div>
    <div>
      <input type="submit" value="上記の内容で登録する" />
    </div>
  </form>

  <?php render('partials/footer.php') ?>
</body>
</html>
