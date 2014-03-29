<nav class="sidebar-menu">
	<?php
	  if (has_nav_menu('solutions_navigation')) :
	    wp_nav_menu(array('theme_location' => 'solutions_navigation', 'menu_class' => '', 'depth' => 3));
	  endif;
	?>
</nav>
<?php dynamic_sidebar('sidebar-primary'); ?>