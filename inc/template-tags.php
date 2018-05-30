<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package flexieduca
 */
/**
 * Post navigation (previous / next post) for single posts.
 */
if (!function_exists('flexieduca_posted_on')) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function flexieduca_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x('%s', 'post date', 'flexieduca'), '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
				/* translators: %s: post author. */
				esc_html_x('Published by %s', 'post author', 'flexieduca'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline">' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		if (!post_password_required() && ( comments_open() || get_comments_number() )) {
			echo ' <span class="comments-link"><span class="extra">Discussion </span>';
			/* translators: %s: post title */
			comments_popup_link(sprintf(wp_kses(__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'flexieduca'), array('span' => array('class' => array()))), get_the_title()));
			echo '</span>';
		}

		edit_post_link(
				sprintf(
						/* translators: %s: Name of current post */
						esc_html__('Edit %s', 'flexieduca'), the_title('<span class="screen-reader-text">"', '"</span>', false)
				), ' <span class="edit-link"><span class="extra">Admin </span>', '</span>'
		);
	}

endif;

if (!function_exists('flexieduca_entry_footer')) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function flexieduca_entry_footer() {
		// Hide tag text for pages.
		if ('post' === get_post_type()) {


			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'flexieduca'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'flexieduca') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}

		if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
			echo '<span class="comments-link">';
			comments_popup_link(
					sprintf(
							wp_kses(
									/* translators: %s: post title */
									__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'flexieduca'), array(
				'span' => array(
					'class' => array(),
				),
									)
							), get_the_title()
					)
			);
			echo '</span>';
		}

		edit_post_link(
				sprintf(
						wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Edit <span class="screen-reader-text">%s</span>', 'flexieduca'), array(
			'span' => array(
				'class' => array(),
			),
								)
						), get_the_title()
				), '<span class="edit-link">', '</span>'
		);
	}

endif;

/*
 * 
 * Display category list
 * 
 */
/* translators: used between list items, there is a space after the comma */

function flexieduca_the_category_list() {
	$categories_list = get_the_category_list(esc_html__(', ', 'flexieduca'));
	if ($categories_list) {
		/* translators: 1: list of categories. */
		printf('<span class="cat-links">' . esc_html__('%1$s', 'flexieduca') . '</span>', $categories_list); // WPCS: XSS OK.
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function flexieduca_categorized_blog() {
	if (false === ( $all_the_cool_cats = get_transient('flexieduca_categories') )) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields'	 => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'	 => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('flexieduca_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so flexieduca_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so flexieduca_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in flexieduca_categorized_blog.
 */
function flexieduca_category_transient_flusher() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('flexieduca_categories');
}

add_action('edit_category', 'flexieduca_category_transient_flusher');
add_action('save_post', 'flexieduca_category_transient_flusher');

function flexieduca_post_navigation() {

	the_post_navigation(array(
		'prev_text'	 => '<span class="screen-reader-text">' . __('Previous', 'flexieduca') . '</span> ' .
		'<span class="arrow">&#8672;</span><span class="post-title">%title</span>',
		'next_text'	 => '<span class="screen-reader-text">' . __('Next', 'flexieduca') . '</span> ' .
		'<span class="arrow">&#8674;</span><span class="post-title">%title </span>',
	));
}

// filter to show caption, if available, on thumbnail, wrapped with '.wp-caption thumb-caption' div;
// show just the thumbnail otherwise

add_filter('post_thumbnail_html', 'custom_add_post_thumbnail_caption', 10, 5);

function custom_add_post_thumbnail_caption($html, $post_id, $post_thumbnail_id, $size, $attr) {

	if ($html == '') {

		return $html;
	} else {

		$out = '';

		$thumbnail_image = get_posts(array('p' => $post_thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image && isset($thumbnail_image[0])) {

			$image = wp_get_attachment_image_src($post_thumbnail_id, $size);

			if ($thumbnail_image[0]->post_excerpt)
				$out .= '<div class="wp-caption thumb-caption">';

			$out .= $html;

			if ($thumbnail_image[0]->post_excerpt)
				$out .= '<p class="wp-caption-text thumb-caption-text">' . $thumbnail_image[0]->post_excerpt . '</p></div>';
		}

		return $out;
	}
}

/*
 * * Customize ellipsis at the end of the excerpts
 */

function flexieduca_excerpts_more($more) {
	return "&hellip;";
}

add_filter('excerpt_more', 'flexieduca_excerpts_more');

/*
 * Filter excerpt length to 100 words
 */

function flexieduca_excerpt_length($length) {
	return 30;
}

add_filter('excerpt_length', 'flexieduca_excerpt_length');




/* * ********************************************************************* */
// Dar a actividades el mismo template de multimedia
/* * ********************************************************************* */
add_filter('template_include', function( $template ) {
	if (is_singular('actividad') && !is_single('caso-nuevo')) {
		$locate = locate_template('single-multimedia.php', false, false);
		if (!empty($locate)) {
			$template = $locate;
		}
	}
	return $template;
});

/* * ********************************************************************* */

// orden de posts
/* * ********************************************************************* */
function my_previous_post_where() {
	global $post, $wpdb;
	return $wpdb->prepare("WHERE p.menu_order < %s AND p.post_type = %s AND p.post_status = 'publish'", $post->menu_order, $post->post_type);
}

add_filter('get_previous_post_where', 'my_previous_post_where');

function my_next_post_where() {
	global $post, $wpdb;
	return $wpdb->prepare("WHERE p.menu_order > %s AND p.post_type = %s AND p.post_status = 'publish'", $post->menu_order, $post->post_type);
}

add_filter('get_next_post_where', 'my_next_post_where');

function my_previous_post_sort() {
	return "ORDER BY p.menu_order desc LIMIT 1";
}

add_filter('get_previous_post_sort', 'my_previous_post_sort');

function my_next_post_sort() {
	return "ORDER BY p.menu_order asc LIMIT 1";
}

add_filter('get_next_post_sort', 'my_next_post_sort');
