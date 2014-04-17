/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // Lightbox binding
      $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox();
      });

      // Superdropdown binding
      if($(window).width() > 767)
      {
        $(window).resize(function(){
          var container_width = $('#menu-main-menu').width();
          var container_offset = $('#menu-main-menu').offset().left;
          $('#menu-main-menu > .menu-solutions > .dropdown-menu,'+
              '#menu-main-menu > .menu-products > .dropdown-menu,'+
              '#menu-main-menu > .menu-support > .dropdown-menu'
          ).each(function(){
            var li_offset = $(this).parents('li.dropdown').offset().left;
            $(this).css({
              'left': -li_offset + container_offset,
              'width': container_width
            });
          });
        }).trigger('resize');
      
        // Enable dropdown menus
        $('#menu-main-menu > .menu-solutions > .dropdown-menu').html($('#menu-solutions-dropdown').html());
        $('#menu-main-menu > .menu-products > .dropdown-menu').html($('#menu-products-dropdown').html());
         $('#menu-main-menu > .menu-support > .dropdown-menu').html($('#menu-support-dropdown').html());
      }

      // Open first collapsible paragraph
      $('.faq-collapse').first().find('a[data-toggle="collapse"]').trigger('click');

      // For FAQ pages make sure that the sidebar menu item is highlighted
      var exp = /^\/support\/knowledge-base/i;
      if(exp.test(window.location.pathname))
      {
        $('.menu-support .dropdown.menu-knowledge-base').addClass('active');
      }
      exp = /^\/support\/knowledge-base\/section\/([^\/]+)/i;
      var url = $('.breadcrumb li:nth-child(4) a').attr('href');
      if(exp.test(url))
      {
        $('.menu-support .dropdown.menu-knowledge-base a[href^="'+url+'"]').parents('li').addClass('active');
      }

      // For training video pages make sure that the sidebar menu item is highlighted
      exp = /^\/support\/training-videos/i;
      if(exp.test(window.location.pathname))
      {
        $('.menu-support .dropdown.menu-training-videos').addClass('active');
      }
      exp = /^\/support\/training-videos\/series\/([^\/]+)/i;
      url = $('.breadcrumb li:nth-child(4) a').attr('href');
      if(exp.test(url))
      {
        $('.menu-support .dropdown.menu-training-videos a[href^="'+url+'"]').parents('li').addClass('active');
      }

      // For markets pages make sure that the sidebar menu item is highlighted
      exp = /^\/solutions\/industries/i;
      if(exp.test(window.location.pathname))
      {
        $('.menu-solutions .menu-voip-industries').addClass('active');
      }

      // For customer review widget make sure only one of the 3 reviews is shown
      var n = Math.round(Math.random()*2);
      if($('.widget_customer_review').length)
      {
        $('.widget_customer_review').find('blockquote.review').hide();
        $('.widget_customer_review').find('blockquote.review:eq('+n+')').fadeIn(250);
      }

      // Add hover over on main nav menu
      $('#menu-main-menu, #menu-utility-menu').find('li.dropdown').hover(function(){
        if($(window).width() > 767){
          $(this).addClass('open');
        }
      }, function(){
        if($(window).width() > 767){
          $(this).removeClass('open');
        }
      }).click(function(){
          if($(window).width() > 767){
            document.location = document.location.protocol + '//' + document.location.hostname + ($(this).find('a').first().attr('href'));
          }
      });

      // Animate the customer reviews sidebar widget on product pages
      if($('.widget_product_reviews').length && $('li.list-group-item','.widget_product_reviews').length > 2)
      {
        $('li.list-group-item', '.widget_product_reviews').first().hide();

        setInterval(function(){
          var context = $('.widget_product_reviews');
          $('li.list-group-item', context).last().fadeOut(500, function(){
            $('ul.list-group',context).prepend($(this));
          });
          $('li.list-group-item', context).first().slideDown(500);
        }, 3000);
      }
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
