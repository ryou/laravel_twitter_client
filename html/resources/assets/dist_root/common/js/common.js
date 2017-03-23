/***********************************************************************
サイト全体で使用する関数、変数などはMYAPP内に追加
**********************************************************************/
var MYAPP = {
  browser: {
    isMac          : navigator.platform.indexOf('Mac') != -1,
    isAndroid      : navigator.userAgent.indexOf('Android') != -1,
    isWindowsPhone : navigator.userAgent.indexOf('Windows Phone') != -1,
    isBlackBerry   : navigator.userAgent.indexOf('BlackBerry') != -1,
    isIPhone       : navigator.userAgent.indexOf('iPhone') != -1,
    isIPad         : navigator.userAgent.indexOf('iPad') != -1,
    isIPod         : navigator.userAgent.indexOf('iPod') != -1,
    isIE6          : navigator.appVersion.indexOf('MSIE 6.0') > -1,
    isIE7          : navigator.appVersion.indexOf('MSIE 7.0') > -1,
    isIE8          : navigator.appVersion.indexOf('MSIE 8.0') > -1,
    isIE9          : navigator.appVersion.indexOf('MSIE 9.0') > -1,
    isChrome       : navigator.userAgent.indexOf('Chrome/') != -1 || navigator.userAgent.indexOf('Mac/') != -1 || navigator.userAgent.indexOf('Win/') != -1 && window.chrome,
    isSafari       : navigator.userAgent.indexOf('Safari/') != -1 && !window.chrome && !navigator.userAgent.indexOf('Mobile/')
  },
  // 元々あったWinInfoを、サイト全体で使用できるようMYAPP内で宣言
  // MYAPP.WinInfo.h 等で情報を取得可能
  WinInfo: {
    h: null,
    w: null,
    t: null,
    init: function(config) {
      var self = this;
      var options = $.extend({
                      h:false,
                      w:false,
                      t:false
                    }, config);

      $(window).on('resize', function() {
        if (options.h) self.h = $(window).height();
        if (options.w) self.w = $(window).width();
      });
      $(window).scroll(function(){
        if (options.t) self.t = $(window).scrollTop();
      });

      if(options.h || options.w || options.t){
        $(window).trigger('scroll').trigger('resize');
      }
    }
  } // WinInfo
};


;(function($,win,doc){

  /**
   ** Smooth Scroll
   **/
  $.fn.smoothScroll= function(){
    $(this).click(function() {
      // スクロールの速度
      var speed = 300;// ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href === "#" || href === "" ? 'html' : href);

      // 移動先が無い場合
      if(target.length===0) return false;

      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('html,body').stop().animate({scrollTop:position}, speed, 'swing');

      return false;
    });

    return this;

  };


  /**
   ** Hover Image
   **/
  $.fn.hovImg = function(str){

    var postfix = str;
    var ovImgFadeTime = 300;

    $(this).not('[src*="'+ postfix +'."]').each(function() {
      var img = $(this);
      var src = img.attr('src');
      var src_on = src.substr(0, src.lastIndexOf('.')) + postfix + src.substring(src.lastIndexOf('.'));
      var img_on = $('<img class="img_on">');

      $(img_on).attr('src', src_on);

      if(img.hasClass("js-ovImgFd") && !MYAPP.browser.isIE6 ){
        $(img_on).css({'position':'absolute','opacity':0}).insertBefore(img);
        img_on.hover(function() {
          $(img_on).stop().animate({'opacity':1},ovImgFadeTime);
        }, function() {
          $(img_on).stop().animate({'opacity':0},ovImgFadeTime);
        });
      } else {
        img.hover(function() {
          img.attr('src', src_on);
        }, function() {
          img.attr('src', src);
        });
      }
    });

    return this;

  };


  //start
  $(function(){

    $('a.js-scroll[href^="#"]').smoothScroll();
    $('.js-ovImg,.js-ovImgFd').hovImg('_on');

    MYAPP.WinInfo.init({
      h: false,
      w: false,
      t: false
    });
  });

  /*
   * 無限ローダー
   *
   * Twitter APIでは、200ツイートを一度に取得出来るが、それを一度に表示しようとすると
   * 画像の読み込みに時間がかかりページ表示が遅くなってしまうので、最初は一部だけ表示して、
   * 無限ローダーにより徐々に表示させることにする。
   * 別に無限ローダーでAPIからツイートを取得しにいってるわけではない
   */
  (function() {
    $(window).on('scroll resize', function() {
      var $hiddenItems = $('.m-tweetList_item.is-hidden');

      if ($hiddenItems.length < 0) {
        return;
      }

      var $list  = $('.m-tweetList');
      var listT  = $list.offset().top;
      var listB  = listT + $list.outerHeight();
      var winH   = $(window).height();
      var scrT   = $(window).scrollTop();
      var scrB   = winH + scrT;
      var margin = 100;

      if (scrB + margin >= listB) {
        var $displayItems = $hiddenItems.slice(0, 19);

        $displayItems.removeClass('is-hidden');
      }
    });
  })();

  /*
   * action btn
   */
  (function() {
    var $actionBtns = $('.m-actionBtn');

    $actionBtns.each(function() {
      $(this).data('conectting', 'false');
    });

    $actionBtns.on('click', function() {
      var $btn = $(this);
      var id   = $btn.data('id');
      var url  = null;

      if ($btn.data('conectting') === 'true') return false;

      if ($btn.hasClass('m-actionBtn-rt')) {
        if ($btn.hasClass('is-active')) {
          url = '/statuses/unretweet/' + id;
        } else {
          url = '/statuses/retweet/' + id;
        }
      } else if($btn.hasClass('m-actionBtn-fav')) {
        if ($btn.hasClass('is-active')) {
          url = '/favorites/destroy/' + id;
        } else {
          url = '/favorites/create/' + id;
        }
      }

      $.ajax({
        url: url,
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .done(function() {
        //
      })
      .always(function() {
        $btn.data('conectting', 'false');
      });

      $btn.toggleClass('is-active');
      $btn.data('conectting', 'true');

      return false;
    });
  })();

})(jQuery,window,document);
