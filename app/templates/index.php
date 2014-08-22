<html>
<body>
  <h1>Top Page</h1>

  <ul>
  <?php foreach ($products as $index => $row) : ?>
    <li><a href="<?= h($row['url']) ?>" target="_blank"><?= h($row['title']) ?></a></li>
  <?php endforeach ?>
  </ul>

  <footer>
  </footer>
</body>
</html>
