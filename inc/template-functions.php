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
    if (is_single() && is_active_sidebar('sidebar-1') || is_page() && is_active_sidebar('sidebar-2')) {
		$classes[] = 'has-sidebar';
    } else {
		$classes[] = 'no-sidebar';
    }

	if (is_singular('modulo')) {
		$classes[] = 'modulo';
	}

	if (is_page('exitometro')) {
		$classes[] = 'exitometro-page';
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

function my_mce_format($init_array) {

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
add_filter('tiny_mce_before_init', 'my_mce_format');

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


// Mostrar barra de admin sólo a admins, autores y editores
add_action( 'init', 'remove_admin_bar_user', 10001 );
function remove_admin_bar_user() {

	if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || current_user_can( 'author' ) || current_user_can( 'encargado_curso' ) ) {
		
		show_admin_bar( true );
	
	} else {
		
		show_admin_bar( false );
	}
}

//Redireccionar usuarios al home despues del login
function loginRedirect( $redirect_to, $request_redirect_to, $user ) {
    if ( is_a( $user, 'WP_User' ) && $user->has_cap( 'edit_posts' ) === false ) {
        return get_bloginfo( 'siteurl' );
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'loginRedirect', 10, 3 );


//Audio player - estilos

add_action( 'wp_footer', 'flexieduca_footer_scripts' );

function flexieduca_footer_scripts() {
	if ( wp_style_is( 'wp-mediaelement', 'enqueued' ) ) {
		wp_enqueue_style( 'flexieduca-player', get_template_directory_uri() . '/inc/audio-player.css', array(
			'wp-mediaelement',
		), '1.0' );
	}
}

/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
add_action( 'wp_print_footer_scripts', 'flexieduca_mejs_add_container_class' );

function flexieduca_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'exampleclass' );
		MediaElementPlayer.prototype.buildexampleclass = function( player ) {
			player.container.addClass( 'flexieduca-mejs-container' );
		};
	})();
	</script>
	<?php
}

//Edit the Dashboard Footer
function change_admin_footer(){
	 echo '<span id="footer-note">Desarrollado por <a href="http://multimedia.uned.ac.cr/" target="_blank">Multimedia UNED</a>.</span>';
	}
add_filter('admin_footer_text', 'change_admin_footer');

//limitar acceso al dashboard
function remove_menus(){
     if ( !is_admin() || !current_user_can( 'manage_options' ) ) {
          remove_menu_page( 'index.php' );
          remove_menu_page( 'wp-admin/admin.php/*' );
     }
}
add_action( 'admin_menu', 'remove_menus' );


//badge os fix navigation
// add_action( 'wp_head', function() {
//     if( is_singular( 'multimedia' ) || is_singular('caso') || is_singular('actividad') ) {
//         remove_filter('previous_post_link', 'badgeos_hide_previous_hidden_achievement_link');
//         remove_filter('next_post_link', 'badgeos_hide_next_hidden_achievement_link');
//     }
// });
