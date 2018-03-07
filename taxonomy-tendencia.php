<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */
get_header();
$term				 = get_queried_object();
$queried_object			 = get_queried_object();
$taxonomy			 = $queried_object->taxonomy;
$term_id			 = $queried_object->term_id;
$GLOBALS['wp_embed']->post_ID	 = $taxonomy . '_' . $term_id;

$trendDesc = get_field('trend-desc', $term);

$audioURL = get_field('audio_contenido', $term);
$resumen = get_field('resumen');
?>

<?php get_template_part('template-parts/tools'); ?>

<div id="primary" class="content-area">
<?php if (have_posts()) : ?>
	<?php
	if (function_exists('bcn_display')) {
	    echo '<div class="breadcrumbs">';
	    bcn_display();
	    echo '</div>';
	}
	?>
        <header class="page-header">
	<?php
	the_archive_title('<h1 class="page-title">', '</h1>');
	the_archive_description('<div class="archive-description">', '</div>');
	?>
        </header><!-- .page-header -->
	<?php endif; ?>
    <div class="case-index__wrap">

	<main id="main" class="site-main" role="main">
	
	<?php if ($audioURL || $resumen): ?>
	<ul class="accordion">
	    <?php if ($audioURL): ?>
	    
	    <li class="audio">
		<button class="accordion-control audio-btn"><i class="fas fa-headphones"></i> Audio</button>
		<div class="accordion-panel audio">
		    <audio controls>
			<source src="<?php echo $audioURL; ?>" type="audio/mpeg">
			Your browser does not support the audio element.
		    </audio>
		   <a class="descargar-audio button" href="<?php echo $audioURL; ?>" title="Descargar audio"><i class="fas fa-download"></i> Descargar</a>
		</div>
	    </li>
	    <?php endif; ?>	

	    <?php if ($resumen): ?>
	    <li class="resumen">
		<button class="accordion-control"><i class="far fa-edit"></i> Resumen</button>
		<div id="resumen" class="accordion-panel resumen">
		    <?php echo $resumen; ?>
		</div>
	    </li>
	    
	    <?php endif; ?>
	</ul>
	<?php endif; ?>
	    
	
	 <?php echo $trendDesc; ?>

	</main><!-- #main -->

	<div class="case-gallery">
	    <?php if (have_posts()) : ?>

		<?php
		/* Start the Loop */
		while (have_posts()) : the_post();

		    /*
		     * Include the Post-Format-specific template for the content.
		     * If you want to override this in a child theme, then include a file
		     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		     */
		    get_template_part('template-parts/content', 'case-item');
		    ?>
		    <?php
		endwhile;

		the_posts_pagination(array(
		    'prev_text'		 => __('Newer', 'flexieduca'),
		    'next_text'		 => __('Older', 'flexieduca'),
		    'before_page_number'	 => '<span class="screen-reader-text">' . __('Page', 'flexieduca') . '</span>',
		));

	    else :

		get_template_part('template-parts/content', 'none');
	    	wp_reset_postdata();

	    endif;
	    ?>
	</div>


    </div>
</div><!-- #primary -->
<?php
get_footer();
