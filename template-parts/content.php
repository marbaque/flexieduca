<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Flexieduca
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post__content">
		<p class="post_post-type">
			<?php 
			$postType = get_post_type_object(get_post_type());
			if ($postType) {
			    echo esc_html($postType->labels->name);
			}
			?>
			</p>
		<header class="entry-header">
			
			
			<?php
				
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php flexieduca_posted_on(); ?>
			</div><!-- .entry-meta -->
			
			<?php
			endif;

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
	
		</header><!-- .entry-header -->
	
		<div class="excerpt"><?php the_excerpt(); ?></div>
	                
        <div class="continue-reading">
            <?php
            $read_more_link = sprintf(
                /* translators: %s: Name of current post. */
                wp_kses(__('Abrir %s', 'flexieduca'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
            );
            ?>

            <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                <?php echo $read_more_link; ?>
            </a>
        </div><!-- .continue-reading -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
