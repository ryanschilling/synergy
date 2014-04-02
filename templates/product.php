<div class="block <?=$post->post_type?>">
  <div class="panel">
    <div class="panel-heading">
      <?php
      	$manufacturer = wp_get_post_terms(get_the_ID(), 'product-manufacturer');
      	if(!empty($manufacturer)):
      		echo '<h3>'.$manufacturer[0]->name.'</h3>';
      	else:
      		$type = wp_get_post_terms(get_the_ID(), 'product-type');
      		if(!empty($type)):
      			echo '<h3>'.$type[0]->name.'</h3>';
      		else:
      			echo '<h3>Synergy Products</h3>';
      		endif;
      	endif;
      ?>
    </div>
    <div class="panel-body">
    	<a href="<?=get_permalink($post->ID)?>">
      		<?=get_the_post_thumbnail($post->ID, 'panel-image'); ?>
      		<div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $post->ID); ?>"></i></div>
    	</a>      
    </div>
  </div>
  <div class="description">
    <h2><a href="<?=get_permalink($post->ID)?>"><?=$post->post_title; ?></a></h2>
    <?php the_excerpt(); ?>
  </div>
</div>