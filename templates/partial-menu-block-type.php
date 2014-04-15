<?php global $term; ?>
<?php $term_link = get_term_link($term, 'product-type'); ?>
<div class="menu-block type">
  <h3><a href="<?=$term_link?>"><?=$term->name?></a></h3>
  <p><?=$term->description?></p>
  <p>
    <a href="<?=$term_link?>">
      View products in <?=strtolower($term->name)?>
      <i class="fa fa-fw fa-chevron-right"></i>
    </a>
  </p>
</div>