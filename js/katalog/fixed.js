$(function () {
 
  var msie6 = $.browser == 'msie' && $.browser.version < 7;
  if (!msie6) {
    var top = $('#box').offset().top;
    $(window).scroll(function (event) {
      var y = $(this).scrollTop();
      if (y >= top) { $('#box').addClass('fixed'); }
      else { $('#box').removeClass('fixed'); }
    });
  }
});