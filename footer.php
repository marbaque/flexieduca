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
            'menu_id' => 'footer-menu',
            'walker' => '',
        ));
        ?>
		
		
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'flexieduca' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'flexieduca' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'flexieduca' ), 'flexieduca', '<a href="http://multimedia.uned.ac.cr">Multimedia UNED</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
	<div id="user-options">
		<div class="login-block">
			<p><?php echo esc_html_e('If you already have an account:', 'flexieduca'); ?></p>
			<a class="button-login" href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login"><?php esc_html_e('Login', 'flexieduca'); ?></a>
		</div>
		<hr>
		<div class="register-block">
			<p><?php echo esc_html_e('If you haven not created an account yet:', 'flexieduca'); ?></p>
			<a class="button-register" href="<?php echo wp_registration_url(); ?>"><?php esc_html_e('Register', 'flexieduca'); ?></a>
		</div>
		
	</div><!-- #user-options -->
	
</div><!-- #page -->

<?php wp_footer(); ?>



</body>
</html>
