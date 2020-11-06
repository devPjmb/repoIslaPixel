$(window).on('load', function() {
	// Animate loader off screen
	$(".se-pre-con").fadeOut("slow");});
$( document ).ready(function() {
    $("#clients-carousel").slick({
         centerMode: true,
         centerPadding: '10px',
         slidesToShow: 4,
         arrows: false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
    })
    $("#team-carousel").slick({
         centerMode: true,
         centerPadding: '10px',
         slidesToShow: 3,
         arrows: false,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2000,
    })
    $("#portfolio-carousel").slick({
         slidesPerRow: 3,
         rows: 2,
         arrows: false,
         slidesToShow: 1,
         autoplay: true,
         autoplaySpeed: 5000,
    })
})