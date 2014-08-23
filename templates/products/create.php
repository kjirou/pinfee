<html>
<head>
  <?php render('partials/meta_tags.php') ?>
  <title>サービスを登録する | Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <?php render('partials/header.php') ?>

  <form action="./create.php" method="post">
    <div>
      <input type="text" name="title" value="<?= h($inputs['title']) ?>" placeholder="例えば、Pinfee" />
      <?php if ($errors['title']) : ?>
      <p>必ず入力して下さい。</p>
      <?php endif ?>
    </div>
    <div>
      <input type="text" name="url" value="<?= h($inputs['url']) ?>" placeholder="例えば、http://pinfee.com" />
      <?php if ($errors['url']) : ?>
      <p>http または https から始まる URL を入力して下さい。</p>
      <?php endif ?>
    </div>
    <div>
      <textarea name="description" placeholder="例えば、プロダクト一覧をみたいときに便利です。
商品の説明などはここに記入することでユーザーがわかりやすくなります。
記入していただくのがオススメです。"><?= h($inputs['description']) ?></textarea>
    </div>
    <div>
      <input type="submit" value="上記の内容で登録する" />
    </div>
  </form>

  <?php render('partials/footer.php') ?>
</body>
</html>
