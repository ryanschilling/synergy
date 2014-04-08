<div class="breadcrumbs hidden-xs" xmlns:v="http://rdf.data-vocabulary.org/#">
  <div class="container">
  	<?php 
    // Landing page submenu
    if(is_page_template('template-solutions.php')):
      get_template_part('templates/breadcrumbs', 'landing');
    
    // Subpage breadcrumbs
    else:
      get_template_part('templates/breadcrumbs', 'default');
    endif;
    ?>
  </div>
</div>