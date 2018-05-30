<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexieduca
 */
?>
<?php get_template_part('template-parts/tools'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (function_exists('bcn_display')) {
	echo '<div class="breadcrumbs">';
	bcn_display();
	echo '</div>';
    }
    ?>
    <header class="entry-header">
	<?php
	the_title('<h1 class="entry-title">', '</h1>');
	?>

    </header><!-- .entry-header -->

    <div class="entry-content case-content">

	<div class="case__wrap">

    	    <div class="gallery">

		    <?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
		    } ?>
		
		<?php $url = get_field('enlace'); ?>    
		<div class="enlace">
			<?php if (!empty($url)): ?>
			    <a href="<?php echo $url; ?>" title="Enlace a <?php the_title(); ?>" target="_blank">
				<?php echo preg_replace('#^https?://#', '', $url); ?></i></a>
			    <?php endif; ?>
		</div>
		<div class="case-trends">
			<?php 

			$posts = get_field('galeria_relacionada');
			
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			
    	</div>

		
    	    </div><!-- .case-gallery --> 
	    
	    <div class="case-desc">
		
		

		<?php get_template_part('template-parts/auxiliar'); ?>

		<?php
		the_content();
		
		
		/*
		*  Query posts for a relationship value.
		*  This method uses the meta_query LIKE to match the string "123" to the 
		*  database value a:1:{i:0;s:3:"123";} (serialized array)
		*/

		$contenidos = get_posts(array(
			'post_type' => 'actividad',
			'meta_query' => array(
			    array(
				'key' => 'contenido_relacionado', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			    )
			)
		));

		?>
		<?php if( $contenidos ): ?>
		<div class="formato-ejercicio">
		    <h2>Actividades de autoevaluación</h2>
		    <ul>
			<?php foreach( $contenidos as $contenido ): ?>
			<li>
			    <a href="<?php echo get_permalink( $contenido->ID ); ?>">
				<?php echo get_the_title( $contenido->ID ); ?>
			    </a>
			</li>
			<?php endforeach; ?>
		    </ul>
		</div>	
		<?php endif; ?>
		
	    </div>

        </div><!-- case__wrap -->
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) :
	    comments_template();
	endif;
	?>

    </div><!-- .entry-content .case-content -->

</div>




</article><!-- #post-## -->

<div class="ebook-nav">
    <?php flexieduca_post_navigation(); ?>
</div>
