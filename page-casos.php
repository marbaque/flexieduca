<?php
/* 
** Template Name: Case Gallery
*/
get_header();
?>

<?php get_template_part('template-parts/tools'); ?>

<div id="primary" class="content-area">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    
    <div class="case-index__wrap">
	    <main id="main" class="site-main" role="main">
			
	        <?php
	        while (have_posts()) : the_post();
	        
	        if ( has_post_thumbnail() ) { ?>
	            <figure class="featured-image full-bleed">
	                <?php
	                    the_post_thumbnail('flexieduca-full-bleed');
	                ?>
	            </figure>
	        <?php }
				the_content();
	
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
