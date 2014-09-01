<?php if ($notification) : ?>
<?= render('_partials/notification.php', array('notification' => $notification)) ?>
<?php endif ?>

<div class="js-products">
  <?php foreach ($products as $index => $product) : ?>
  <div class="caset js-products-item">
    <a class="like-circle" href="javascript:void(0);">LIKE?</a>
    <!-- <a class="icon32 icon-pin pin" href="javascript:void(0)">LIKE!</a> -->
    <h2><a href="/products/show.php?id=<?= h($product['id']) ?>"><?= h($product['title']) ?></a></h2>
    <ul>
      <li><a href="<?= h($product['url']) ?>" class="url" target="_blank"><?= h($product['url']) ?></a></li>
      <li class="sub"><?= h($product['description']) ?></li>
    </ul>
    <ul class="score clearfix">
      <li class="comment"><span class="icon32 icon-comment"></span><?= h($product['comment_count']) ?></li>
      <li class="like"><span class="icon32 icon-pin-slash"></span><?= h($product['like_count']) ?></li>
    </ul>
  </div>
  <?php endforeach ?>
</div>

<?php if (!$pagination['is_last_or_above']) : ?>
<div class="more js-more-products-button-container">
  <a href="javascript:void(0);" class="js-more-products-button">もっと見る</a>
</div>
<?php endif ?>
<?php // このページはWeb-APIとしても使われるので読み込み終了フラグを別途渡している ?>
<input type="hidden" class="js-is-enabled-more-products" value="<?= h($pagination['is_last_or_above'] ? 0 : 1) ?>" />
