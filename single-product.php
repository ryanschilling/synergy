<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php $size = 'category-thumb'; get_template_part('templates/featured-image'); ?>
      <?php the_content(); ?>
    </div> 
  </article>
  <?php
  	$related = get_field('products_related');
	if( $related ): ?>
	<br>
	<div class="related-products">
	  <h3>Related Products:</h3>
	  <div class="blocks">
	  	<?php foreach( $related as $post): ?>
	        <?php setup_postdata($post); ?>
  			<?php get_template_part('templates/product'); ?>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); ?>
	  </div>
	</div>
	<?php endif; ?>
<?php endwhile; ?>