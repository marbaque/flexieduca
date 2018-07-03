<?php
/*
 * * Template Name: Exitometro
 * * Template Post Type: page
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'exitometro' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<aside class="menu-social">
		<div class="aside-in">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div>
	</aside><!-- .side-content -->
	
<?php
//get_sidebar('page');
get_footer();
