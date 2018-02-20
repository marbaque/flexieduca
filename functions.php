<?php

/**
 * flexieduca functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package flexieduca
 */
if (!function_exists('flexieduca_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function flexieduca_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on flexieduca, use a find and replace
         * to change 'flexieduca' to the name of your theme in all the template files.
         */
        load_theme_textdomain('flexieduca', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('flexieduca-full-bleed', 1280, 720, true);
        add_image_size('flexieduca-index-img', 740, 420, true);
        add_image_size('flexieduca-gallery-img', 568, 300, true);
        add_image_size('flexieduca-thumb', 80, 80, true);
        add_image_size('flexieduca-case-thumb', 300, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary menu', 'flexieduca'),
            'menu-2' => esc_html__('Front menu', 'flexieduca'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
//        add_theme_support('custom-background', apply_filters('flexieduca_custom_background_args', array(
//            'default-color' => 'ffffff',
//            'default-image' => '',
//        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
//        add_theme_support('custom-logo', array(
//            'height' => 390,
//            'width' => 67,
//            'flex-width' => true,
//            'flex-height' => true,
//        ));
        
        
        /*Editor styles*/
        add_editor_style( array( 'inc/editor-styles.css', flexieduca_fonts_url() ) );
    }

endif;
add_action('after_setup_theme', 'flexieduca_setup');
/**
 * Register custom fonts.
 */
function flexieduca_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$gfont = _x( 'on', 'Rubik font: on or off', 'flexieduca' );

	if ( 'off' !== $gfont ) {
		$font_families = array();

		$font_families[] = 'Rubik:400,400i,700,700i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function flexieduca_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'flexieduca-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'flexieduca_resource_hints', 10, 2 );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flexieduca_content_width() {
    $GLOBALS['content_width'] = apply_filters('flexieduca_content_width', 720); // max width of embedded contents like youtube
}

add_action('after_setup_theme', 'flexieduca_content_width', 0);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function flexieduca_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];

    if (900 <= $width) {
        $sizes = '(min-width: 900px) 700px, 900px';
    }

    if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2') || is_active_sidebar('sidebar-3')) {
        $sizes = '(min-width: 900px) 600px, 900px';
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'flexieduca_content_image_sizes_attr', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flexieduca_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'flexieduca'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'flexieduca'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Page Sidebar', 'flexieduca'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add page sidebar widgets here.', 'flexieduca'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Front Page Sidebar', 'flexieduca'),
        'id' => 'sidebar-3',
        'description' => esc_html__('Add front widgets here.', 'flexieduca'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'flexieduca_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function flexieduca_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('flexieduca-fonts', flexieduca_fonts_url());


    wp_enqueue_style('flexieduca-style', get_stylesheet_uri());
    
    wp_enqueue_script('flexieduca-fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/js/all.js');

    wp_enqueue_script('flexieduca-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20161215', true);
    
    wp_enqueue_script('flexieduca-actions', get_template_directory_uri() . '/js/actions.js', array('jquery'), '20171215', true);
        
    if ( is_singular('caso') ) {
	    wp_enqueue_script('flexieduca-photoviewer', get_template_directory_uri() . '/js/photo-viewer.js', array('jquery'), '20161215', true);
    }
    
    
    wp_localize_script('flexieduca-navigation', 'flexieducaScreenReaderText', array(
        'expand' => __('Expand child menu', 'flexieduca'),
        'collapse' => __('Collapse child menu', 'flexieduca'),
    ));

    wp_enqueue_script('flexieduca-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    
    wp_register_script('flexieduca-fitvids', get_template_directory_uri() . '/js/fitvids.js', array('jquery'),'', true);
    wp_register_script('flexieduca-my-fitvids', get_template_directory_uri() . '/js/my-fitvids.js', array('flexieduca-fitvids'),'', true);

    if(! is_admin() ) {    
        wp_enqueue_script('flexieduca-fitvids');
        wp_enqueue_script('flexieduca-my-fitvids');
    }

}

add_action('wp_enqueue_scripts', 'flexieduca_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Custom posts types.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}