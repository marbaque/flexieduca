<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flexieduca
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">

    <?php
    wp_nav_menu(array(
	'theme_location' => 'menu-3',
	'menu_id'	 => 'footer-menu',
	'walker'	 => '',
    ));
    ?>


    <div class="site-info">
	<a href="<?php echo esc_url(__('https://wordpress.org/', 'flexieduca')); ?>"><?php
    /* translators: %s: CMS name, i.e. WordPress. */
    printf(esc_html__('Hecho con %s', 'flexieduca'), 'WordPress');
    ?></a>
	<span class="sep"> | </span>
	<?php
	/* translators: 1: Theme name, 2: Theme author. */
	printf(esc_html__('Plantilla: %1$s por %2$s.', 'flexieduca'), 'Flexieduca', '<a href="http://multimedia.uned.ac.cr">Multimedia UNED</a>');
	?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
<?php if ( !is_user_logged_in() ): ?>
    <div id="user-options">
	<div class="login-block">
	    <p><?php echo esc_html_e('Si ya tiene una cuenta:', 'flexieduca'); ?></p>
	    <a class="button-login" href="<?php echo wp_login_url(get_permalink()); ?>" title="Login"><?php esc_html_e('Acceda aquí', 'flexieduca'); ?></a>
	</div>
	<hr>
	<div class="register-block">
	    <p><?php echo esc_html_e('Si es primera vez:', 'flexieduca'); ?></p>
	    <a class="button-register" href="<?php echo wp_registration_url(); ?>"><?php esc_html_e('Regístrese aquí', 'flexieduca'); ?></a>
	</div>

    </div><!-- #user-options -->
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>



</body>
</html>
