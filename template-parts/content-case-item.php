<div class="case-item">


    <?php if ( has_post_thumbnail() ) : ?>
	<?php $url = get_the_post_thumbnail_url($post->ID, 'flexieduca-case-thumb'); ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	    <img src="<?php echo $url ?>">
	</a>
    <?php endif; ?>	

    <div class="item-text">
        <h2><a href="<?php the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h2>

        <div class="excerpt"><?php the_excerpt(); ?></div>
    </div>

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

</div><!-- .case-item -->