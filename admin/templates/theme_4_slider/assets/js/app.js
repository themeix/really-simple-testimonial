 (function ($) {
   "use strict";


   
   /*
  ------------------------  
 Testimonial Slider 4
  --------------------------
  */

  if ($(".rst-box-4 ").length > 0) {

  $('.rst-slider').slick({
    autoplay: false,
    autoplaySpeed: 2000,
    infinite: true,
    speed: 1000,
    fade: false,
    slidesToShow: 2,
    arrows: true,
    dots: true,
    prevArrow: $('.slider-prev'),
    nextArrow: $('.slider-next'),
    responsive: [{
        breakpoint: 1030,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 770,
        settings: {
          slidesToShow: 1
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