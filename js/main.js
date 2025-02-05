$(window).on('load', function() {
	// Animate loader off screen
	$(".se-pre-con").fadeOut(2000, function(){
    $(".se-pre-con img").fadeOut(2100)
  });
});
$( document ).ready(function() {
    $("#clients-carousel").slick({
      speed: 300,
      slidesToShow: 4,
      autoplay: true,
      infinity: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
    $("#team-carousel").slick({
      speed: 300,
      slidesToShow: 4,
      autoplay: true,
      infinity: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
    $("#portfolio-carousel").slick({
      speed: 300,
      slidesToScroll: 3,
      slidesToShow: 4,
      autoplay: true,
      infinity: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    })
    $("#clients-carousel").children().children().addClass("slickFlex")
})