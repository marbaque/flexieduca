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
    	
    	<div class="side-content">
    		<?php
    		wp_nav_menu( array(
    			'theme_location' => 'menu-2',
    			'menu_id'        => 'front-menu',
    		) );
    
    	    dynamic_sidebar( 'sidebar-3' );
    	    ?>
    		
    	</div>
	    
    </div>
    
	
	
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</article><!-- #post-## -->
