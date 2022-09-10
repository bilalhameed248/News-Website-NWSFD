$(document).ready(function(){
  $('.customer-logos').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      arrows: false,
      dots: false,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 768,
          settings: {
              slidesToShow: 3
          }
      }, {
          breakpoint: 520,
          settings: {
              slidesToShow: 2
          }
      }]
  });
});

// Senior Management Jobs 
$(document).ready(function()
{


if($('.bbb_viewed_slider').length)
{
var viewedSlider = $('.bbb_viewed_slider');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:2},
768:{items:3},
991:{items:4},
1199:{items:6}
}
});

if($('.bbb_viewed_prev').length)
{
var prev = $('.bbb_viewed_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.bbb_viewed_next').length)
{
var next = $('.bbb_viewed_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});


// Premium Jobs
$(document).ready(function()
{


if($('.premium_jobs_slider').length)
{
var viewedSlider = $('.premium_jobs_slider');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:1},
768:{items:1},
991:{items:1},
1199:{items:1}
}
});

if($('.premium_jobs_prev').length)
{
var prev = $('.premium_jobs_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.premium_jobs_next').length)
{
var next = $('.premium_jobs_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});

// top professional slider
$(document).ready(function()
{


if($('.top_proffessional_slider').length)
{
var viewedSlider = $('.top_proffessional_slider');

viewedSlider.owlCarousel(
{
loop:true,
margin:30,
autoplay:true,
autoplayTimeout:6000,
nav:false,
dots:false,
responsive:
{
0:{items:1},
575:{items:1},
768:{items:2},
991:{items:4},
1199:{items:5}
}
});

if($('.top_proffessional_prev').length)
{
var prev = $('.top_proffessional_prev');
prev.on('click', function()
{
viewedSlider.trigger('prev.owl.carousel');
});
}

if($('.top_proffessional_next').length)
{
var next = $('.top_proffessional_next');
next.on('click', function()
{
viewedSlider.trigger('next.owl.carousel');
});
}
}


});