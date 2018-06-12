<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No se encontró nada', 'flexieduca' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p class="bubble"><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( '¿Listo(a) para publicar su primara entrada? <a href="%1$s">Empiece aquí</a>.', 'flexieduca' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php elseif ( is_search() ) : ?>

			
			<?php get_search_form(); ?>			
			<p class="bubble"><?php esc_html_e( 'Lo sentimos, no hay nada con ese t&eacute;rmino. Por favor, utilice otras palabras clave.', 'flexieduca' ); ?></p>
			<?php else : ?>
			
			<?php get_search_form(); ?>
			<p class="bubble"><?php esc_html_e( 'Parece que no podemos encontrar ese contenido. Quiz&aacute;s una búsqueda sea de ayuda.', 'flexieduca' ); ?></p>
			<?php endif; ?>
		
		<img aria-hidden="true" src="<?php echo get_stylesheet_directory_uri(); ?>/img/rana404.svg" class="rana404" />

	</div><!-- .page-content -->
</section><!-- .no-results -->
