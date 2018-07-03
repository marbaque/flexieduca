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

<div id="primary" class="content-area">
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
					 
					<header class="entry-header">
					<h1>Módulo <?php echo $numero; ?></h1>
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
					<?php if($subtitulo){ ?>
						<h3><i><?php echo $subtitulo; ?></i></h3>
					<?php
					} ?>
				    </header><!-- .entry-header -->
				    
				    <ul>
					    <?php 
						if ($lectura) {
							echo '<li><a href="' . $lectura . '">Lectura</a></li>';   
					    }
					    if ($audios) {
							echo '<li><a href="' . $audios . '">Audio</a></li>';     
					    }
						if ($videos) {
							echo '<li><a href="' . $videos . '">Video</a></li>';  
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