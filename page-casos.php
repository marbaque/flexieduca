<?php
/*
 * * Template Name: Galería de casos
 * Template Post Type: post, multimedia
 */
get_header();
?>

<?php get_template_part('template-parts/tools'); ?>

<div id="primary" class="content-area">
    <?php
    if (function_exists('bcn_display')) {
	echo '<div class="breadcrumbs">';
	bcn_display();
	echo '</div>';
    }
    ?>


    <div class="case-index__wrap">
        <main id="main" class="site-main" role="main">
	    <header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	    </header><!-- .entry-header -->
	    <?php
	    while (have_posts()) : the_post();

		if ( has_post_thumbnail() ) {
		    ?>
		    <figure class="featured-image full-bleed">
			<?php
			the_post_thumbnail('flexieduca-full-bleed');
			?>
		    </figure>
		    <?php
		}
		
		get_template_part('template-parts/auxiliar');

		the_content();

		wp_link_pages(array(
		    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'flexieduca'),
		    'after'	 => '</div>',
		));
		?>
    	</main><!-- #main -->
    	<section class="case-gallery">

    	    <h2 class="gallery-title screen-reader-text">
		    <?php echo esc_html__('Casos destacados', 'flexieduca'); ?>
    	    </h2>
	    <?php

	    global $post;
	    $args = array( 
		'posts_per_page' => -1, 
		'post_type' => 'caso'
	    );

	    $myposts = get_posts( $args );
	    foreach ( $myposts as $post ) : 
		setup_postdata( $post ); ?>
		<?php get_template_part('template-parts/content', 'case-item'); ?>
	    <?php endforeach; 
	    wp_reset_postdata();?>




    	</section><!-- .case-gallery -->

	    <?php
	    wp_reset_postdata();
	endwhile; // End of the loop.
	?>



    </div> <!-- .case-index__wrap -->

</div><!-- #primary -->
<?php
// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>

<div class="ebook-nav">
<?php flexieduca_post_navigation(); ?>
</div>

<?php
get_footer();