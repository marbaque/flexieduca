<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexieduca
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'flexieduca'); ?></a>

            <header id="masthead" class="site-header">

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" type="button"><span><?php esc_html_e('Contents', 'flexieduca'); ?></span></button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                    ));
                    ?>
                </nav><!-- #site-navigation -->

                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page()) :
                        ?>
                        <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <div <?php if ( !is_user_logged_in() ) {echo 'id="user"';} ?> class="user-info-area">
	                
                    <?php if ( is_user_logged_in() ) { ?>
		    
		    <?php
		    global $current_user;
		    wp_get_current_user();
		    ?>
                    
                    <form action="<?php echo get_dashboard_url(); ?>">
                        <button tabindex="0" role="button"><?php echo get_avatar( $current_user->user_email, 32 ); ?><span><?php echo $current_user->display_name; ?></span></button>
                    </form>
                    
                    <?php } else { ?>
						
						<button tabindex="0" role="button"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/h-icon.svg"><span><?php esc_html_e('Login', 'flexieduca'); ?></span></button> 
                        
                    <?php } ?>
                         
                    
                </div>


            </header><!-- #masthead -->
            
			
            <div id="content" class="site-content">
