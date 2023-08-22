"use strict";

var $ = jQuery.noConflict();
var currentScrollY = 0;
var mubadalaCorporateSiteScript = {
  init: function init() {
    var isRTL = $('html').attr('lang') === 'ar' ? true : false,
        screenWidth = window.innerWidth,
        screenHeight = window.innerHeight,
        orientation = window.orientation,
        self = this;
    this.spotlightSlider(isRTL);
    setTimeout(function () {
      self.matchSpotlightHeight(screenWidth, screenHeight, orientation);
    }, 100);
    this.bindEvents();
    this.newsSlider(isRTL);
    this.stickyShare();
    this.videoPopup();
    this.adjustHeight(); //this.setWhatWeDoMapImageWidth();

    this.setNewsCardsAnimationDelay();
    this.setwhatWeDoAnimationDelay(); // this.pageAnimations();
  },
  setWhatWeDoMapImageWidth: function setWhatWeDoMapImageWidth() {
    $('.mapContent .fg-wrapper img').css('min-width', $('.mapContent .bg-wrapper img').width());
    $('.mapContent').css('height', $('.mapContent .fg-wrapper').height());
  },
  setwhatWeDoAnimationDelay: function setwhatWeDoAnimationDelay() {
    var animationDelay = 0;
    $('.mapContent .map-point').each(function (index, item) {
      //animationDelay = (0.3 + (index * 0.2)) + 's'
      animationDelay = 0 + index * 0.05 + 's';
      $(item).css('animation-delay', animationDelay);
    });
  },
  setNewsCardsAnimationDelay: function setNewsCardsAnimationDelay() {
    var animationDelay = 0;
    $('.latest-news .cards').each(function (index, item) {
      animationDelay = 0.7 + index * 0.2 + 's';
      $(item).css('animation-delay', animationDelay);
    });
  },
  checkSpotlightCount: function checkSpotlightCount() {
    if ($('.homepage-spotlights .slick-slide').length === 1) {
      $('.homepage-spotlight-nav').addClass('single-spotlight');
    }
  },
  spotlightSlider: function spotlightSlider(isRTL) {
    var self = this;
    $('.homepage-spotlights').on('init', function (slick) {
      self.checkSpotlightCount();

      if ($($('.homepage-spotlight')[0]).find('video').length) {
        $($('.homepage-spotlight')[0]).find('video')[0].play();
      }
    });
    $('.homepage-spotlights').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
      if ($($('.homepage-spotlight')[currentSlide]).find('video').length) {
        $($('.homepage-spotlight')[currentSlide]).find('video')[0].pause();
        $($('.homepage-spotlight')[currentSlide]).find('video')[0].currentTime = 0;
      }

      var latestSpotlightIndex = '0' + (nextSlide + 1);
      $('.spotlight-index').html(latestSpotlightIndex);

      if ($($('.homepage-spotlight')[nextSlide]).find('video').length) {
        $($('.homepage-spotlight')[nextSlide]).find('video')[0].play();
      }
    });
    $('.homepage-spotlights').slick({
      dots: true,
      appendDots: $('.homepage-spotlight-nav .right-container'),
      touchThreshold: 200,
      infinite: true,
      arrows: false,
      fade: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      variableWidth: false,
      centerMode: false,
      rtl: isRTL,
      mobileFirst: true
    });
  },
  matchSpotlightHeight: function matchSpotlightHeight(screenWidth, screenHeight, orientation) {
    var requiredHeight;

    if (screenWidth < screenHeight) {
      // Portrait
      if (screenWidth < 768) {
        if (orientation === 0) {
          // Portrait Mobile
          requiredHeight = $('.bg-image.mobile').height();
        } else {
          // Landscape Mobile
          requiredHeight = $('.bg-image.desktop').height();
        }
      } else {
        // Portrait iPad
        requiredHeight = $('.bg-image.desktop').height();
      }
    } else {
      // Landscape
      requiredHeight = $('.bg-image.desktop').height();
    }

    if (!requiredHeight) {
      // requiredHeight = 'auto';
      requiredHeight = '86.666vh';
    }

    $('.spotlight-bg-video-wrapper').css('height', requiredHeight);
  },
  bindEvents: function bindEvents() {
    $('.homepage-spotlight-nav .prev').on('click', function () {
      $('.homepage-spotlights')[0].slick.slickPrev();
    });
    $('.homepage-spotlight-nav .next').on('click', function () {
      $('.homepage-spotlights')[0].slick.slickNext();
    });
    $('.latest-news .prev').on('click', function () {
      $('.news-cards')[0].slick.slickPrev();
    });
    $('.latest-news .next').on('click', function () {
      $('.news-cards')[0].slick.slickNext();
    });
  },
  newsSlider: function newsSlider(isRTL) {
    $('.news-cards').on('init', function (slick) {
      $('.latest-news .prev').addClass('disabled');
    });
    $('.news-cards').on('afterChange', function (event, slick, currentSlide) {
      var upperLimit = $('.news-cards .cards').length - $('.news-cards')[0].slick.options.slidesToShow;

      if (currentSlide === 0) {
        $('.latest-news .prev').addClass('disabled');
      } else {
        $('.latest-news .prev').removeClass('disabled');
      }

      if (currentSlide === upperLimit) {
        $('.latest-news .next').addClass('disabled');
      } else {
        $('.latest-news .next').removeClass('disabled');
      }
    });
    $('.news-cards').slick({
      dots: false,
      touchThreshold: 1000,
      infinite: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      variableWidth: true,
      rtl: isRTL,
      mobileFirst: true,
      responsive: [{
        breakpoint: 550,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          adaptiveHeight: true
        }
      }, {
        breakpoint: 1023,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          adaptiveHeight: true
        }
      }]
    });
  },
  stickyShare: function stickyShare() {
    $('.share__trigger').on('click', function () {
      $('.utilities').toggle();
    });
  },
  videoPopup: function videoPopup() {
    $('.playVideo').on('click', function () {
      currentScrollY = window.scrollY;
      $('body').addClass('disable-scroll');
      $('.video-popup iframe').attr('src', $(this).attr('data-youTubeId'));
      $('.video-popup iframe')[0].contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', "*");
      $('.video-popup, .popup-close-icon').addClass('visible');
    });
    $('.popup-close-icon').on('click', function () {
      $('.video-popup iframe')[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*");
      $('body').removeClass('disable-scroll');
      $('.supporting-stories-pop-wrapper .text-wrapper').scrollTop(0);
      $('.video-popup').removeClass('visible');

      if (screenWidth < 1024) {
        window.scrollTo(0, currentScrollY);
      }
    });
  },
  adjustHeight: function adjustHeight() {
    setTimeout(function () {
      var maxHeight = 0;
      $(".cards").each(function () {
        if ($(this).height() > maxHeight) {
          maxHeight = $(this).height();
        }
      });
      $(".cards").height(maxHeight);
    }, 500);
  },
  pageAnimations: function pageAnimations() {
    $('.homepage-spotlight-wrapper').viewportChecker({
      classToAdd: 'visible'
    });
    $('.infographics-and-banner-wrapper').viewportChecker({
      classToAdd: 'visible',
      offset: 300
    });
    $('.mapWrapper').viewportChecker({
      classToAdd: 'visible',
      offset: 300
    });
    $('.latest-news').viewportChecker({
      classToAdd: 'visible',
      offset: 300
    });
    $('.campaign-section').viewportChecker({
      classToAdd: 'visible',
      offset: 300
    });
  },
  showLoader: function showLoader() {
    $('.loader-screen').addClass('show-loader');
  },
  hideLoader: function hideLoader() {
    $('.loader-screen').removeClass('show-loader');
  }
};
$(document).ready(function () {
  mubadalaCorporateSiteScript.init();
});
$(window).on('resize', function () {
  var isRTL = $('html').attr('lang') === 'ar' ? true : false,
      screenWidth = window.innerWidth,
      screenHeight = window.innerHeight,
      orientation = window.orientation;
  setTimeout(function () {
    mubadalaCorporateSiteScript.matchSpotlightHeight(screenWidth, screenHeight, orientation);
    mubadalaCorporateSiteScript.adjustHeight();
  }, 100);
});
$(window).on('load', function () {
  mubadalaCorporateSiteScript.pageAnimations();
  mubadalaCorporateSiteScript.hideLoader();
});;