(function($){

  "use strict";

  $(window).on('load', function() {

    // Preloader
    $('.loader').fadeOut();
    $('.loader-mask').delay(350).fadeOut('slow');

    $(window).trigger("resize");

  });


  $(window).resize(function(){
    stickyNavRemove();
  });

  // Init
  initOwlCarousel();


  /* Detect Browser Size
  -------------------------------------------------------*/
  var minWidth;
  if (Modernizr.mq('(min-width: 0px)')) {
    // Browsers that support media queries
    minWidth = function (width) {
      return Modernizr.mq('(min-width: ' + width + 'px)');
    };
  }
  else {
    // Fallback for browsers that does not support media queries
    minWidth = function (width) {
      return $(window).width() >= width;
    };
  }


  /* Mobile Detect
  -------------------------------------------------------*/
  if (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent || navigator.vendor || window.opera)) {
     $("html").addClass("mobile");
     $('.dropdown-toggle').attr('data-toggle', 'dropdown');
  }
  else {
    $("html").removeClass("mobile");
  }

  /* IE Detect
  -------------------------------------------------------*/
  if(Function('/*@cc_on return document.documentMode===10@*/')()){ $("html").addClass("ie"); }


  /* Sticky Navigation
  -------------------------------------------------------*/
  $(window).scroll(function(){

    scrollToTop();
    var $stickyNav = $('.nav--sticky');

    if ($(window).scrollTop() > 2 & minWidth(992)) {
      $stickyNav.addClass('sticky');
      $('.nav').addClass('sticky');
    } else {
      $stickyNav.removeClass('sticky');
      $('.nav').removeClass('sticky');
    }

  });

  function stickyNavRemove() {
    if (!minWidth(992)) {
      $('.nav--sticky').removeClass('sticky');
    }
  }



  /* Mobile Navigation
  -------------------------------------------------------*/
  var $dropdownTrigger = $('.nav__dropdown-trigger');
  $dropdownTrigger.on('click', function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    }
    else {
      $(this).addClass("active");
    }
  });
  

  if ( $('html').hasClass('mobile') ) {
    $('body').on('click',function() {
      $('.nav__dropdown-menu').addClass('hide-dropdown');
    });

    $('.nav__dropdown').on('click', '> a', function(e) {
      e.preventDefault();
    });

    $('.nav__dropdown').on('click',function(e) {
      e.stopPropagation();
      $('.nav__dropdown-menu').removeClass('hide-dropdown');
    });
  }  


  /* Accordion
  -------------------------------------------------------*/
  function toggleChevron(e) {
    $(e.target)
      .prev('.accordion-panel__heading')
      .find("a")
      .toggleClass('plus minus');
  }
  $('#accordion').on('hide.bs.collapse', toggleChevron);
  $('#accordion').on('show.bs.collapse', toggleChevron);



  /* Tabs
  -------------------------------------------------------*/
  $('.tabs__link').on('click', function(e) {
    var currentAttrValue = $(this).attr('href');
    $('.tabs__content ' + currentAttrValue).stop().fadeIn(1000).siblings().hide();
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    e.preventDefault();
  });



  /* Owl Carousel
  -------------------------------------------------------*/
  function initOwlCarousel(){
    (function($){
      "use strict";

      // Featured Posts
      $("#owl-hero").owlCarousel({
        center: true,
        items:1,
        autoplay: false,
        loop:true,
        nav:true,
        navSpeed: 500,
        navText: ['<i class="ui-arrow-left">','<i class="ui-arrow-right">'],
        margin:40,
        responsive:{
          600:{ stagePadding: 150 },
          800:{ stagePadding: 220 },
          1100:{ stagePadding: 250 },
          1400:{ stagePadding: 300 },
          1700:{ stagePadding: 500 }
        }
      });


      // Gallery post
      $(".owl-single").owlCarousel({
        items:1,
        loop:true,
        nav:true,
        animateOut: 'fadeOut',
        navText: ['<i class="ui-arrow-left">','<i class="ui-arrow-right">']
      });

    })(jQuery);
  };


  /* Skip Link Focus Fix
  -------------------------------------------------------*/
  var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
      is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
      is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
    window.addEventListener( 'hashchange', function() {
      var element = document.getElementById( location.hash.substring( 1 ) );

      if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
          element.tabIndex = -1;

        element.focus();
      }
    }, false );
  }



  /* Scroll to Top
  -------------------------------------------------------*/
  function scrollToTop() {
    var scroll = $(window).scrollTop();
    var $backToTop = $("#back-to-top");
    if (scroll >= 50) {
      $backToTop.addClass("show");
    } else {
      $backToTop.removeClass("show");
    }
  }

  $('a[href="#top"]').on('click',function(){
    $('html, body').animate({scrollTop: 0}, 1350, "easeInOutQuint");
    return false;
  });


})(jQuery);