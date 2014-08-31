<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <?php render('partials/meta_tags.php') ?>
  <title>Pinfee</title>
  <?php render('partials/assets.php') ?>
</head>
<body>
  <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <?php render('partials/header.php') ?>

  <?php if ($notification) : ?>
  <?php render('partials/notification.php', array('notification' => $notification)) ?>
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
  <input type="hidden" class="js-is-enabled-more-products"
    value="<?= h($pagination['is_last_or_above'] ? 0 : 1) ?>" />

  <?php render('partials/footer.php') ?>

  <script>
  (function(){
    var productsSelector = '.js-products:first';
    var $products = $(productsSelector);
    var moreProductsButtonSelector = '.js-more-products-button-container:first';
    var isEnabledMoreProductsSelector = '.js-is-enabled-more-products:first';

    var createNextPageApiUrl = function(url){
      var urlObj = new URL(url);
      var qs = Pinfee.replaceQueryStringPageNumberToNext(urlObj.search);
      return urlObj.origin + urlObj.pathname + '?' + qs;
    };

    // もっと読むボタン
    var apiUrl = createNextPageApiUrl(document.URL);
    $('.js-more-products-button').on('mousedown', function(){
      Pinfee.showCover();
      Pinfee.autoPagerize(apiUrl, productsSelector, '.js-products-item').then(function(data){
        apiUrl = createNextPageApiUrl(apiUrl);
        // 最終ページだったか
        var isLastPage = data.$doc.find(isEnabledMoreProductsSelector).val() === '0';
        if (isLastPage) {
          $(moreProductsButtonSelector).hide();
        }
        Pinfee.hideCover();
      });
    });
  })();
  </script>
</body>
</html>
