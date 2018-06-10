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
        return $res['html'];
    endif;
}
add_shortcode( 'mr-mam-print-blog-posts', 'mr_mam_print_blog_posts' );

/**
 * Shortcode que imprime las formas de contacto
 */
function mr_mam_formas_contacto() {
    $html = '
    <ul class="formas-de-contacto">
        <li class="welcome-icons_list"><a href="mailto:hey@mistermam.com"><i class="fas fa-envelope"></i></a></li>
        <li class="welcome-icons_list"><a href="tel:+34696984784"><i class="fas fa-phone"></i></a></li>
        <li class="welcome-icons_list"><a href="https://www.linkedin.com/in/miguelangelmunozviejo/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        <li class="welcome-icons_list"><a href="https://twitter.com/mrmam_code" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <li class="welcome-icons_list"><a href="'.get_stylesheet_directory_uri().'/docs/cv.pdf" download target="_blank"><i class="fas fa-file-alt"></i></a></li>
    </ul>
    ';

    return $html;
}
add_shortcode( 'mr_mam_formas_contacto', 'mr_mam_formas_contacto' );