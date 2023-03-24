
/*----- slier --------*/
$('.slider').slick({
  autoplay: false,
  speed: 2000,
  lazyLoad: 'progressive',
  arrows: false,
  dots: true,
	prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
}).slickAnimation();

$('.slick-nav').on('click touch', function(e) {

    e.preventDefault();

    var arrow = $(this);

    if(!arrow.hasClass('animate')) {
        arrow.addClass('animate');
        setTimeout(() => {
            arrow.removeClass('animate');
        }, 2000);
    }

});


$('.cata_slider').slick({
  dots: false,
  arrows:false,
  autoplay: false,
  infinite: true,
  centerMode: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 1,
  prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-regular fa-angle-left"></i></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i class="fa-regular fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1441,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.product_slider').slick({
  dots: false,
  arrows:false,
  autoplay: true,
  infinite: true,
  centerMode: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-regular fa-angle-left"></i></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i class="fa-regular fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1441,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.offer_slider').slick({
  dots: false,
  arrows:false,
  autoplay: true,
  infinite: true,
  centerMode: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-regular fa-angle-left"></i></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i class="fa-regular fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.blog_slider').slick({
  dots: false,
  arrows:false,
  autoplay: true,
  infinite: true,
  centerMode: false,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 1,
  prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-regular fa-angle-left"></i></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i class="fa-regular fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


$('.related_product_slid').slick({
  dots: false,
  arrows:false,
  autoplay: true,
  infinite: true,
  centerMode: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-regular fa-angle-left"></i></div>',
	nextArrow: '<div class="slick-nav next-arrow"><i class="fa-regular fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});









$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: true,
  centerMode: false,
  centerPadding: '60px',
  focusOnSelect: true
});

















/*----- slier --------*/



/*----- Price range --------*/
function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 1 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 1 : value;
  value < 2 ? value = 2 : '';
  value--;
  document.getElementById('number').value = value;
}
/*----- Price range --------*/





AOS.init();
