$(window).on('load', function() {
	// Animate loader off screen
	$(".se-pre-con").fadeOut("slow");
	new WOW().init();
});
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
})