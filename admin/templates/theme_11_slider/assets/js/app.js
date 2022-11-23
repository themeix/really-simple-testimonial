 (function ($) {
   "use strict";
  
   
   /*
  ------------------------  
 Testimonial Slider-6
  --------------------------
  */
 

  if ($(".rst-box-6").length > 0) {
    $('.rst-thumbs').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.rst-nav-box',
      dots: false,
      arrows: true,
      prevArrow: $('.rst-prev'),
      nextArrow: $('.rst-next'),
      autoplay: false,
      centerMode: true,
      infinite: true,
      focusOnSelect: true,
      centerPadding: '0px',
    });
    $('.rst-nav-box').slick({
      slidesToShow: 1,
      arrows: false,
      dots: false,
      infinite: true,
      slidesToScroll: 1,
      /*fade: true,*/
      cssEase: 'linear',
      dots: false,
      asNavFor: '.rst-thumbs'
    });


  }



 }(jQuery));