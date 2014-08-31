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
 * HTMLページをWeb-APIとして使用し、現ページのリストへアイテムを追加する
 *
 * @return {$.Deferred}
 */
Pinfee.autoPagerize = function(apiUrl, itemsSelector, itemSelector){
  return $.ajax({
    url: apiUrl,
    dataType: 'html',
    success: function(data){
      var $items = $(itemsSelector);
      var doc = (new DOMParser()).parseFromString(data, 'text/html');
      var $newItems = $(doc).find(itemsSelector).find(itemSelector);
      $newItems.each(function(i, el){
        $items.append($(el));
      });
    }
  });
};
