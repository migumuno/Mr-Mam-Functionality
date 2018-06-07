<?php
/**
 * Shortcode que incluye posts del blog
 * @atts
 */
function mr_mam_print_blog_posts($atts) {
    $html = '';

    // Attributes
	$atts = shortcode_atts(
		array(
            'num' => '4',
            'type' => 'post'
		),
		$atts
    );
    
    $res = mr_mam_get_some_posts($atts['num'], $atts['type']);

    if( $res['success'] ):
        echo $res['html'];
    endif;
}
add_shortcode( 'mr-mam-print-blog-posts', 'mr_mam_print_blog_posts' );