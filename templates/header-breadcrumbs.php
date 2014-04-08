<div class="breadcrumbs hidden-xs" xmlns:v="http://rdf.data-vocabulary.org/#">
  <div class="container">
  	<?php 
    // Landing page submenu
    if(is_page_template('template-solutions.php')):
      get_template_part('templates/breadcrumbs', 'landing');
    
    // Products landing page submenu and product slider
    elseif(is_page_template('template-products.php')):
        get_template_part('templates/breadcrumbs', 'landing');
        get_template_part('templates/breadcrumbs', 'products');

    // Subpage breadcrumbs
    else:
      get_template_part('templates/breadcrumbs', 'default');
    endif;
    ?>
  </div>
</div>