var Pinfee = {};


Pinfee.showCover = function(){
  $body = $('body');
  var $cover = $('<div></div>')
    .addClass('js-cover')
    .css({
      position: 'absolute',
      top: 0,
      left: 0,
      width: '100%',
      height: $body.height(),
      //opacity: 0.5,
      //backgroundColor: '#000',
      zIndex: 99999999
    });
    $body.append($cover);
};

Pinfee.hideCover = function(){
  $('body').find('.js-cover').remove();
};

/**
 * Query-String の中に含まれているページ番号を 1 増やす
 *
 * @return {String} e.g. 'a=1&b=2&c=3', '?'は無い
 */
Pinfee.replaceQueryStringPageNumberToNext = function(qs){
  var params = querystring.parse(qs);
  if ('page' in params) {
    params.page = ~~params.page + 1;
  } else {
    params.page = 2;  // なしは 1 ページ目だったと判断する
  }
  return querystring.stringify(params);
};

/**
 * HTMLページをWeb-APIとして使用し、現ページのリストへアイテムを追加する
 *
 * @return {jQuery.Deferred promise} ({$doc})
 */
Pinfee.autoPagerize = function(apiUrl, itemsSelector, itemSelector){
  var dfd = new $.Deferred();
  $.ajax({
    url: apiUrl,
    dataType: 'html',
    success: function(data){
      var $items = $(itemsSelector);
      var doc = (new DOMParser()).parseFromString(data, 'text/html');
      var $doc = $(doc);
      var $newItems = $doc.find(itemsSelector).find(itemSelector);
      $newItems.each(function(i, el){
        $items.append($(el));
      });
      dfd.resolve({
        $doc: $doc
      });
    }
  });
  return dfd.promise();
};
