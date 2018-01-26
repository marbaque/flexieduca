<?php
/* 
** Template Name: Case Gallery
*/
get_header();
?>
<?php
	// get the current taxonomy term
	$term = get_queried_object();
	$queried_object = get_queried_object(); 
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;  
	
	$GLOBALS['wp_embed']->post_ID = $taxonomy . '_' . $term_id;

	// vars
	$trend = get_field('trend-desc', $term);
	?>
	
<div id="primary" class="content-area">
	<a href="/mercadeo/casos-estrategias-comercio-movil/" title="<?php echo __( 'Back to gallery', 'flexieduca' ); ?>" class="back"><?php echo __( 'Back to gallery', 'flexieduca' ); ?></a>
	<header class="entry-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    
    <div class="case-index__wrap">
	    <main id="main" class="site-main" role="main">
	
	        <?php
	        while (have_posts()) : the_post();
	
				echo $trend;
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flexieduca' ),
					'after'  => '</div>',
				) );
	
	        endwhile; // End of the loop.
	        ?>
	    </main><!-- #main -->
		
		<section class="case-gallery">
		    
		    <h2 class="gallery-title">
			    <?php echo esc_html__( 'Case list', 'flexieduca' ); ?>
		    </h2>
		    <?php
		    $args = array(
		        'post_type' => 'caso',
		        'posts_per_page' => -1,
		        'order' => 'ASC',
		    );
		
		    $casos = new WP_Query($args);
		
			
		    while ($casos->have_posts()) : $casos->the_post();
		        ?>
		        
		       <?php get_template_part('template-parts/content', 'case-item'); ?>
		
		        <?php endwhile; ?>
		    
		        
		
		
		</section><!-- .case-gallery -->
	    
	    
    </div> <!-- .case-index__wrap -->

</div><!-- #primary -->

<?php
get_footer();

