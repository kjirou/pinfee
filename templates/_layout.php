<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Pinfee</title>
  <link href='http://fonts.googleapis.com/css?family=Fugaz+One|Fredoka+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/css/base.css" type="text/css" />
  <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src="/js/vendor/underscore-min.js"></script>
  <script src="/js/vendor/querystring.js"></script>
  <script src="/js/vendor/jquery-2.1.1.min.js"></script>
  <script src="/js/index.js"></script>
</head>
<body>
  <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <header class="header">
    <h1><a href="/"><?= h($site_name) ?></a></h1>
    <nav>
      <ul>
        <li><a href="/products/create.php" class="register">サービスを登録する</a></li>
        <li><a href="javascript:void(0)" class="magnifier"><span class="hidden">(検索)</span></a></li>
      </ul>
    </nav>
  </header>

  <div><?= $content ?></div>

  <footer>
    <div class="newsletter">
      <p class="caps">メールマガジンで最新情報を見逃すことがなくなります。</p>
      <p class="sub">ビシネスマンの毎朝毎晩のメールチェックや、就活生の面接での話題、業界の動向調査などにご活用下さい。</p>
      <form action="/recipients/create.php" method="post">
        <input type="text" name="email" class="enter-input" />
        <input type="submit" value="登録する" class="submit-input" />
      </form>
    </div>
    <div class="about">
      <h6>About Pinfee</h6>
      <p>土曜・休日に、通勤定期券所持者と同居ご家族が、東京ベイ シティバスの一般バス路線全線に、現金でのお支払いに限り、 おとな 100 円、こども 50 円でご乗車いただけるサービスで す。エコサービス制度は、現金でのお支払いにのみ適用され ます。IC カードでのお支払いには適用されません。</p>
      <a class="inquiry" href="#">お問い合せ</a>
    </div>
  </footer>

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
