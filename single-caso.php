<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Humescores
 */
//get_header();
wp_head();
?>
<div class="single-caso">
	<div id="primary" class="content-area">
	    <main id="main" class="site-main" role="main">
			
	        <?php
	        while (have_posts()) : the_post();
	
	            get_template_part('template-parts/content', 'case');
	
	        endwhile; // End of the loop.
	        ?>
	
	    </main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
wp_footer();
//get_footer();
