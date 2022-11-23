 (function ($) {
   "use strict";
 
  
   /*
  ------------------------  
 Testimonial Slider-17
  --------------------------
  */


  if ($(".rst-testimonial-box-8").length > 0) {
    $('.rst-slider').slick({
      autoplay: true,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      fade: false,
      slidesToShow: 3,
      arrows: true,
      dots: true,
      prevArrow: $('.rst-slider-prev'),
      nextArrow: $('.rst-slider-next'),
      responsive: [{
          breakpoint: 1030,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 770,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 610,
          settings: {
            slidesToShow: 1
          }
        },
  
      ]
    });

  }
 }(jQuery));