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
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Adds a class telling us if the sidebar is in use.
    if (!is_singular('multimedia') && is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    // Adds a class telling us if the sidebar is in use.
    if (is_active_sidebar('sidebar-2')) {
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
