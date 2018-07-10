<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Super_PEM
 */
get_header();
?>
<?php $class = get_field('class'); ?>

<div id="primary" class="content-area <?php echo $class; ?>" style="background-color:<?php the_field('color_modulo'); ?>">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) : the_post();
		?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php 
					$numero = get_field('numero_modulo');	
					$subtitulo = get_field('subtitulo_modulo');	
					$color = get_field('color_modulo');
					$lectura = get_field('pagina_lectura');
					$audios = get_field('pagina_audios');
					$videos = get_field('pagina_videos');
					 ?>
				<a class="home-link" href="<?php echo esc_url(home_url('/')); ?>">Ir al inicio</a>
					<header class="entry-header m<?php echo $numero; ?>">
					<h4><?php echo esc_html__('Módulo ', 'flexieduca') . $numero; ?></h4>
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
					<?php if($subtitulo){ ?>
						<h2><i><?php echo $subtitulo; ?></i></h2>
					<?php
					} ?>
				    </header><!-- .entry-header -->
				    
					<ul class="links-modulo">
					    <?php 
						if ($lectura) {
							echo '<li><a class="lectura" href="' . $lectura . '" title="' . esc_html__('Lectura', 'flexieduca') . '">' . esc_html__('Lectura', 'flexieduca') . '</a></li>';   
					    }
					    if ($audios) {
							echo '<li><a class="audios" href="' . $audios . '" title="' . esc_html__('Audio', 'flexieduca') . '">' . esc_html__('Audio', 'flexieduca') . '</a></li>';     
					    }
						if ($videos) {
							echo '<li><a class="videos" href="' . $videos . '" title="' . esc_html__('Video', 'flexieduca') . '">' . esc_html__('Video', 'flexieduca') . '</a></li>';  
					    } 
					    ?>					    
				    </ul>
		            
		            
		            
				<?php
		        endwhile; // End of the loop.
		        ?>
			</article>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>