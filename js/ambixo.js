/*-------------------------------------------------------------------------

  Template Name: Ambixo
  Author: Martina Sepi 
  Author URL: http://www.martinasepi.it
  License: GNU GENERAL PUBLIC LICENSE
  
-------------------------------------------------------------------------*/

var plan='costa_atlantica', plans = null, currPlan = null, currList = null, aboutContent = null;
var option='la_agencia', options = null, currOption = null;

$(".mainImg").click(function (){
  id = $(this).attr("id");
  console.log("Curr: " + id);
  window.location.href = 'plans.php?plan=' + id;
  return false;
});

$(".opt-menu-item > a > img").hover(function() {
    $(this).attr("src", function(index, attr) {
        return attr.replace(".png", "-Back.png");
    });
}, function(){
    $(this).attr("src", function(index, attr){
        return attr.replace("-Back.png", ".png");
    });
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
  $("#photos #planDescription").html(currPlan.description + "<br><a href='" + "http://" + publicName + publicPath + "admin/files/" + currPlan.url2 + "' >Descargue Informaci&oacute;n Completa</a>");
  $("#photos #planMainImage").attr("src", "pictures/" + currPlan.image);
}

function setTextContent() {
	if(currPlan.travel_route) {
		currList = $("#route #routeDescription");
		$.each(currPlan.travel_route, function(index, element) {
			addListItem(element, index);
		});
	}
	
	if(currPlan.included) {
		currList = $("#included #includeDescription");
		$.each(currPlan.included, function(index, element) {
			addListItem(element, index);
		});
	}
	
	if(currPlan.optional) {
		currList = $("#no_included #optionalDescription");
		$.each(currPlan.optional, function(index, element) {
			addListItem(element, index);
		});
	}  

	if(currPlan.not_included) {
		currList = $("#no_included #notIncludeDescription");
		$.each(currPlan.not_included, function(index, element) {
			addListItem(element, index);
		});
	}
	
	if(currPlan.date) {
		currList = $("#date_price #dateDescription");
		$.each(currPlan.date, function(index, element) {
			addListItem(element, index);
		});
	}

	if(currPlan.prices) {	
		currList = $("#date_price #priceDescription");
		$.each(currPlan.prices, function(index, element) {
			addListPriceItem(element, index);
		});
	}
}

function addListPriceItem(element, index) {
  html = "<tr><td>" + element.title + "</td>";
  html = html + "<td>" + element.hotel + "</td>";
  if (element.price) {
	  html = html + "<td class='price'>" + element.price[1] + "</td>";
	  html = html + "<td class='price'>" + element.price[2] + "</td>";
	  html = html + "<td class='price'>" + element.price[3] + "</td>";
	  html = html + "<td class='price'>" + element.price[4] + "</td>";
  }
  html = html + "</tr>";
  currList.append(html);
}

function addListItem(element, index) {
  if(element.title) {
    currList.append("<strong>" + element.title + ": </strong>" + element.description);
  } else {
    currList.append(element);
  }
}

function setAboutContent() {
  title = $("#mainAboutTitle");
  content = $("#aboutContent");
  title.html(currOption.title);
  content.html(currOption.description);
}

function setPlansContent (plan) {
	var urlRequest = "http://" + publicName + publicPath + "_drvGuiCont.php";

    $.ajax({
        type: "POST",
        dataType: "json",
        url: urlRequest,
        data: {
            type: "plans",
			section: plan
        }
    }).done(function(jsRet) {
		data = jsRet;
		plans = data.plans;
		currPlan = plans[plan];
		setPlanMainImg();
		setTextContent();
    });
}

function setOptionsContent (opt) {
	var urlRequest = "http://" + publicName + publicPath + "_drvGuiCont.php";

    $.ajax({
        type: "POST",
        dataType: "json",
        url: urlRequest,
        data: {
            type: "about",
			section: opt
        }
    }).done(function(jsRet) {
		data = jsRet;
		options = data.about;
		currOption = options[opt];
		setAboutContent();
    });
}