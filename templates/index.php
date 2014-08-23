<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title>Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <ul>
  <?php foreach ($products as $index => $row) : ?>
    <li><a href="/products/show.php?id=<?= h($row['id']) ?>"><?= h($row['title']) ?></a></li>
  <?php endforeach ?>
  </ul>

  <?php render('partials/footer.php') ?>
</body>
</html>
