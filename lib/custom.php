<?php

/**
 * Create Product post type
 */
function add_product_post_type() {
	register_taxonomy( 'product-type', null,
		array(
			'labels' => array(
				'name' => 'Types',
				'singular_name' => 'Type',
				'all_items' => 'All Types',
				'edit_item' => 'Edit Type',
				'view_item' => 'View Type',
				'update_item' => 'Update Type',
				'add_new_item' => 'Add New Type',
				'new_item_name' => 'New Type Name',
				'parent_item' => 'Parent Type',
				'search_items' => 'Search Product Types',
				'popular_items' => 'Popular Types',
				'separate_items_with_commas' => 'Separate types with commas',
				'add_or_remove_items' => 'Add or remove types',
				'choose_from_most_used' => "Choose from the most used types",
				'not_found' => 'No product types found.',
			),
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'products/types',
				'hierarchical' => true,
			),
		)
	);
	register_taxonomy( 'product-feature', null,
		array(
			'labels' => array(
				'name' => 'Features',
				'singular_name' => 'Feature',
				'all_items' => 'All Features',
				'edit_item' => 'Edit Feature',
				'view_item' => 'View Feature',
				'update_item' => 'Update Feature',
				'add_new_item' => 'Add New Feature',
				'new_item_name' => 'New Feature Name',
				'parent_item' => 'Parent Feature',
				'search_items' => 'Search Product Features',
				'popular_items' => 'Popular Features',
				'separate_items_with_commas' => 'Separate features with commas',
				'add_or_remove_items' => 'Add or remove features',
				'choose_from_most_used' => "Choose from the most used features",
				'not_found' => 'No product features found.',
			),
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'products/features',
				'hierarchical' => false,
			),
		)
	);
	register_taxonomy( 'product-manufacturer', null,
		array(
			'labels' => array(
				'name' => 'Manufacturers',
				'singular_name' => 'Manufacturer',
				'all_items' => 'All Manufacturers',
				'edit_item' => 'Edit Manufacturer',
				'view_item' => 'View Manufacturer',
				'update_item' => 'Update Manufacturer',
				'add_new_item' => 'Add New Manufacturer',
				'new_item_name' => 'New Manufacturer Name',
				'parent_item' => 'Parent Manufacturer',
				'search_items' => 'Search Product Manufacturers',
				'popular_items' => 'Popular Manufacturers',
				'separate_items_with_commas' => 'Separate manufacturers with commas',
				'add_or_remove_items' => 'Add or remove manufacturers',
				'choose_from_most_used' => "Choose from the most used manufacturers",
				'not_found' => 'No product manufacturers found.',
			),
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'products/manufacturers',
				'hierarchical' => false,
			),
		)
	);
	register_post_type( 'product',
		array(
			'labels' => array(
				'name' => __( 'Products' ),
				'singular_name' => __( 'Product' ),
				'add_new_item' => 'Add New Product',
				'edit_item' => 'Edit Product',
				'new_item' => 'New Product',
				'view_item' => 'View Product',
				'search_items' => 'Search Products',
				'not_found' => 'No products found.',
				'not_found_in_trash' => 'No products in Trash.',
			),
			'description' => 'Hardware and software products that Synergy Telecom provides.',
			'public' => true,
			'has_archive' => false,
			'menu_position' => 5,
			'hierarchical' => true,
			'supports' => array(
				'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes',
			),
			'taxonomies' => array(
				'product-type', 'product-feature', 'product-manufacturer',
			),
			'rewrite' => array(
				'slug' => 'products/all'
			),
			'menu_icon' => 'dashicons-admin-page',
		)
	);
}
add_action( 'init', 'add_product_post_type' );

/**
 * Create Reviews post type
 */
function add_review_post_type() {
	register_post_type( 'review',
		array(
			'labels' => array(
				'name' => __( 'Reviews' ),
				'singular_name' => __( 'Review' ),
				'add_new_item' => 'Add New Review',
				'edit_item' => 'Edit Review',
				'new_item' => 'New Review',
				'view_item' => 'View Review',
				'search_items' => 'Search Reviews',
				'not_found' => 'No reviews found.',
				'not_found_in_trash' => 'No reviews in Trash.',
			),
			'description' => 'Reviews from Synergy Telecom customers.',
			'public' => true,
			'has_archive' => false,
			'menu_position' => 5,
			'hierarchical' => false,
			'supports' => array(
				'title', 'editor', 'thumbnail', 'revisions',
			),
			'rewrite' => array(
				'slug' => 'products/reviews'
			),
			'menu_icon' => 'dashicons-star-half',
		)
	);
}
add_action( 'init', 'add_review_post_type' );

/**
 * Create Case Studies post type
 */
function add_case_study_post_type() {
	register_taxonomy( 'case-study-industry', null,
		array(
			'labels' => array(
				'name' => 'Industries',
				'singular_name' => 'Industry',
				'all_items' => 'All Industries',
				'edit_item' => 'Edit Industry',
				'view_item' => 'View Industry',
				'update_item' => 'Update Industry',
				'add_new_item' => 'Add New Industry',
				'new_item_name' => 'New Industry Name',
				'parent_item' => 'Parent Industry',
				'search_items' => 'Search Industries',
				'popular_items' => 'Popular Industries',
				'separate_items_with_commas' => 'Separate industries with commas',
				'add_or_remove_items' => 'Add or remove industries',
				'choose_from_most_used' => "Choose from the most used industries",
				'not_found' => 'No industries found.',
			),
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'solutions/industries',
				'hierarchical' => false,
			),
		)
	);
	register_post_type( 'case-study',
		array(
			'labels' => array(
				'name' => __( 'Case Studies' ),
				'singular_name' => __( 'Case Study' ),
				'add_new_item' => 'Add New Case Study',
				'edit_item' => 'Edit Case Study',
				'new_item' => 'New Case Study',
				'view_item' => 'View Case Study',
				'search_items' => 'Search Case Studies',
				'not_found' => 'No case studies found.',
				'not_found_in_trash' => 'No case studies in Trash.',
			),
			'description' => 'Case studies showing how Synergy Telecom has provided VOIP solutions.',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'hierarchical' => true,
			'supports' => array(
				'title', 'editor', 'thumbnail', 'revisions', 'page-attributes',
			),
			'taxonomies' => array(
				'case-study-industry',
			),
			'rewrite' => array(
				'slug' => 'solutions/case-studies'
			),
			'menu_icon' => 'dashicons-analytics',
		)
	);
}
add_action( 'init', 'add_case_study_post_type' );

/**
 * Create FAQs post type
 */
function add_faq_post_type() {
	register_taxonomy( 'faq-section', null,
		array(
			'labels' => array(
				'name' => 'Sections',
				'singular_name' => 'Section',
				'all_items' => 'All Sections',
				'edit_item' => 'Edit Section',
				'view_item' => 'View Section',
				'update_item' => 'Update Section',
				'add_new_item' => 'Add New Section',
				'new_item_name' => 'New Section Name',
				'parent_item' => 'Parent Section',
				'search_items' => 'Search Sections',
				'popular_items' => 'Popular Sections',
				'separate_items_with_commas' => 'Separate FAQ sections with commas',
				'add_or_remove_items' => 'Add or remove FAQ sections',
				'choose_from_most_used' => "Choose from the most used FAQ sections",
				'not_found' => 'No FAQ sections found.',
			),
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'sections',
				'hierarchical' => true,
			),
		)
	);
	register_taxonomy( 'faq-topic', null,
		array(
			'labels' => array(
				'name' => 'Topics',
				'singular_name' => 'Topic',
				'all_items' => 'All Topics',
				'edit_item' => 'Edit Topic',
				'view_item' => 'View Topic',
				'update_item' => 'Update Topic',
				'add_new_item' => 'Add New Topic',
				'new_item_name' => 'New Topic Name',
				'parent_item' => 'Parent Topic',
				'search_items' => 'Search Topics',
				'popular_items' => 'Popular Topics',
				'separate_items_with_commas' => 'Separate FAQ topics with commas',
				'add_or_remove_items' => 'Add or remove FAQ topics',
				'choose_from_most_used' => "Choose from the most used FAQ topics",
				'not_found' => 'No FAQ topics found.',
			),
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'topics',
			),
		)
	);
	register_post_type( 'faq',
		array(
			'labels' => array(
				'name' => __( 'FAQs' ),
				'singular_name' => __( 'FAQ' ),
				'add_new_item' => 'Add New FAQ',
				'edit_item' => 'Edit FAQ',
				'new_item' => 'New FAQ',
				'view_item' => 'View FAQ',
				'search_items' => 'Search Knowledge Base',
				'not_found' => 'No frequently asked questions found.',
				'not_found_in_trash' => 'No frequently asked questions in Trash.',
			),
			'description' => 'Knowledge base of frequently asked questions.',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'supports' => array(
				'title', 'revisions',
			),
			'taxonomies' => array(
				'faq-section', 'faq-topic',
			),
			'rewrite' => array(
				'slug' => 'support/knowledge-base'
			),
			'menu_icon' => 'dashicons-lightbulb',
		)
	);
}
add_action( 'init', 'add_faq_post_type' );

/**
 * Create Training Videos post type
 */
function add_training_video_post_type() {
	register_taxonomy( 'training-video-series', null,
		array(
			'labels' => array(
				'name' => 'Series',
				'singular_name' => 'Series',
				'all_items' => 'All Series',
				'edit_item' => 'Edit Series',
				'view_item' => 'View Series',
				'update_item' => 'Update Series',
				'add_new_item' => 'Add New Series',
				'new_item_name' => 'New Series Name',
				'parent_item' => 'Parent Series',
				'search_items' => 'Search Series',
				'popular_items' => 'Popular Series',
				'separate_items_with_commas' => 'Separate series with commas',
				'add_or_remove_items' => 'Add or remove series',
				'choose_from_most_used' => "Choose from the most used series",
				'not_found' => 'No series found.',
			),
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'series',
			),
		)
	);
	register_post_type( 'training-video',
		array(
			'labels' => array(
				'name' => __( 'Training Videos' ),
				'singular_name' => __( 'Training Video' ),
				'add_new_item' => 'Add New Video',
				'edit_item' => 'Edit Video',
				'new_item' => 'New Video',
				'view_item' => 'Watch Video',
				'search_items' => 'Search Training Videos',
				'not_found' => 'No training videos found.',
				'not_found_in_trash' => 'No training videos in Trash.',
			),
			'description' => 'Training and support videos from Synergy Telecom support team.',
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			'supports' => array(
				'title', 'editor', 'thumbnail', 'revisions',
			),
			'taxonomies' => array(
				'training-video-series',
			),
			'rewrite' => array(
				'slug' => 'support/training-videos'
			),
			'menu_icon' => 'dashicons-format-video',
		)
	);
}
add_action( 'init', 'add_training_video_post_type' );