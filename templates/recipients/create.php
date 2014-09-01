<h2>メールマガジンへ登録する</h2>

<form action="./create.php" method="post">
  <div>
    <input type="text" name="email" value="<?= h($inputs['email']) ?>" />
    <?php if ($errors['email']) : ?>
    <p>正しいメールアドレスを入力して下さい。</p>
    <?php endif ?>
  </div>
  <div>
    <input type="submit" value="上記の内容で登録する" />
  </div>
</form>
