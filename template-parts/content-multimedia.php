<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexieduca
 */
?>
<?php get_template_part('template-parts/tools'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part('template-parts/back2modulo'); ?>

    <header class="entry-header">
	<?php
	if (is_singular()) :
	    the_title('<h1 class="entry-title">', '</h1>');
	else :
	    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	endif;
	?>

    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ): ?>
        <figure class="featured-image full-bleed">
	    <?php
	    the_post_thumbnail('flexieduca-index-img');
	    ?>
        </figure>
    <?php endif; ?>

    <div class="post-content">
        <div class="post-content__wrap">

	    <?php get_template_part('template-parts/auxiliar'); ?>

            <div class="post-content__body">
                <div class="entry-content">
			    <?php
			    the_content(sprintf(
					    wp_kses(
						    /* translators: %s: Name of current post. Only visible to screen readers */
						    __('Continuar leyendo<span class="screen-reader-text"> "%s"</span>', 'flexieduca'), array(
								'span' => array(
								    'class' => array(),
								),
						    )
					    ), get_the_title()
			    ));

			    wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Páginas:', 'flexieduca'),
					'after'	 => '</div>',
			    ));

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
				<h3><?php echo __( 'Ejercicios de autoevaluación', 'flexieduca' ); ?></h3>
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

                </div><!-- .entry-content -->

            </div><!--.post_content__body--->
        </div><!--.post_content__wrap--->
				<!-- contenido relacionado -->

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
		    comments_template();
		endif;
		?>

		<?php $posts = get_field('contenido_relacionado'); ?>
		<?php if ( $posts && !is_singular( 'caso' ) ) : ?>
			<div class="relacionado">
				<h6><?php echo __('Continuar leyendo el contenido:', 'flexieduca'); ?></h6>
				<ul>
				<?php foreach ($posts as $post): // variable must be called $post (IMPORTANT)  ?>
				<?php setup_postdata($post); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly  ?>
		<?php endif; ?>




	<div class="ebook-nav">
		<?php flexieduca_post_navigation(); ?>
	</div>


    </div><!--post content-->

</article><!-- #post-<?php the_ID(); ?> -->
