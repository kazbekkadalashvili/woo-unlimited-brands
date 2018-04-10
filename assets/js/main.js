var amountshow = +brandslider.slidestoshow;
var speed = +brandslider.speed;

if (brandslider.arrows === 'true') {
    var arrow = true;
}
else{
    var arrow = false;
}

if (brandslider.dots === 'false') {
    var dot = false;
}
else {
   var dot = true; 
}

jQuery(function($) {
  $('.customer-logos').slick({
    slidesToShow: amountshow,
    slidesToScroll: 1,
    arrows: arrow,
    dots: dot,
    autoplay: true,
    autoplaySpeed: speed * 1000,
    pauseOnHover: true,
  });
});



function adjustHeight() {
    var myWidth = jQuery('.col').width();
    var myString = myWidth + 'px';
    jQuery('.col').css('height', myString);
    var contHeight = jQuery('.col').css('height', myString);
}


// calls adjustHeight on window load
jQuery(window).load(function() {
    adjustHeight();
});

// calls adjustHeight anytime the browser window is resized
jQuery(window).resize(function() {
    adjustHeight();
});