(function ($) {
  jQuery(document).ready(function () {
    let mySwiper = new Swiper('.product-carousel', {
      slidesPerView: 'auto',
      loopFillGroupWithBlank: false,
      slideBlankClass: 'swiper-slide-invisible-blank',
      breakpoints: {
        480: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 2,
        },
        1000: {
          slidesPerView: 6,
        },
      },
      autoplay: {
        delay: 3000,
      },
      loop: true,
      spaceBetween: 10,
    });

    let relatedProducts = new Swiper('.related_products .related', {
      wrapperClass: 'products',
      slideClass: 'product',

      breakpoints: {
        300: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 2,
        },
        1000: {
          slidesPerView: 6,
        },
      },
      slidesPerView: 4,
      autoplay: {
        delay: 3000,
      },
      loop: true,
      spaceBetween: 10,
      rtl: true,
    });

    // jQuery(".flex-control-nav li").addClass('swiper-slide')
    // let singleProductThumbnails = new Swiper('.woocommerce-product-gallery', {
    //     wrapperClass: 'flex-control-thumbs',
    //     // direction: 'horizontal',
    //     // slidesPerView: 6,
    //     // spaceBetween: 10,
    // })
  });
})(jQuery);
