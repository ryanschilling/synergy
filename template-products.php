<?php
/*
Template Name: Products Landing Page
*/
?>

<div class="row">
	<div class="software-apps">
		<?php echo get_field('left_column'); ?>
	</div>
	<div class="mobile-apps">
		<?php echo get_field('right_column'); ?>
	</div>

	<div class="col-xs-12">
		<hr>
		<?php get_template_part('page'); ?>
	</div>
</div>