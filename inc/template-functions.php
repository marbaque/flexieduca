<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Flexieduca
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function flexieduca_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() && ! is_tax( 'tendencia' ) ) {
		$classes[] = 'hfeed';
		$classes[] = 'archive-view';
	}
	
	if ( is_page('casos-estrategias-comercio-movil') ) {
		$classes[] = 'casos-index';
	}
	
	// Adds a class telling us if the sidebar is in use.
    if (!is_singular('multimedia') && is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    // Adds a class telling us if the sidebar is in use.
    if (is_page() && is_active_sidebar('sidebar-2')) {
        $classes[] = 'has-page-sidebar';
    } else {
        $classes[] = 'has-no-page-sidebar';
    }
    // Adds a class telling us if the sidebar is in use.
    if (is_active_sidebar('sidebar-3') && is_front_page()) {
        $classes[] = 'has-front-sidebar';
    } else if (!is_active_sidebar('sidebar-3') && is_front_page()) {
        $classes[] = 'has-no-front-sidebar';
    }
    
	return $classes;
}
add_filter( 'body_class', 'flexieduca_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function flexieduca_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'flexieduca_pingback_header' );

/*
 * Add custom styles to the visual editor
 */
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
    $style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
        array(  
            'title' => 'Actividad virtual',  
            'block' => 'div',  
            'classes' => 'formato-actividad',
            'wrapper' => true,
             
        ),  
        array(  
            'title' => 'Importante',  
            'block' => 'div',  
            'classes' => 'formato-importante',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Mirada',  
            'block' => 'div',  
            'classes' => 'formato-mirada',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Ejercicio de autoevaluación',  
            'block' => 'div',  
            'classes' => 'formato-ejercicio',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Idea',  
            'block' => 'div',  
            'classes' => 'formato-idea',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Pie de tabla',  
            'block' => 'div',  
            'classes' => 'table-source',
            'wrapper' => true,
        ),
        array(
	        'title' => 'Llamada de comentario',
	        'block' => 'div',
	        'classes' => 'comenta',
	        'wrapper' => true,
        ),
        array(
	        'title' => 'Fuente consultada (APA)',
	        'block' => 'p',
	        'classes' => 'fuente-apa',
	        'wrapper' => false,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/************************************************************************/
// custom logo
/************************************************************************/

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
	        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png);
	        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);
			height:65px;
			width:320px;
			background-size: 320px 65px;
			background-repeat: no-repeat;
        	padding-bottom: 0;
        }
        .login #nav a,
        .login #nav a:visited {
			text-decoration: none;
			color: #fff!important;
			background: #D96C70;
			padding: 4px;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Mercadeo digital';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/************************************************************************/
// custom top bar
/************************************************************************/
add_action( 'wp_before_admin_bar_render', 'remove_logo', 7);
function remove_logo() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}