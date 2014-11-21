jQuery(document).ready(function(){
    /* Slick Slider */
    jQuery('.slick-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 3000,
        adaptiveHeight: true,
        easing: 'easein',
    });
    jQuery('.slick-slider').show();
});