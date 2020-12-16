(function ($) {
  jQuery('li.megamenu')
    .hover(function () {
      jQuery(this).find(' > .dropdown-menu').addClass('show');
    })
    .mouseleave(function () {
      setTimeout(() => {
        jQuery(this).find(' > .dropdown-menu').removeClass('show');
      }, 200);
    });

  // $('.app_auth_trigger')
  //   .hover(function () {
  //     $('.app_auth_urls').addClass('show');
  //   })
  //   .mouseleave(function () {
  //     setTimeout(() => {
  //       $('.app_auth_urls').removeClass('show');
  //     }, 250);
  // });
})(jQuery);
