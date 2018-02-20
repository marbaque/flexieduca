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
					    echo '<h4>' . __("Welcome, ", "flexieduca") . $current_user->display_name . '</h4>';
					} else {
					    echo __('Welcome, visitor!', 'flexieduca');
					}
					?>
                <div class="datos">
                    <p>
                        <span class="mi-exitometro">Mi Exitómetro</span> <br>
                        <i><span>2/28 actividades completadas</span></i>
                    </p>
                    <span class="porcentaje">10%</span>
                </div>
            </div>
    		<?php
    		wp_nav_menu( array(
    			'theme_location' => 'menu-2',
    			'menu_id'        => 'front-menu',
    		) );
    
    	    dynamic_sidebar( 'sidebar-3' );
    	    ?>
    		
    	</aside>
	    
    </div>
    
	
	
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</article><!-- #post-## -->
