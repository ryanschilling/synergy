<?php 
 
$products = new WP_Query( array(
	'posts_per_page' => 1,
	'post_type' => 'product',
	'meta_key' => 'product_featured',
	'meta_value' => 1,
	'orderby' => 'rand'
) );

if( $products->have_posts() ): 
	while ( $products->have_posts() ):
		$products->the_post(); ?>
		
		<section class="widget widget_featured_product">
		  	<h3>Featured Product</h3>
		  	<div class="product">
				<?php get_template_part('templates/featured-image'); ?>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<?php the_excerpt(); ?>
				<p>
					<a href="<?php the_permalink(); ?>" class="btn btn-primary">
						<i class="fa fa-fw fa-<?=get_field('embed_icon', $column->ID); ?>"></i>
						<?=get_field('embed_button'); ?>
					</a>
				</p>
			</div>
		</section>

		<?php
	endwhile;
endif;
?>