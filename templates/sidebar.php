<?php

global $post;
$section = '';

// About section
if(
	is_page(array(115, 386, 389))
){
	$section = 'about';

// Solutions section
}elseif(
	is_page(2) ||
	is_tree(2) ||
	is_singular(array(
		'case-study'
		)
	) ||
	is_post_type_archive(array(
		'case-study',
		)
	) ||
	is_tax(array(
		'case-study-industry',
		)
	)
){
	$section = 'solutions';

// Products section
}elseif(
	is_page(88) ||
	is_singular(array(
		'review',
		'product'
		)
	) ||
	is_post_type_archive(array(
		'product',
		'review'
		)
	) ||
	is_tax(array(
		'product-type',
		'product-manufacturer',
		'product-feature'
		)
	)
){
	$section = 'products';

// Partners section
}elseif(
	is_tree(95)
){
	$section = 'partners';

// Support section
}elseif(
	is_tree(105) ||
	is_singular(array(
		'faq',
		'training-video'
		)
	) ||
	is_post_type_archive(array(
		'faq',
		'training-video'
		)
	) ||
	is_tax(array(
		'faq-section',
		'faq-topic',
		'training-video-series'
		)
	)
){
	$section = 'support';
}

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

// Show sub-navigation widgets
dynamic_sidebar('sidebar-primary');

?>