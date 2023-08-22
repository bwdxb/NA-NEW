  $('.logoSlider').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    dots: false,
    pauseOnHover: false,
    variableWidth: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      }
    }]
  });

  $('.bannerSlider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  arrows: true,
  dots: false,
  pauseOnHover: false,
  variableWidth: false,
});

$("#bottom_scroll").click(function() {
    var targetDiv = $(this).attr('href');
    $('html, body').animate({
        scrollTop: $('#about').offset().top
    }, 1000);
})

$(".navbar-toggler").click(function() {
  $(this).toggleClass('close');
  $('body').toggleClass('overflow');
  $('#navbar_menu').toggleClass('open');
  $('.header').toggleClass('mobHeader');
})

$('.searchBtn').click(function() {
  $(this).toggleClass('close');
   $('#deskSearch').toggle('');
});

$('.mob_searchBtn #seacrh_icon').click(function() {
  //alert('ff')
  $(this).hide('slow');
   $('#mobSearch').show('slow');
   $('#close_icon').show('slow');
});
$('.mob_searchBtn #close_icon').click(function() {
  $(this).hide('slow');
   $('#mobSearch').hide('slow');
   $('#seacrh_icon').show('slow');
});

$(document).ready(function(){
  $("#homeSlider").carousel({
    interval : false
  });

  if($(window).width() < 992){
    $("#submenu").hide();
    $('.header .navbar-nav li.dropdownMenu a.nav-link').click(function(){
        event.preventDefault();
        $(this).parent().find('#submenu').slideToggle('slow'); 
        $(this).toggleClass("menuOpen");    
  });
  }
  else{
    $("#submenu").show();
  };
  
  if($(window).width() < 992){
    $("#menuLevel2").hide();
    $('.header .navbar-nav li a.subLink').click(function(){
        event.preventDefault();
        $(this).parent().find('#menuLevel2').slideToggle('slow'); 
        $(this).toggleClass("expandLink");    
  });
  }
  else{
    $("#menuLevel2").show();
  };


  $(window).resize(function(){
    if($(window).width() < 992){
      $(".mega_menu").hide();
      $('.dropdown .fas').click(function(){

        //$(this).children('.mega_menu').slideToggle('slow'); 
        event.preventDefault();
        $(this).parent().find('.mega_menu').slideToggle('slow');  
        $(this).toggleClass("fa-minus");  
      });
    }
    else{
      $(".mega_menu").show();
   };
  })

});

if($('.menuSidebar .sidebarNav li').hasClass('dropdown')){
    $(".sidebarDropdown").hide();
    $('.dropdown-link').click(function(){
        event.preventDefault();
        $(this).parent().find('.sidebarDropdown').slideToggle('slow'); 
        $(this).toggleClass("open");    
  });
  }
  else{
    $(".sidebarDropdown").show();
  };


  $(window).scroll(function(){
     var scroll = $(window).scrollTop();
     if(scroll >= 150){
        $('.header').addClass('sticky_header');
     }
     else{
        $('.header').removeClass('sticky_header');
     }
  });


  $(window).scroll(function () {
      if ($(this).scrollTop() > 500) {
          $('.scroll-top').fadeIn();
      } else {
          $('.scroll-top').fadeOut();
      }
  });

  $('.scroll-top').click(function () {
      $("html, body").animate({
          scrollTop: 0
      }, 100);
      return false;
  });

  $(window).scroll(function(){
    new WOW().init();
  })

  $(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }

            if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
            }
            $(this).addClass("active");
    });
    


});

  $('.newsSlider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    variableWidth: false,
});