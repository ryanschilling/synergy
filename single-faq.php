<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<div class="entry-content">
			<h2 class="entry-title">Answer</h2>
		  	<?php echo str_ireplace(array('<p ', '<p>'),array('<p class="lead" ','<p class="lead">'),get_field('faq_answer')); ?>
		</div>
		<footer>
		    <p>
		    	<time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
		    	<a class="link" href="<?=get_permalink(get_the_ID())?>">Permalink</a>
		    	<?php $terms = wp_get_post_terms(get_the_ID(), 'faq-section'); if(!empty($terms)): ?>
		    		<a class="section" href="<?=get_term_link($terms[0])?>"><?=$terms[0]->name?></a>
		    	<?php endif; ?>
		    	<?php $terms = wp_get_post_terms(get_the_ID(), 'faq-topic'); if(!empty($terms)): ?>
		    		<span class="topics"><?php the_terms(get_the_ID(), 'faq-topic') ?></span>
		    	<?php endif; ?>
		    </p>
	  </footer>
	</article>
	<br>
	<div class="related-faqs">
	    <h3>You might also like:</h3>
		<?php
	  	$related = get_field('faq_related');
		if( $related ): ?>
		    <?php foreach( $related as $post): ?>
		        <?php setup_postdata($post); ?>
	  			<?php get_template_part('templates/faq'); ?>
		    <?php endforeach; ?>
		    <?php wp_reset_postdata(); ?>
		<?php else: ?>
			<div class="alert alert-warning">
			    <?php _e('Sorry, there no related FAQs available at this time.', 'roots'); ?>
			</div>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
<?php endwhile; ?>