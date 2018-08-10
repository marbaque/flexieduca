<?php
/*
 * * Template Name: Plantilla para categoría 'Estrategias'
 * * Template Post Type: post, multimedia
 */
get_header();
?>

<?php get_template_part('template-parts/tools'); ?>

<div id="primary" class="content-area">
    
	<?php if ( $post->post_parent ): ?>
	<a class="back2modulo" href="<?php echo get_permalink( $post->post_parent ); ?>" >
		   <?php echo get_the_title( $post->post_parent ); ?>
		</a>
	<?php endif; ?>


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
    	
    	
    	<div class="gallery-wrap">
	    	<section class="case-gallery">
	
	    	    <h3 class="gallery-title">
			    <?php echo esc_html__('Casos recionados con', 'flexieduca') . " " . strtoupper(get_the_title()); ?>
	    	    </h3>
		    <?php
			/*
			*  Query posts for a relationship value.
			*  This method uses the meta_query LIKE to match the string "123" to the 
			*  database value a:1:{i:0;s:3:"123";} (serialized array)
			*/
	
			$casos = get_posts(array(
				'posts_per_page' => -1,
				'post_type' => 'caso',
				'meta_query' => array(
					array(
						'key' => 'galeria_relacionada',			// name of custom field
						'value' => '"' . get_the_ID() . '"',	// matches exaclty "123", not just 123. 
																//This prevents a match for "1234"
						'compare' => 'LIKE'
					)
				)
			));
			?>
			
			<?php if( $casos ): ?>
	
				<?php foreach( $casos as $caso ): ?>
				
				<div class="case-item">
	
					<?php if ( has_post_thumbnail( $caso->ID ) ) : ?>
					<?php $url = get_the_post_thumbnail_url($caso->ID, 'flexieduca-case-thumb'); ?>
					<a class="fancyboxPage" href="<?php the_permalink( $caso->ID ); ?>" title="<?php the_title_attribute( $caso->ID ); ?>">
						<img src="<?php echo $url ?>">
					</a>
					<?php endif; ?>	
	
					<div class="item-text">
						<h2><a class="fancyboxPage" href="<?php the_permalink( $caso->ID ); ?>"> <?php echo get_the_title( $caso->ID ); ?></a></h2>
						<div class="excerpt"><?php the_excerpt( $caso->ID ); ?></div>
					</div>
	
					<div class="continue-reading">
					<?php
					$read_more_link = sprintf(
						/* translators: %s: Name of current post. */
						wp_kses(__('Abrir... %s', 'flexieduca'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
					);
					?>
						<a class="fancyboxPage" href="<?php echo esc_url(get_permalink( $caso->ID )) ?>" rel="bookmark">
						<?php echo $read_more_link; ?>
						</a>
					</div><!-- .continue-reading -->
	
				</div><!-- .case-item -->
				<?php endforeach; ?>
			<?php endif; ?>
			
	
	
	
	
	
	    	</section><!-- .case-gallery -->
    	</div><!-- gallery wrap -->
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
