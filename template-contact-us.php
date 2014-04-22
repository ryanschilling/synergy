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
		<br>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<div class="img-thumbnail" style="width:100%;">
			<div style="overflow:hidden;height:400px;width:100%;">
				<div id="gmap_canvas" style="height:400px;width:100%;"></div>
				<a class="google-map-code" href="http://www.map-embed.com" id="get-map-data">my response</a>
				<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
			</div>
			<script type="text/javascript">
				function init_map(){
					var myOptions = {zoom:14,center:new google.maps.LatLng(29.53117129999999,-98.49531460000003),mapTypeId: google.maps.MapTypeId.ROADMAP};
					map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
					marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(29.53117129999999, -98.49531460000003)});
					infowindow = new google.maps.InfoWindow({content:"<b>Synergy Telecom, Inc.</b><br/>10010 San Pedro Avenue<br/>78216 San Antonio" });
					google.maps.event.addListener(marker, "click", function(){
						infowindow.open(map,marker);
					});
					infowindow.open(map,marker);
				}
				google.maps.event.addDomListener(window, 'load', init_map);
			</script>
		</div>
		<hr>
		<div class="row">
			<address class="col-sm-6">
				<strong>Synergy Telecom, Inc.</strong><br>
				10010 San Pedro Avenue<br>
				Suite 350<br>
				San Antonio, TX 78216
			</address>
			<address class="col-sm-6"><br>
				<abbr title="Phone">Call</abbr> <a href="tel:+12104388647">(210) GET-VOIP</a><br>
				<abbr title="Email">Email</abbr> <a href="mailto:sales@synergytele.com">sales@synergytele.com</a>
			</address>
		</div>
	</div>
</div>