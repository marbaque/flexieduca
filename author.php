<?php
get_header(); ?>

<?php 
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
 ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			
			<div class="author-profile-card">
			    <h2><?php echo __('Acerca de:', 'flexieduca') . " " . $curauth->user_firstname . " " . $curauth->user_lastname . " \"<i>" . $curauth->nickname . "</i>\""; ?></h2>
			    <div class="author-photo">
			    <?php echo get_avatar( $curauth->user_email , '90 '); ?>
			    </div>
			    <p><strong><?php echo __('Sitio web:', 'flexieduca') . " "; ?></strong><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br />
			    <strong><?php echo __('Bio:', 'flexieduca') . " "; ?></strong><?php echo $curauth->user_description; ?>
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
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar('page');
get_footer();
