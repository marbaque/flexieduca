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
function flexieduca_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular() && !is_tax('tendencia')) {
	$classes[]	 = 'hfeed';
	$classes[]	 = 'archive-view';
    }
    if ( is_page_template('page-casos.php') || is_page_template('page-casos-estrategia.php') ) {
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
	
	if (is_singular('modulo')) {
		$classes[] = 'modulo';
	}

    return $classes;
}

add_filter('body_class', 'flexieduca_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function flexieduca_pingback_header() {
    if (is_singular() && pings_open()) {
	echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'flexieduca_pingback_header');

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

function my_mce_before_init_insert_formats($init_array) {

// Define the style_formats array

    $style_formats			 = array(
	/*
	 * Each array child is a format with it's own settings
	 * Notice that each array has title, block, classes, and wrapper arguments
	 * Title is the label which will be visible in Formats menu
	 * Block defines whether it is a span, div, selector, or inline style
	 * Classes allows you to define CSS classes
	 * Wrapper whether or not to add a new block-level element around any selected elements
	 */
	array(
	    'title'		=> 'Recuadro',
	    'block'		=> 'div',
	    'classes'	=> 'formato-recuadro',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Actividad virtual',
	    'block'		=> 'div',
	    'classes'	=> 'formato-actividad',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Importante',
	    'block'		=> 'div',
	    'classes'	=> 'formato-importante',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Mirada',
	    'block'		=> 'div',
	    'classes'	=> 'formato-mirada',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Ejercicio de autoevaluación',
	    'block'		=> 'div',
	    'classes'	=> 'formato-ejercicio',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Recuadro de idea',
	    'block'		=> 'div',
	    'classes'	=> 'formato-idea',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Recuadro de resumen',
	    'block'		=> 'div',
	    'classes'	=> 'formato-resumen',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Recuadro de nota',
	    'block'		=> 'div',
	    'classes'	=> 'formato-nota',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Recuadro de búsqueda',
	    'block'		=> 'div',
	    'classes'	=> 'formato-busqueda',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Comentario',
	    'block'		=> 'div',
	    'classes'	=> 'comentario-inicial',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Recuadro de comentario + H5P',
	    'block'		=> 'div',
	    'classes'	=> 'comentario-h5p',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Pie de tabla',
	    'block'		=> 'div',
	    'classes'	=> 'table-source',
	    'wrapper'	=> true,
	),
	array(
	    'title'		=> 'Referencia APA',
	    'block'		=> 'p',
	    'classes'	=> 'fuente-apa',
	    'wrapper'	=> false,
	),
	
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;
}

// Attach callback to 'tiny_mce_before_init' 
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');

/* * ********************************************************************* */

// custom logo
/* * ********************************************************************* */

function my_login_logo() {
    ?>
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
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url() {
    return home_url();
}

add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title() {
    return 'Mercadeo digital';
}

add_filter('login_headertitle', 'my_login_logo_url_title');


/* * ********************************************************************* */
// custom top bar
/* * ********************************************************************* */
add_action('wp_before_admin_bar_render', 'remove_logo', 7);

function remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

//Las siguientes funciones son para agregar un metabox de parent-post
//o sea, para escoger el contenido al que pertenecen los casos
//Updating the “Parent” meta box
function my_add_meta_boxes() {
    add_meta_box('caso-parent', 'Contenido Padre', 'lesson_attributes_meta_box', 'caso', 'side', 'high');
}

add_action('add_meta_boxes', 'my_add_meta_boxes');

function lesson_attributes_meta_box($post) {
    $post_type_object	 = get_post_type_object($post->post_type);
    $pages			 = wp_dropdown_pages(array('post_type' => 'multimedia', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __('Sin contenido principal', 'flexieduca'), 'sort_column' => 'menu_order, post_title', 'echo' => 0));
    if (!empty($pages)) {
	echo $pages;
    }
}

//Setting the exactly URL structure
function my_add_rewrite_rules() {
    add_rewrite_tag('%caso%', '([^/]+)', 'caso=');
    add_permastruct('caso', '/caso/%multimedia%/%caso%', false);
    add_rewrite_rule('^caso/([^/]+)/([^/]+)/?', 'index.php?caso=$matches[2]', 'top');
}

add_action('init', 'my_add_rewrite_rules');

//Updating the permalink for our custom post type
function my_permalinks($permalink, $post, $leavename) {
    $post_id	 = $post->ID;
    if ($post->post_type != 'caso' || empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft')))
		return $permalink;
	    $parent		 = $post->post_parent;
	    $parent_post	 = get_post($parent);
	    $permalink	 = str_replace('%multimedia%', $parent_post->post_name, $permalink);
	    return $permalink;
}

add_filter('post_type_link', 'my_permalinks', 10, 3);

//hide admin bar for users except administrators
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
	show_admin_bar(false);
    }
}

//Redireccionar usuarios al home despues del login
function login_redirect( $redirect_to, $request, $user ){
    return home_url();
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );