<article <?php post_class(); ?>>
  <blockquote>
  	<q><?php echo trim(get_the_content(),' "“”.'); ?></q>
  	<footer>
    <?php if(get_field('review_source')): ?>
      <a target="_blank" href="<?=get_field('review_source')?>">
    <?php endif; ?>
    <?=get_field('review_author'); ?>
    <?php if(get_field('review_company')): ?>
      (<em><?=get_field('review_company')?></em>)
    <?php endif; ?>
    <?php if(get_field('review_source')): ?>
      </a>
    <?php endif; ?>
  	<?php
  	$rating = get_field('review_rating');
  	if($rating):
  		echo '<div class="rating rating-'.$rating.'">';
  		for($x=1;$x<=5;$x++):
  			if($x <= $rating):
  				echo '<i class="fa fa-fw fa-star"></i>';
  			else:
  				echo '<i class="fa fa-fw fa-star-o"></i>';
  			endif;
  		endfor;
  		echo '</div>';
  	endif;
  	?>
    </footer>
  </blockquote>
</article>