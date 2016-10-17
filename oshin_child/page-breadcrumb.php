<?php /* mods 
 * 17Oct16 zig - dont show breadcrumbs & put page title in h1 container
 */
$output = '';
$output .= '<div class="title-module-wrap page-title-module-custom"><div class="be-wrap clearfix">';
//$output .= '<div class="left page-title-custom">';
$output .= '<h2 class="page-title">';
ob_start();  
get_template_part( 'page', 'title' ); 
$output .= ob_get_contents();  
ob_end_clean();
//$output .= '</div>';
$output .= '</h2>';
//$output .= '<div class="right header-breadcrumb">'.get_be_themes_breadcrumb().'</div>';
$output .= '</div></div>';
echo $output;
?>