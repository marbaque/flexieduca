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
	    <div class="portada">
	    <?php if (has_post_thumbnail()) { ?>
	        <figure class="featured-image">
	            <?php
	            the_post_thumbnail('flexieduca-full-bleed');
	            ?>
	        </figure><!-- .featured-image full-bleed -->
	    <?php } ?>
		</div>
        <?php the_title('<h1 class="entry-title screen-reader-text">', '</h1>'); ?>
    </header><!-- .entry-header -->
    
    

    <div class="front-content_wrap">
	    
		<?php
            //the_content();
            ?>
		
		<div class="front-menus">
			<!-- Menús de página principal	 -->    
		    <?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1a',
				'menu_id'        => 'front-menu-a',
			) );
			
			wp_nav_menu( array(
				'theme_location' => 'menu-1b',
				'menu_id'        => 'front-menu-b',
			) );
			?>
		</div>	
	    
	    
	    
    </div>
    	<aside class="menu-social">
			<div class="aside-in">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
    	</aside><!-- .side-content -->
	
	
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</article><!-- #post-## -->
