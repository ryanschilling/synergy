<div class="block <?=$post->post_type?>">
  <div class="panel">
    <div class="panel-heading">
      <h3><?php $series = wp_get_post_terms(get_the_ID(), 'training-video-series'); echo empty($series) ? 'Training Video' : $series[0]->name; ?></h3>
    </div>
    <div class="panel-body">
      <a href="<?=get_permalink($post->ID)?>">
        <?=get_the_post_thumbnail($post->ID, 'panel-image'); ?>
        <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $post->ID); ?>"></i></div>
      </a>
    </div>
  </div>
  <div class="description">
    <h2><?=$post->post_title; ?></h2>
    <?php the_excerpt(); ?>
    <p>
      <a href="<?=get_permalink($post->ID)?>" class="btn btn-lg btn-primary">
        <i class="fa fa-fw fa-<?=get_field('embed_icon', $post->ID); ?>"></i>
        <?=get_field('embed_button', $post->ID); ?>
      </a>
    </p>
  </div>
</div>