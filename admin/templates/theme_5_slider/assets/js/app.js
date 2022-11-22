 (function ($) {
   "use strict";


   /*
------------------------  
 Testimonial  5
--------------------------
*/


if ($(".rst-box-5").length > 0) {


  $('.rst-slider').slick({
    autoplay: false,
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
        breakpoint: 1020,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 734,
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