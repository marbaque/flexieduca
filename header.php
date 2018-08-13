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
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Omitir e ir al contenido', 'flexieduca'); ?></a>

            <header id="masthead" class="site-header">

                <nav id="site-navigation" class="main-navigation">
                    
					
					<?php if (is_singular( 'multimedia' )): //check if it is multimedia ?>
                    
					
                    <?php
					// submenú de contenidos 
						$current = $post->ID;
						global $post_id;
						$myvals = get_post_meta($post_id);
						
						if (is_array($myvals) || is_object($myvals))
						{
							foreach($myvals as $key=>$val)
							{
								echo $key . ' : ' . $val[0] . '<br/>';
							}
						}
						
						
						$post_object = get_field('modulo_asignado');

						if( $post_object ): 

							// override $post
							$post = $post_object;
							setup_postdata( $post );
							$myID = get_the_ID( $post );
							$parent = get_the_title($post->ID);
							$num = get_field('numero_modulo');
							$color = get_field('color_modulo');
							wp_reset_postdata();
							//echo $myID; //test
							
							?>
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" type="button"><span><?php echo esc_html_e('Módulo ', 'flexieduca') . $num; ?></span></button>
							<?php
							
							
						

							// The Query
							$args = array(
								'post_type' => 'multimedia',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'meta_query' => array(
								array(
									'key' => 'modulo_asignado',
									'value' => $myID,
									'compare' => 'LIKE'
									)
								)
							);
							$the_query = new WP_Query( $args );
							// The Loop
							if ( $the_query->have_posts() ) :
								echo '<div class="menu-menu-principal-container">';
								echo '<ul id="primary-menu" class="menu">';
								echo '<li><a class="home" title="' . __('Ir al inicio', 'flexieduca') .'" href="' . site_url() . '" title="Inicio del curso">' . __('Inicio', 'flexieudca') .'</a></li>';
								echo '<li><a class="modulo-item"  style="background-color:' . $color . ';color:white;" href="' . get_permalink($myID) . '" title="Inicio del curso">' . __('Módulo ', 'flexieduca') . $num . '. ' . $parent . '</a></li>';
								while ( $the_query->have_posts() ) : $the_query->the_post();
									// Do Stuff
									$queried_object = get_the_ID();

									if( $queried_object == $current) {
										echo '<li class="current-item"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a></li>';
									} else {
										echo '<li><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a></li>';
									}

								endwhile;
								echo '</ul>';
								echo '</div>';
								// Reset Post Data
								wp_reset_postdata();
							endif;
							// Reset Post Data
							wp_reset_postdata();
							
						endif; ?>		
					
						<?php elseif( !is_singular('multimedia') && !is_front_page() ): ?>

					<a class="home-button" href="<?php echo home_url(); ?>"><span><?php esc_html_e('Inicio', 'flexieduca'); ?></span></a>
					
							
					<?php endif; ?>
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
                    
                    <a href="<?php echo get_permalink( get_page_by_path( 'exitometro' ) ); ?>" title="<?php esc_html_e('Ir a página de Exitómetro', 'flexieduca'); ?>">
                        <?php echo get_avatar( $current_user->user_email, 32 ); ?><span><?php echo $current_user->display_name; ?></span>
                    </a>
                    
                    <?php } else { ?>
						
						<button tabindex="0" role="button"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/h-icon.svg"><span><?php esc_html_e('Acceder', 'flexieduca'); ?></span></button> 
                        
                    <?php } ?>
                         
                    
                </div>


            </header><!-- #masthead -->
            
			
            <div id="content" class="site-content">
