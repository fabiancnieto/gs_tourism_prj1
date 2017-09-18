/*-------------------------------------------------------------------------

  Template Name: Ambixo
  Author: Martina Sepi 
  Author URL: http://www.martinasepi.it
  License: GNU GENERAL PUBLIC LICENSE
  
-------------------------------------------------------------------------*/

var plan='costa_atlantica', plans = null, currPlan = null, currList = null;
var option='la_agencia', options = null, currOption = null;

$(".mainImg").click(function (){
  id = $(this).attr("id");
  console.log("Curr: " + id);
  window.location.href = 'plans.php?plan=' + id;
  return false;
});

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

function setPlanMainImg() {
  $("#photos #planMainTitle").html(currPlan.title);
  $("#photos #planDescription").html(currPlan.description);
  $("#photos #planMainImage").attr("src", "pictures/" + currPlan.image);
}

function setTextContent() {
  currList = $("#route #routeDescription");
  $.each(currPlan.travel_route, function(index, element) {
    addListItem(element, index);
  });

  currList = $("#included #includeDescription");
  $.each(currPlan.included, function(index, element) {
    addListItem(element, index);
  });

  currList = $("#no_included #optionalDescription");
  $.each(currPlan.optional, function(index, element) {
    addListItem(element, index);
  });
  
  currList = $("#no_included #notIncludeDescription");
  $.each(currPlan.not_included, function(index, element) {
    addListItem(element, index);
  });

  currList = $("#date_price #dateDescription");
  $.each(currPlan.date, function(index, element) {
    addListItem(element, index);
  });

  currList = $("#date_price #priceDescription");
  $.each(currPlan.prices, function(index, element) {
    addListPriceItem(element, index);
  });
}

function addListPriceItem(element, index) {
  html = "<tr><td>" + element.title + "</td>";
  html = html + "<td>" + element.hotel + "</td>";
  html = html + "<td class='price'>" + element.price[1] + "</td>";
  html = html + "<td class='price'>" + element.price[2] + "</td>";
  html = html + "<td class='price'>" + element.price[3] + "</td>";
  html = html + "<td class='price'>" + element.price[4] + "</td></tr>";
  currList.append(html);
}

function addListItem(element, index) {
  if(element.title) {
    currList.append("<li><p><strong>" + element.title + ": </strong>" + element.description + "</p></li>");
  } else {
    currList.append("<li><p>" + element + "</p></li>");
  }
}

function setAboutContent() {
  title = $("#mainAboutTitle");
  content = $("#aboutContent");
  title.html(currOption.title);
  content.html(currOption.description);
}

function setPlansContent (plan) {
  completePath = "http://" + publicName + publicPath + "data/plans.json";

  var jqxhr = $.getJSON( completePath, function(data) {
    plans = data.plans;
    currPlan = plans[plan];
    setPlanMainImg();
    setTextContent();
  })
  .fail(function() {
    console.log( "error" );
  });
}

function setOptionsContent (opt) {
  completePath = "http://" + publicName + publicPath + "data/about.json";

  var jqxhr = $.getJSON( completePath, function(data) {
    options = data.about;
    currOption = options[opt];
    setAboutContent();
  })
  .fail(function() {
    console.log( "error" );
  });
}