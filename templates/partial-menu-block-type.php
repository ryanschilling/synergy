<?php global $term; ?>
<?php $term_link = get_term_link($term, 'product-type'); ?>
<div class="menu-block type">
  <?php
  // Product photos
  $products = new WP_Query(
	array(
		'post_type' => 'product',
		'posts_per_page' => 1,
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'product-type',
				'terms' => $term->term_id
			)
		)
	));
  if ( $products->have_posts() ) {
    while ( $products->have_posts() ) {
      $products->the_post();
      echo '<div class="panel"><div class="panel-body"><a href="' . $term_link . '">';
      the_post_thumbnail('video-thumb');
	  ?>
	  <div class="overlay"><i class="fa fa-fw fa-4x fa-search-plus"></i></div>
      <?php
      echo '</a></div></div>';
    }
  }
  wp_reset_postdata();
  ?>
  <div class="description">
    <h3><a href="<?=$term_link?>"><?=$term->name?></a></h3>
    <p><?=$term->description?></p>
    <p>
      <a href="<?=$term_link?>">
        View products in <?=strtolower($term->name)?>
        <i class="fa fa-fw fa-chevron-right"></i>
      </a>
    </p>
  </div>
</div>