<?php

$section = get_the_section();

// Show navigation menu
if (has_nav_menu($section.'_navigation')) :
	echo '<nav class="sidebar-menu">';
	wp_nav_menu(array('theme_location' => $section.'_navigation', 'menu_class' => '', 'depth' => 3));
	echo '</nav>';
endif;

// Show product reviews
if (is_singular('product')):
  	get_template_part('templates/widget', 'review');
endif;

// Show featured product
if (is_singular('case-study') || is_post_type_archive('case-study')):
  	get_template_part('templates/widget', 'featured-product');
endif;

// Show sub-navigation widgets
dynamic_sidebar('sidebar-primary');

?>