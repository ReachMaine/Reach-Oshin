<?php 
/**************************************
			RECENT POSTS, allow more than 3.
**************************************/
if ( ! function_exists( 'reach_recent_posts' ) ) {
	function reach_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array (
			'number'=>'three',
			'hide_excerpt' => '',
	    ), $atts ) );
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}
		$hide_excerpt = (isset($hide_excerpt) && ($hide_excerpt)) ? 'hide-excerpt' : '' ;
		$args=array (
			'post_type' => 'post',
			//'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		global $meta_sep, $blog_attr;
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			$output .= '<div id="ms-container" class="clearfix related-items style3-blog reach_blog_posts '.$hide_excerpt.'">';
			$blog_attr['style'] = 'shortcodes';
			//$blog_attr['style'] = '';
			$blog_attr['gutter_width'] = 0;
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				//$output .= '<div class="ms-item one-'.$column.' column-block be-hoverlay">';
				$output .= '<div class="ms-item">';
				ob_start();
				get_template_part( 'blog/loop', $blog_attr['style'] );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();

		return $output;
	}
	add_shortcode( 'reach_recent_posts', 'reach_recent_posts' );
}