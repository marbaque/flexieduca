<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		flexieduca_the_category_list(); 
		
		if ( is_page() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="post__wrap">

		
		<div class="entry-content">
			<?php
	        if ( has_post_thumbnail() ) { ?>
	            <figure class="featured-image full-bleed">
	                <?php
	                    the_post_thumbnail('flexieduca-full-bleed');
	                ?>
	            </figure>
	        <?php } ?>
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flexieduca' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexieduca' ),
					'after'  => '</div>',
				) );
			?>
			
			
		</div><!-- .entry-content -->
		
		
		<?php get_sidebar('page'); ?>
	
	</div>
	
	
</article><!-- #post-<?php the_ID(); ?> -->
