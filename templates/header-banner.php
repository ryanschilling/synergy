<?php

// Home page slider
if(is_front_page()):
  get_template_part('templates/banner', 'slider');

// Landing page video banner
elseif(is_page_template('template-solutions.php')):
  get_template_part('templates/banner', 'video');

// Subpage banner
else:
  get_template_part('templates/banner', 'default');
endif;

?>