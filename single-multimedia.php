<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<?php 
			if(function_exists('bcn_display')) {
				echo '<div class="breadcrumbs">';
				bcn_display();
				echo '</div>';
			}
			?>
        <?php
        while (have_posts()) : the_post();

            get_template_part('template-parts/content', 'multimedia');


        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>