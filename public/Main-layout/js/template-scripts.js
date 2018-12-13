jQuery(document).ready(function($) {  
  // Owl Carousel                     
  var owl = $('.carousel-default');
  owl.owlCarousel({
    nav: true,
    dots: true,
    items: 1,
    loop: true,
    navText: ["&#xe605","&#xe606"],
    autoplay: true,
    autoplayTimeout: 5000
  });

  // Owl Carousel - Content Blocks  
  var owl = $('.carousel-blocks');
  owl.owlCarousel({
    nav: true,
    dots: false,
    items: 4,
    responsive: {
      0: {
        items: 1
      },
      481: {
        items: 3
      },
      769: {
        items: 4
      }
    },
    loop: true,
    navText: ["&#xe605","&#xe606"],
    autoplay: true,
    autoplayTimeout: 5000
  });
  
  // Sticky Nav Bar
  $(window).scroll(function() {
    if ($(this).scrollTop() > 20){  
        $('.sticky').addClass("fixed");
    }
    else{
        $('.sticky').removeClass("fixed");
    }
  });
});


$(function() {

  $('#Daily-link').click(function(e) {
  $("#Daily-form").delay(100).fadeIn(100);
   $("#Monthly-form").fadeOut(100);
   $("#Yearly-form").fadeOut(100);
   $("#Customrange-form").fadeOut(100);
  $('#Monthly-link').removeClass('active');
  $('#Yearly-link').removeClass('active');
  $('#Customrange-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

$('#Monthly-link').click(function(e) {
  $("#Monthly-form").delay(100).fadeIn(100);
  $("#Daily-form").fadeOut(100);
  $("#Yearly-form").fadeOut(100);
  $("#Customrange-form").fadeOut(100);
   $('#Daily-link').removeClass('active');
   $('#Yearly-link').removeClass('active');
   $('#Customrange-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

$('#Yearly-link').click(function(e) {
  $("#Yearly-form").delay(100).fadeIn(100);
  $("#Daily-form").fadeOut(100);
  $("#Monthly-form").fadeOut(100);
  $("#Customrange-form").fadeOut(100);
   $('#Monthly-link').removeClass('active');
   $('#Daily-link').removeClass('active');
   $('#Customrange-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

$('#Customrange-link').click(function(e) {
  $("#Customrange-form").delay(100).fadeIn(100);
  $("#Daily-form").fadeOut(100);
  $("#Monthly-form").fadeOut(100);
  $("#Yearly-form").fadeOut(100);
   $('#Monthly-link').removeClass('active');
   $('#Yearly-link').removeClass('active');
   $('#Daily-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});
// Electricity Charge
$('#Electricity-link').click(function(e) {
  $("#Electricity-form").delay(100).fadeIn(100);

  $("#Money-form").fadeOut(100);

   $('#Money-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

$('#Money-link').click(function(e) {
  $("#Money-form").delay(100).fadeIn(100);

  $("#Electricity-form").fadeOut(100);

   $('#Electricity-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

});
