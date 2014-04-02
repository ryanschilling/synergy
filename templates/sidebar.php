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

  	$reviews = get_field('product_reviews', get_the_ID());
	if( $reviews ): ?>
	<section class="widget widget_product_reviews">
	  <h3>Customer Reviews</h3>
	  	<?php
	  	$rating = get_field('product_rating', get_the_ID());
	  	if($rating):
	  		echo '<div class="average-rating rating-'.$rating.'">';
	  		for($x=1;$x<=5;$x++):
	  			if($x <= $rating):
	  				echo '<i class="fa fa-fw fa-star"></i>';
	  			else:
	  				echo '<i class="fa fa-fw fa-star-o"></i>';
	  			endif;
	  		endfor;
	  			echo '<span class="text-muted">'.$rating.'.0 Avg.</span>';
	  		echo '</div>';
	  	endif; ?>
  		<ul class="list-group">
  		<?php foreach( $reviews as $post): ?>
        <?php setup_postdata($post); ?>
			<li class="list-group-item">
				<?php
				echo '<blockquote class="review">';
		        echo '<q>';
		        echo substr(trim(get_the_excerpt(),' "“”.'), 0, 166) . '...';
		        echo '</q>';
		        echo '<footer>';
		        if(get_field('review_source')):
		          echo '<a target="_blank" href="'.get_field('review_source').'">';
		        endif;
		        echo get_field('review_author');
		        if(get_field('review_company')):
		          echo ' (<em>' . get_field('review_company') .'</em>)';
		        endif;
		        if(get_field('review_source')):
		          echo '</a>';
		        endif;
		        echo '</footer>';
		        echo '</blockquote>';
		        ?>
			</li>
    	<?php endforeach; ?>
    	<?php wp_reset_postdata(); ?>
	  </div>
	</section>
	<?php endif;
endif;

// Show sub-navigation widgets
dynamic_sidebar('sidebar-primary');

?>