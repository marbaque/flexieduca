<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexieduca
 */
get_header();
?>

<?php if (has_post_thumbnail()) { ?>
    <figure class="featured-image full-bleed">
        <?php
        the_post_thumbnail('flexieduca-full-bleed');
        ?>
    </figure><!-- .featured-image full-bleed -->
<?php } ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()) : the_post();

            get_template_part('template-parts/content', 'front');

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
