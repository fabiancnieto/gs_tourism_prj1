/*-------------------------------------------------------------------------

  Template Name: Ambixo
  Author: Martina Sepi 
  Author URL: http://www.martinasepi.it
  License: GNU GENERAL PUBLIC LICENSE
  
-------------------------------------------------------------------------*/

var plan='costa_atlantica';

$(document).ready(function () {


//LOGO SCROLL ----------------------------------------------------------------------------/

  $(".logo a").click(function(){
    $('html, body').animate({ scrollTop: 0 }, 300);
  });


//STICKY HEADER -----------------------------------------------------------------/

  if ($(".header")[0]){
    $('.header').before('<div class="sticky-padding"></div>');
    $(window).scroll(function(){
      var wind_scr = $(window).scrollTop();
      var window_width = $(window).width();
      var head_w = $('.header').height();
      if (window_width >= 10) {
        if(wind_scr < 100){
          if($('.header').data('animated-header') === true){
            $('.header').data('animated-header', false);
            $('.header').stop(true).animate({opacity : 1}, 300, function(){
              $('.header').removeClass('animated-header');
              $('.header').stop(true).animate({opacity : 1}, 300);
              $('.sticky-padding').css('padding-top', '');
            });
          }
        } else {
          if($('.header').data('animated-header') === false || typeof $('.header').data('animated-header') === 'undefined'){
            $('.header').data('animated-header', true);
            $('.header').stop(true).animate({opacity : 1},300,function(){
              $('.header').addClass('animated-header');
              $('.header.animated-header').stop(true).animate({opacity : 0.95}, 300);
              $('.sticky-padding').css('padding-top', 104 + 'px');
            });
          }
        }
      }
    });
  }

//NAV SCROLL ----------------------------------------------------------------------------/

  $('#main-nav').localScroll(100);

//BACK TO TOP --------------------------------------------------------------------------------/

  var offset = 100;
  var duration = 500;
  jQuery(window).scroll(function() {
      if (jQuery(this).scrollTop() > offset) {
          jQuery('.back-to-top').fadeIn(duration);
      } else {
          jQuery('.back-to-top').fadeOut(duration);
      }
  });     
  $('.back-to-top').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({scrollTop: 0}, duration);
      return false;
  })

  
});

function setPlansContent (plan) {
  var plansJson = "file";///require('./data/plans.json');
}