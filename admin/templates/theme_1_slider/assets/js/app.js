 (function ($) {
   "use strict";

  
 /*
  ------------------------  
 Testimonial Slider-9
  --------------------------
  */



  if ($('.rst-style-1').length > 0) {
     
    $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav',
      verticalSwiping: true,
      focusOnSelect: true,
      accessibility: false,
      draggable: false,
    });
    $('.slider-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      vertical: true,
      asNavFor: '.slider-for',
      dots: false,
      arrows: false,
      verticalSwiping: true,
      focusOnSelect: true,
      accessibility: false,
      draggable: false,
    });

  }


 }(jQuery));