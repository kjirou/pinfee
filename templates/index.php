<html>
<body>
  <?php render('partials/header.php') ?>

  <ul>
  <?php foreach ($products as $index => $row) : ?>
    <li><a href="<?= h($row['url']) ?>" target="_blank"><?= h($row['title']) ?></a></li>
  <?php endforeach ?>
  </ul>

  <?php render('partials/footer.php') ?>
</body>
</html>
