<?php
/**
 * Shortcode que incluye posts del blog
 * @attrs
 */
function mr_mam_print_blog_posts($atts) {
    $html = '';
    $res = array();

    // Attributes
	$atts = shortcode_atts(
		array(
            'num' => '4',
            'type' => 'post'
		),
		$atts
    );
    
    // Obtengo los posts
    // WP_Query arguments
    $args = array(
        'post_type'              => array( $atts['type'] ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true,
        'posts_per_page'         => $atts['num'],
        'order'                  => 'DESC',
        'orderby'                => 'date',
    );

    // The Query
    $my_query = new WP_Query( $args );

    // The Loop
    if ( $my_query->have_posts() ) {

        // Determino la estructura del HTML
        switch ($atts['num']) {
            case '1':
                $class = 'col-xs-12';
                break;
            case '2':
                $class = 'col-xs-12 col-sm-6';
                break;
            case '3':
                $class = 'col-xs-12 col-sm-6 col-md-4';
                break;
            default:
                $class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';
                break;
        }
            
        // Formo el HTML
        $html = '<div class="row mr-mam-blog-posts">';

        while ( $my_query->have_posts() ) {
            $my_query->the_post();
                for ($i=0; $i < $atts['num']; $i++) { 
                    $html .= '<div class="'.$class.'">
                        <div class="mr-mam-blog-posts__img">'.get_the_post_thumbnail().'</div>
                        <div class="mr-mam-blog-posts__title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>
                        <div class="mr-mam-blog-posts__excerpt">'.get_the_excerpt().'</div>
                    </div>';
                }
        }
        
        $html .= '</div>';

        // Respuesta
        $res['succeed'] = true;
    } else {
        // Respuesta
        $res['succeed'] = false;
    }

    // Restore original Post Data
    wp_reset_postdata();

    $res['html'] = $html;

    return $res;
}
add_shortcode( 'mr-mam-print-blog-posts', 'mr_mam_print_blog_posts' );