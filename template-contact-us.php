<?php
/*
Template Name: Contact Us Page
*/
?>

<div class="row">
	<div class="col-sm-6">
		<?php while (have_posts()) : the_post(); ?>
		  <?php the_content(); ?>
		  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
		<?php endwhile; ?>
	</div>
	<div class="col-sm-6">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<div class="img-thumbnail" style="width:100%;">
			<div style="overflow:hidden;height:400px;width:100%;">
				<div id="gmap_canvas" style="height:400px;width:100%;"></div>
				<a class="google-map-code" href="http://www.map-embed.com" id="get-map-data">my response</a>
				<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
			</div>
		</div>
		<hr>
		<div class="row">
			<address class="address-for-map col-sm-6" data-zoom="14" data-lat="29.53117129999999", data-lng="-98.49531460000003">
				<strong>Synergy Telecom, Inc.</strong><br/>10010 San Pedro Avenue #350<br/>San Antonio, TX 78216<br>Hours: 8-5 Mon-Fri
			</address>
			<address class="col-sm-6"><br>
				<abbr title="Phone">Call</abbr> <a href="tel:+12104388647">(210) GET-VOIP</a><br>
				<abbr title="Email">Email</abbr> <a href="mailto:sales@synergytele.com">sales@synergytele.com</a><br>
				<abbr title="Email">Email</abbr> <a href="mailto:support@synergytele.com">support@synergytele.com</a>
			</address>
		</div>
	</div>
</div>