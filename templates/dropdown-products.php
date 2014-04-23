<div id="menu-products-dropdown">
  <div class="menu-well">
    <div class="menu-dropdown">
      <?php
      $terms = get_terms('product-type', 'hide_empty=0&order_by=count&order=DESC');
      if(!empty($terms)):
        foreach($terms as $item):
          if($item->parent == 0):
            global $term;
            $term = $item;
            get_template_part('templates/partial-menu-block','type');
          endif;
        endforeach;
      endif;
      ?>
    </div>
  </div>
  <div class="menu-banner">
    <div class="menu-banner-text">
      <h4>Revolutionize your business communications with Synergy's VoIP products.</h4>
    </div>
    <div class="menu-banner-button">
      <a href="<?=get_permalink(119)?>">Build Your System</a>
    </div>
  </div>
</div>