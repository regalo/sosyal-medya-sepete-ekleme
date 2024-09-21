var storycountx = storycount-1;
var owl = $('.story');
owl.owlCarousel({
    loop:false,
    nav: false,
    dots: false,
	responsive: {
          0: {
            items: 1,
            stagePadding: 25,
			margin:10,
		    autoplay:false,
          },
          600: {
            items: 2,
            stagePadding: 20,
			margin:10,
		    autoplay:false,
          },
          800: {
            items: storycountx,
	  		stagePadding: 20,
			autoplay:true,
			margin:10,
		    autoplayTimeout:8000,
		    autoplayHoverPause:true,
          },
          1000: {
            items: storycount,
            autoplay:true,
            margin:10,
		    autoplayTimeout:8000,
		    autoplayHoverPause:true,
          }
        }
	});
var owl = $('.mustu');
owl.owlCarousel({
    items:1,
    loop:false,
    nav: false,
    dots: false,
	responsive: {
	      0: {
	        items: 1,
  			stagePadding: 25,
			autoplay:false,
			margin:10,
	      },
	      600: {
	        items: 2,
  			stagePadding: 20,
			autoplay:true,
			margin:10,
		    autoplayTimeout:8000,
		    autoplayHoverPause:true,
	      },
	      800: {
	        items: 3,
  			stagePadding: 20,
			autoplay:true,
			margin:10,
		    autoplayTimeout:8000,
		    autoplayHoverPause:true,
	      },
	      1000: {
	        items: 4,
			margin:10,
			autoplay:true,
		    autoplayTimeout:8000,
		    autoplayHoverPause:true,
	      }
	    }
	});

(function () {
  "use strict";

  var carousels = function () {
    $(".owl-carousel1").owlCarousel({
      loop: true,
      center: true,
      margin: 0,
      responsiveClass: true,
      nav: false,
      autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      responsive: {
        0: {
          items: 1,
          nav: false,
      	  stagePadding: 20,
        },
        680: {
          items: 1,
          nav: false,
          loop: false,
          stagePadding: 20,
        },
        1000: {
          items: 3,
          nav: true,
          stagePadding: 50,
        }
      }
    });
  };

  (function ($) {
    carousels();
  })(jQuery);
})();


