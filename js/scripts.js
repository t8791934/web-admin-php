/*!
 * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2021 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function ($) {
  'use strict';

  // Add active state to sidbar nav links
  $('#layoutSidenav_nav .sb-sidenav a.nav-link').each(function () {
    if (this.href === window.location.href) {
      $(this).addClass('active');
    }
  });

  // Toggle the side navigation
  $('#sidebarToggle').on('click', function (e) {
    e.preventDefault();
    $('body').toggleClass('sb-sidenav-toggled');
  });
})(jQuery);
