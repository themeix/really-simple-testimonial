 (function ($) {
   "use strict";
   /*
  ------------------------  
 Testimonial Slider-2
  --------------------------
  */



  if ($('.rst-style-2').length > 0) {
     
    $(".slider").slick({
      dots: false,
      arrows: false,
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      fade: true,
      dots: true,
      customPaging: function (slider, i) {
        var thumb = $(slider.$slides[i]).data('thumb');
        return '<a><img src="' + thumb + '"></a>';
      },
      responsive: [{
          breakpoint: 1030,
          settings: {
            slidesToShow: 1,
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