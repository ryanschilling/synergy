<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Main Menu', 'roots'),
    'utility_navigation' => __('Utility Menu', 'roots'),
    'quicklinks_navigation_1' => __('Quicklinks - Left', 'roots'),
    'quicklinks_navigation_2' => __('Quicklinks - Center', 'roots'),
    'quicklinks_navigation_3' => __('Quicklinks - Right', 'roots'),
    'social_navigation' => __('Social Icons', 'roots'),
    'footer_navigation' => __('Legal Links', 'roots'),
    'about_navigation' => __('About Sidebar Menu', 'roots'),
    'solutions_navigation' => __('Solutions Sidebar Menu', 'roots'),
    'products_navigation' => __('Products Sidebar Menu', 'roots'),
    'partners_navigation' => __('Partners Sidebar Menu', 'roots'),
    'support_navigation' => __('Support Sidebar Menu', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(263, 263, false);
  add_image_size('category-thumb', 750, 9999); // 300px wide (and unlimited height)
  add_image_size('panel-image', 354, 236, true);

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'status', 'image', 'video', 'audio'));
  
  // Add excerpts to pages
  add_post_type_support( 'page', 'excerpt' );

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'roots_setup');
