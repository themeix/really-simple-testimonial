 (function ($) {
   "use strict";
   /*
    ------------------------  
   Testimonial Slider-58
    --------------------------
    */



  if ($(".rst-testimonial-box-7 ").length > 0) {

    $('.rst-slider').slick({
      autoplay: false,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      fade: false,
      slidesToShow: 2,
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