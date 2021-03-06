<?php
/* mods
* 31 Oct16 zig - if not single use medium image size.
*/
global $be_themes_data, $blog_attr;
if( has_post_thumbnail() ) :
	if(!is_single()){
		$blog_image_size = 'medium'; }
	else {
		$blog_image_size = 'blog-image';
	    if( $blog_attr['style'] == 'style3' ) {
	    	$blog_image_size = 'portfolio-masonry';
	    }
	}
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $blog_image_size );
    $thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$url = $thumb['0'];
	$attachment_full_url = $thumb_full[0];
	$link = $attachment_full_url;
endif;
$class = '';
if((isset($be_themes_data['open_to_lightbox']) && 1 == $be_themes_data['open_to_lightbox']) ) { //|| is_single()
	$class = 'image-popup-vertical-fit mfp-image';
} else {
	if(!is_single()){
		$link = get_permalink();
	}else{
		$link = '#';
	}
}
if( !empty( $url )  ) {
	if (!is_single()  || (get_post_meta(get_the_ID(), 'reach_disable_thumb', true)  != 'yes')  )  {

?>
<div class="post-thumb">
	<div class="">
		<a href="<?php echo esc_url( $link ) ?>" class="<?php echo $class; ?> thumb-wrap"><?php the_post_thumbnail( $blog_image_size ); ?>
			<div class="thumb-overlay">
				<div class="thumb-bg">
					<div class="thumb-title fadeIn animated">
						<i class="portfolio-ovelay-icon"></i>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
<?php  } } ?>
