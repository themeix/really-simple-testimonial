 (function ($) {
   "use strict";

   /*
  ------------------------  
 Testimonial Slider-11
  --------------------------
  */
   if ($(".rst-style-3 ").length > 0) {
     $('.thumbs-slider-3').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       asNavFor: '.nav-slider-3',
       dots: true,
       arrows: true,
       prevArrow: $('.slider-prev-3'),
       nextArrow: $('.slider-next-3'),
       autoplay: false,
       centerMode: true,
       infinite: true,
       focusOnSelect: true,
       centerPadding: '0px',
     });
     $('.nav-slider-3').slick({
       slidesToShow: 1,
       arrows: false,
       fade: true,
       dots: false,
       infinite: true,
       slidesToScroll: 1,
       /*fade: true,*/
       cssEase: 'linear',
       dots: false,
       asNavFor: '.thumbs-slider-3'
     });
   }
  
 }(jQuery));