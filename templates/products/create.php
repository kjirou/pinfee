<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title>サービスを登録する | Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <form action="./create.php" method="post">
    <input type="submit" value="上記の内容で登録する" />
  </form>

  <?php render('partials/footer.php') ?>
</body>
</html>
