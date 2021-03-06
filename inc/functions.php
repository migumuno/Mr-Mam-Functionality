<?php
/**
 * Función que obtiene el número de posts del tipo indicado
 * @num
 * @type
 * return array
 */
function mr_mam_get_some_posts($num = 4, $type = 'post') {
    // Obtengo los posts
    // WP_Query arguments
    $args = array(
        'post_type'              => array( $type ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true,
        'posts_per_page'         => $num,
        'order'                  => 'DESC',
        'orderby'                => 'date',
    );

    // The Query
    $my_query = new WP_Query( $args );

    // The Loop
    if ( $my_query->have_posts() ) {

        // Determino la estructura del HTML
        switch ($num) {
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
            $title = get_the_title();
            if(strlen(get_the_title()) > 36) {
                $title = substr($title, 0, 36).'...';
            }

            $html .= '<div class="mr-mam-blog-posts__post '.$class.'">
                <div class="mr-mam-blog-posts__post--img">'.get_the_post_thumbnail().'</div>
                <h3><a href="'.get_permalink().'">'.$title.'</a></h3>
            </div>';
        }
        
        $html .= '</div>';

        // Respuesta
        $res['success'] = true;
    } else {
        // Respuesta
        $res['success'] = false;
    }

    // Restore original Post Data
    wp_reset_postdata();

    $res['html'] = $html;

    return $res;
}

/**
 * Función que devuelve los terms
 */
function mr_mam_get_terms( $term = 'category' ) {
    $terms = get_terms( array(
        'taxonomy'      =>  $term,
        'hide_empty'    =>  true,
        'orderby'       =>  'name',
        'order'         =>  'ASC'
    ) );

    return $terms;
}