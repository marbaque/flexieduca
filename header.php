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
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars fa-2x" aria-hidden="true"></i> <span><?php esc_html_e('Contents', 'flexieduca'); ?></span></button>
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

                <div class="user-info-area">
                    <?php if ( is_user_logged_in() ) { ?>
					    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="user-button"><i class="far fa-user-circle fa-2x"></i><span><?php esc_html_e('Usuario', 'flexieduca'); ?></span></a>
					<?php } else { ?>
					    <a href="<?php echo wp_login_url( home_url() ); ?>" class="user-button" title="Members Area Login" rel="home"><i class="far fa-user-circle fa-2x"></i><span><?php esc_html_e('Login', 'flexieduca'); ?></span></a>
					<?php } ?>
                </div>


            </header><!-- #masthead -->

            <div id="content" class="site-content">
