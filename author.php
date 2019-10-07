<?php
get_header(); ?>

<?php 
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$curruser = wp_get_current_user();

 ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<a class="back2modulo" href="javascript:history.back()">Regresar</a>
			
			<div class="author-profile-card">
			    <h2><?php echo $curauth->user_firstname . " " . $curauth->user_lastname . " \"<i>" . $curauth->nickname . "</i>\""; ?></h2>
			    <div class="author-header">
					<div class="author-photo">
						<?php echo get_avatar( $curauth->user_email , '90 '); ?>
						
						<?php if ( is_user_logged_in() && $curauth == $curruser ): ?>

							<a class="small" href="<?php echo get_edit_user_link(); ?>">Editar perfil</a>
						<?php endif; ?>
					
					</div><!-- .author-photo -->
					<div class="datos card">
						<i><?php echo esc_html__('Progreso ', 'flexieduca') . do_shortcode('[wpc_progress_in_ratio course=all]'); ?></i>
						<div class="graph"><?php echo do_shortcode('[wpc_progress_graph course=all]'); ?></div>
					</div><!-- .datos -->
				</div><!-- .author-header -->
				<h3 class="hidden">Redes sociales</h3>
				<p class="author-info card">
					<strong><?php echo __('Sitio web:', 'flexieduca') . " "; ?></strong><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br>
					
					<?php 
					$userID = $curauth->ID;
					$face = get_field('facebook', 'user_' . $userID );
					$twitter = get_field('twitter', 'user_' . $userID);
					$instagram = get_field('instagram', 'user_' . $userID);
					?>

					<strong>Facebook: </strong>
					
					<?php if( $face ): ?>
					
						<a href="https://www.facebook.com/<?php echo $face; ?>" target="_blank"><?php echo $face; ?></a>				
						
					<?php endif; ?>

					<br>
					<strong>Twittter: </strong>

					<?php if( $twitter ): ?>
					
						<a href="https://www.twitter.com/<?php echo $twitter; ?>" target="_blank"><?php echo $twitter; ?></a>
						
					<?php endif; ?>

					<br>
					<strong>Instagram: </strong>

					<?php if( $instagram ): ?>
										
					<a href="https://www.instagram.com/<?php echo $instagram; ?>" target="_blank"><?php echo $instagram; ?></a>

					<?php endif; ?>
					</p>
				
				<p class="author-info card"><strong><?php echo __('Bio:', 'flexieduca'); ?></strong><?php echo ' ' . $curauth->user_description; ?></p>
				
			</div>

			<?php
			if ( have_posts() ) :
	
				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
	
				<?php
				endif;
	
				/* Start the Loop */
				while ( have_posts() ) : the_post();
	
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
	
				endwhile;
	
				the_posts_pagination( array(
					'prev_text' => __( 'Más reciente', 'flexieduca' ),
					'next_text' => __( 'Más antiguo', 'flexieduca' ),
					'before_page_number' => '<span class="screen-reader-text">' . __( 'Página', 'flexieduca' ) . '</span>',
				) );
	
			else :
	
				//get_template_part( 'template-parts/content', 'none' );
	
			endif; ?>

			<hr>
			<h3><?php echo __('Actividad:', 'flexieduca') ?></h3>
			<div class="mis-comentarios">
				
			<?php

			// get author info
			$args = array(
				'user_id' => $curauth->ID, // use user_id
				'status' => 'approve',
				'post_status' => 'publish',
			);

			// The Query
			$comments_query = new WP_Comment_Query;
			$comments = $comments_query->query( $args );

			// Comment Loop
			if ( $comments ) {
				foreach ( $comments as $comment ) {
					echo '<div class="card">';
					echo '<p class="comentario">"' . substr($comment->comment_content, 0, 200) . '..."';
					echo '<div class="comentario-title small">' . __('Discusión en:', 'flexieduca') . '<a href="' . get_comment_link( $comment, $args ) . '">' . ' ' . get_the_title($comment->comment_post_ID) .  '</a>' . '</div>';
					echo '</p>';
					echo '</div>';
					
				}
			} else {
				echo 'Aún no tiene discuciones.';
			}


			?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar('page');
get_footer();
