<article <?php post_class('faq-collapse'); ?>>
	<header>
	  <h2 class="entry-title">
	  	<a data-toggle="collapse" href="#faq<?php the_ID(); ?>">
	  		<?php the_field('faq_question'); ?>
	  	</a>
	  </h2>
	</header>
	<div id="faq<?php the_ID(); ?>" class="entry-content collapse">
	  <?php the_field('faq_answer'); ?>
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
	  	<?php
	  	$related = get_field('faq_related');
		if( $related ): ?>
			<hr>
		    <h3>Related Question<?php if(count($related) > 1) echo 's'; ?>:</h3>
		    <ul>
		    <?php foreach( $related as $post): ?>
		        <?php setup_postdata($post); ?>
		        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		    <?php endforeach; ?>
		    </ul>
		    <?php wp_reset_postdata();
		endif;
		?>
	  </footer>
	</div>
</article>