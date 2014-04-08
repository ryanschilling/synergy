<?php 
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
<?php endif; ?>