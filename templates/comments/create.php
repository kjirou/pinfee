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
