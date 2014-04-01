<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <div class="panel">
      	<div class="panel-heading">
      		<h3 class="panel-title"><?=the_title()?></h3>
      	</div>
      	<div class="panel-body">
      		<iframe class="video" src="<?=get_field('training_video_link');?>?controls=2&modestbranding=1&origin=<?=urlencode('http://'.$_SERVER["HTTP_HOST"])?>&showinfo=0&theme=light&rel=0" width="100%" height="300" frameborder="0" allowfullscreen></iframe>
      	</div>
      </div>

      <?php the_content(); ?>
    </div>
    <footer>
    	<div class="row">
    		<?php if($video = get_field('training_video_previous')): ?>
    		<div class="prev-video col-xs-12 col-md-6">
    			<div class="row">
    				<div class="image col-xs-4">
    					<a href="<?=get_permalink($video->ID)?>">
    					    <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'video-thumb');?>
    						<img src="<?=$img[0]?>" alt="<?=$video->post_title?>">
    					</a>
    				</div>
    				<div class="description col-xs-8">
    					<h4>Previous Video:</h4>
    					<h3><a href="<?=get_permalink($video->ID)?>"><?=$video->post_title?></a></h3>
    					<?php the_excerpt(); ?>
    				</div>
    			</div>
    		</div>
    		<?php endif; ?>

			<?php if($video = get_field('training_video_next')): ?>
    		<div class="next-video col-xs-12 col-md-6 pull-right">
    			<div class="row">
    				<div class="image col-xs-4">
    					<a href="<?=get_permalink($video->ID)?>">
    					    <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'video-thumb');?>
    						<img src="<?=$img[0]?>" alt="<?=$video->post_title?>">
    					</a>
    				</div>
    				<div class="description col-xs-8">
    					<h4>Next Video:</h4>
    					<h3><a href="<?=get_permalink($video->ID)?>"><?=$video->post_title?></a></h3>
    					<?php the_excerpt(); ?>
    				</div>
    			</div>
    		</div>
    		<?php endif; ?>
    	</div>
	</footer>
  </article>
<?php endwhile; ?>