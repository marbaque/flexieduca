<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */

?>
<?php get_template_part('template-parts/tools'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<div class="exitometro">	                 
			<?php
			if ( is_user_logged_in() ) {
				global $current_user;
				wp_get_current_user();
				/**
				* @example Safe usage: $current_user = wp_get_current_user();
				* if ( !($current_user instanceof WP_User) )
				*     return;
				*/
				?>
				<div class="estudiante">
					<?php echo get_avatar( $current_user->user_email, 64 ); ?>
					<div>
						<h3 class="name"><?php echo __('Hola, ', 'flexieduca'); ?><span><?php echo $current_user->display_name; ?></span></h3>
						<ul class="user-manage">
						    <li><a href="<?php echo esc_url( home_url( '/wp-admin/profile.php' ) ); ?>"><?php echo __('Editar perfil', 'flexieduca'); ?></a></li>
						    <li><a href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>"><?php echo __('Cerrar sesión', 'flexieduca'); ?></a></li>
					    </ul>
					</div>
					
				    
				</div>	
				
				<div class="datos">
		                <i><?php echo esc_html__('Progreso ', 'flexieduca') . do_shortcode('[wpc_progress_in_ratio course=all]'); ?></i>
		            <div class="graph"><?php echo do_shortcode('[wpc_progress_graph course=all]'); ?></div>
		        </div><!-- .datos -->
			<?php
			
			} else {
				
				?>
			    <h3><?php echo __('¡Hola!', 'flexieduca'); ?></h3>
			    
			    <p>
				    <a id="user" href="<?php echo wp_login_url(get_permalink()); ?>"><?php echo __('Acceda al multimedia', 'flexieduca'); ?></a> <?php echo __('para guardar su progreso', 'flexieduca'); ?>
				    				    
			    </p>
			    <?php 
			    
			}
			?>
	    </div><!-- exitometro -->
	</header><!-- .entry-header -->
	
	

		
	<div class="entry-content progreso">
		<?php
        if ( has_post_thumbnail() ) { ?>
            <figure class="featured-image full-bleed">
                <?php
                    the_post_thumbnail('flexieduca-full-bleed');
                ?>
            </figure>
        <?php } ?>
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Abrir<span class="screen-reader-text"> "%s"</span>', 'flexieduca' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'flexieduca' ),
				'after'  => '</div>',
			) );
		?>
		
		
	</div><!-- .entry-content -->
		
	
	
</article><!-- #post-<?php the_ID(); ?> -->
