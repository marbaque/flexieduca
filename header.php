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
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" type="button"><i class="fa fa-bars fa-2x" aria-hidden="true"></i> <span><?php esc_html_e('Contents', 'flexieduca'); ?></span></button>
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
                    
                    <form action="<?php echo site_url(); ?>">
                        <button tabindex="0" role="button"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/h-icon.svg"><span><?php esc_html_e('Hello', 'flexieduca'); ?></span></button>
                    </form>
                    
                    <?php } else { ?>
						
						<button tabindex="0" role="button"><i class="fa fa-user-circle fa-2x"></i><span><?php esc_html_e('Login', 'flexieduca'); ?></span></button> 
                        
                    <?php } ?>
                         
                    
                </div>


            </header><!-- #masthead -->
            
            <div id="user-options">
				<div class="login-block">
					<p><?php echo esc_html('If you already have an account:', 'flexieduca') ?></p>
					<a class="button-login" href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login"><?php esc_html_e('Login', 'flexieduca'); ?></a>
				</div>
				<hr>
				<div class="register-block">
					<p><?php echo esc_html('If you haven not created an account yet:', 'flexieduca') ?></p>
					<a class="button-register" href="<?php echo wp_registration_url(); ?>"><?php esc_html_e('Register', 'flexieduca'); ?></a>
				</div>
				
		    </div>
			
            <div id="content" class="site-content">
