<?php global $item; ?>
<div class="col-sm-12 col-md-6">
  <h3><a href="<?=get_permalink($item->ID)?>"><?=$item->post_title?></a></h3>
  <p><?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?></p>
  <p>
    <a href="<?=get_permalink($item->ID)?>">
      <?=get_field('embed_button', $item->ID); ?>
      <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
    </a>
  </p>
</div>