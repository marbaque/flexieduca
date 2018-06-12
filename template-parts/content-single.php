<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php flexieduca_the_category_list(); ?>
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="entry-meta">
			<?php flexieduca_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<?php
		endif; ?>

	</header><!-- .entry-header -->

	<div class="post__wrap">
		
		<?php
		if ( !is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="entry-meta">
			<?php flexieduca_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<?php
		endif; ?>

		
		<div class="entry-content">
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Abrir<span class="screen-reader-text"> "%s"</span>', 'flexieduca' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'flexieduca' ),
					'after'  => '</div>',
				) );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;


				flexieduca_post_navigation();
			?>
			
			
		</div><!-- .entry-content -->
		
		
		<?php get_sidebar(); ?>
	
	</div>
	
	
</article><!-- #post-<?php the_ID(); ?> -->