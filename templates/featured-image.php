<?php if(has_post_thumbnail()): $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
	<div class="featured-image">
		<div class="panel-body">
			<a href="<?php echo $img[0]; ?>" data-toggle="lightbox" data-gallery="gallery-<?=$post->ID?>" data-parent=".content" data-type="image">
				<?php 
				switch($post->post_type){
					case 'post':
						$size = is_archive() ? 'blog-thumb' : 'panel-image';
						break;

					case 'case-study':
						$size = 'category-thumb';
						break;

					default:
						$size = 'panel-image';
						break;
				}
				the_post_thumbnail($size); ?>
				<div class="overlay"><i class="fa fa-fw fa-4x fa-search-plus"></i></div>
			</a>
		</div>
	</div>
<?php endif; ?>