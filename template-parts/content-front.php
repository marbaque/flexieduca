<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexieduca
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->
    
    

    <div class="front-content_wrap">
	    
	    <div class="entry-content post-content">
		    <?php if (has_post_thumbnail()) { ?>
		        <figure class="featured-image full-bleed">
		            <?php
		            the_post_thumbnail('flexieduca-index-img');
		            ?>
		        </figure><!-- .featured-image full-bleed -->
		    <?php } ?>
            <?php
            the_content();
    
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'flexieduca'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content .post-content -->
    	
    	<aside class="side-content">
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
				echo get_avatar( $current_user->user_email, 64 );
			    echo '<h4>' . __('Welcome, ', 'flexieduca') . $current_user->display_name . '</h4>'; ?>
		
				<div class="datos">
                    <div>
	                    <h5 class="mi-exitometro"> <?php echo esc_html__('Success \'o meter', 'flexieduca'); ?></h5>
	                    <p>
	                        <?php echo esc_html__('Progress ', 'flexieduca') . do_shortcode('[wpc_progress_in_ratio course=all]'); ?>
	                    </p>
					</div>
                    <span><?php echo do_shortcode('[wpc_progress_graph course=all]'); ?></span>
                </div><!-- .datos -->
			<?php
			
			} else {
			    echo __('Welcome!', 'flexieduca');
			    echo '<p><a id="user" href="' . wp_login_url(get_permalink()) . '">';
			    echo 'Acceda</a> al multimedia para guardar su progreso.</p>';
			}
			?>
            </div><!-- exitometro -->

	    
	    <?php
    		wp_nav_menu( array(
    			'theme_location' => 'menu-2',
    			'menu_id'        => 'front-menu',
    		) );
			?>
			
	    
			
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
    		
    		
    	</aside><!-- .side-content -->
	    
    </div>
    
	
	
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</article><!-- #post-## -->
