<?php global $item; ?>
<div class="menu-block">
  <h3> <a href="<?=get_permalink($item->ID)?>"><?=$item->post_title?></a></h3>
  <div class="panel">
    <div class="panel-body">
      <a href="<?=get_permalink($item->ID)?>">
        <?=get_the_post_thumbnail($item->ID, 'panel-image'); ?>
        <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $item->ID); ?>"></i></div>
      </a>
    </div>
  </div>
  <?php /*
  <p><?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?></p>
  <p>
    <a href="<?=get_permalink($item->ID)?>">
      <?=get_field('embed_button', $item->ID); ?>
      <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
    </a>
  </p>
  */ ?>
</div>