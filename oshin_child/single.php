<?php
/*
 *  The template for displaying a Blog Post.
 *
 * mods:
 *   17Oct16 zig - Add post navigation
 *	20Oct16 zig - add Author meta box
*/
get_header();
global $be_themes_data;
$sidebar_flag = (array_key_exists('blog_single_sidebar', $be_themes_data) ) ?  $be_themes_data['blog_single_sidebar'] : '1' ;
$blog_style = ((!isset($be_themes_data['blog_style'])) || empty($be_themes_data['blog_style'])) ? 'style1' : $be_themes_data['blog_style'];
$sidebar = 'right';
$sidebar = ( isset($sidebar_flag) && '1' != $sidebar_flag) ? 'no' : $sidebar;
$content_single_sidebar = ( isset($sidebar_flag) && '1' != $sidebar_flag) ? '' : 'content-single-sidebar';
$enable_breadcrumb = ( isset($be_themes_data['enable_breadcrumb']) && 1 == $be_themes_data['enable_breadcrumb']) ? 1 : 0;

while ( have_posts() ) : the_post(); ?>
	<?php
	if($enable_breadcrumb){
		get_template_part( 'page-blogpost-breadcrumb' );
	}?>
	<section id="content" class="<?php echo esc_attr( $sidebar ); ?>-sidebar-page">
		<div id="content-wrap" class="be-wrap clearfix">
			<section id="page-content" class=" <?php echo $content_single_sidebar; ?> ">
				<div class="clearfix <?php echo esc_attr( $blog_style ); ?>-blog">
					<?php
						$blog_style = be_get_blog_loop_style( $blog_style );
						get_template_part( 'blog/loop', $blog_style );
					?>
				</div> <!--  End Page Content -->
				<div id="author-box">
					<div class="be-section-pad">
						<div class="be-row be-wrap be-no-space ">
							<div class="one-fifth column-block">
								<?php
									$user = get_the_author_meta('ID');
									echo get_avatar($user,120);
								?>
							</div>
							<div class="two-third column-block">
								<h6 class="author-name uppercase">
									<?php echo esc_html( get_the_author_meta( 'display_name' ) );?>
								</h6>

								<?php if(get_the_author_meta('yim')){?>
								<p class="author-title"><?php echo esc_html(get_the_author_meta('yim')); ?></p>
								<?php }?>

								<p class="author-desc"><?php echo esc_html(get_the_author_meta('description'));?></p>

								<?php if(get_the_author_meta('aim')){?>
								<p class="author-twitter"><a href="http://twitter.com/<?php echo get_the_author_meta('aim');?>"><?php echo esc_html(get_the_author_meta('aim'));?></a></p>
								<?php }?>
							</div> <!--end -->
						</div> <!-- end row -->
					</div> <!-- end section -->
				</div> <!-- end author box -->
				<!-- post navigation -->
				<div class="post-navigation">
					<!--h4 class="aligncenter">Additional Posts</h4-->
					<div class="alignleft"><?php echo get_previous_post_link(); ?></div>
					<div class="alignright"><?php next_post_link(); ?></div>
				</div>
				<!-- end post navigation -->
				<div class="be-themes-comments">
					<?php comments_template( '', true ); ?>
				</div> <!--  End Optional Page Comments -->
			</section>
			<?php if ('no' != $sidebar ){?>
				<section id="<?php echo esc_attr( $sidebar ); ?>-sidebar" class="sidebar-widgets">
					<?php get_sidebar( $sidebar ); ?>
				</section>
			<?php } ?>
		</div>
	</section> <?php
endwhile;
get_footer();
?>
