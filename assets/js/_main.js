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

      // Replace phone numbers on hover
      $(document).delegate('[href*=4388647]', 'mouseenter', function(event) {
        var number = $(this).text().replace('GET-VOIP', '438-8647');
        return $(this).text(number);
      }).delegate('[href*=4388647]', 'mouseout', function(event) {
        var number = $(this).text().replace('438-8647', 'GET-VOIP');
        return $(this).text(number);
      });

      // Superdropdown binding
      var main_menu = $('#menu-main-menu');
      if($(window).width() > 767)
      {
        $(window).resize(function(){
          var container_width = main_menu.width();
          var container_offset = main_menu.offset().left;
          main_menu.find('> .menu-solutions > .dropdown-menu,'+
              '> .menu-products > .dropdown-menu,'+
              '> .menu-support > .dropdown-menu'
          ).each(function(){
            var li_offset = $(this).parents('li.dropdown').offset().left;
            $(this).css({
              'left': -li_offset + container_offset,
              'width': container_width
            });
          });
        }).trigger('resize');

        // Enable dropdown menus
        main_menu.find('> .menu-solutions > .dropdown-menu').html($('#menu-solutions-dropdown').html());
        main_menu.find('> .menu-products > .dropdown-menu').html($('#menu-products-dropdown').html());
        main_menu.find('> .menu-support > .dropdown-menu').html($('#menu-support-dropdown').html());
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
            var url = document.location.protocol + '//' + document.location.hostname + ($(this).find('a').first().attr('href'));
            document.location = url;
          }
      });

      // Bind opening of search input
      var search_btn = $('.menu-search a');
      var search_form = $('<form action="/search/+" method="GET"><input type="text" name="keyword" value="" class="form-control keyword" placeholder="Search"></form>');
      search_form.submit(function(e){
        e.preventDefault();
        var form_action = search_form.attr('action');
        var form_input = search_form.find('input').val();
        document.location = form_action + form_input;
        return false;
      });
      search_btn.html('').append(search_form);
      search_btn.click(function(e){
        e.preventDefault();
        main_menu.addClass('with-search');
        search_form.find('input').focus();
      });

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

      // For customer review widget make sure only one of the 3 reviews is shown
      var n = Math.round(Math.random()*2);
      if($('.widget_customer_review').length)
      {
        $('.widget_customer_review').find('blockquote.review').hide();
        $('.widget_customer_review').find('blockquote.review:eq('+n+')').fadeIn(250);
      }

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

      // Subscribe form
      $('form[name*=mc-embedded-subscribe-form]').each(function(){
        var subscribe = $(this);

        // Bind submit functionality to button
        subscribe.bind('submit', function(e){
          e.preventDefault();

          var email = subscribe.find('input[name=EMAIL]');
          var name = subscribe.find('input[name=NAME]');
          var fname = subscribe.find('input[name=FNAME]');
          var lname = subscribe.find('input[name=LNAME]');

          // Validate required fields
          if(email.val()==='' || name.val()==='')
          {
            alert('You must provide your name and email address.');
            return false;
          }
          else
          {
            var full_name = $.trim(name.val()).split(' ');
            fname.val(full_name[0]);
            full_name[0] = null;
            lname.val($.trim(full_name.join(' ')));
          }

          // Validate email address
          var test = /^.+@.+\..{2,}$/.test(email.val());
          if(!test){
            alert('Please provide a valid email address.');
            return false;
          }

          subscribe.get(0).submit();
        });
      });
    }
  },

  template_order_online: {
    init: function() {
      // Increment/decrement product counter on build a system page
      $('.counter-minus').click(function(){
        var counter = $(this).parents('.input-group').find('.counter');
        var count = counter.val() * 1;
        count = Math.max(0, count-1);
        counter.val(count);
      });
      $('.counter-plus').click(function(){
        var counter = $(this).parents('.input-group').find('.counter');
        var count = counter.val() * 1;
        counter.val(count + 1);
      });
    }
  },

  tax_case_study_industry: {
    init: function() {
      // For markets pages make sure that the sidebar menu item is highlighted
      exp = /^\/solutions\/industries/i;
      if(exp.test(window.location.pathname))
      {
        $('.menu-solutions .menu-voip-industries').addClass('active');
      }
    }
  },

  template_contact_us: {
    init: function(){
      function init_map(){
        var address = $('.address-for-map');
        var myOptions = {zoom:address.data('zoom'),center:new google.maps.LatLng(address.data('lat'), address.data('lng')),mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
        marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(address.data('lat'), address.data('lng'))});
        infowindow = new google.maps.InfoWindow({content: address.html() });
        google.maps.event.addListener(marker, "click", function(){
          infowindow.open(map,marker);
        });
        infowindow.open(map,marker);
      }
      google.maps.event.addDomListener(window, 'load', init_map);
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


Modernizr.addTest('backgroundclip',function() {

  var div = document.createElement('div');

  if ('backgroundClip' in div.style)
  {
     return true;
  }

  'Webkit Moz O ms Khtml'.replace(/([A-Za-z]*)/g,function(val) {
    if (val+'BackgroundClip' in div.style)
    {
      return true;
    }
  });

});

Modernizr.addTest('backgroundcliptext',function(){
    var div = document.createElement('div');
    div.style.webkitBackgroundClip = "text";
    var text = div.style.cssText.indexOf('text');
    if (text > 0)
    {
      return true;
    }
    'Webkit Moz O ms Khtml'.replace(/([A-Za-z]*)/g,function(val){
        if (val+'BackgroundClip' in div.style)
        {
          return true;
        }
    });
});
