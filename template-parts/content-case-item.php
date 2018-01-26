 <div class="case-item">
					
    <?php
    //flexieduca_the_category_list();

    //Find the gallery image 1 of the post
    $img1 = get_field('gallery_image_1');
    $sizeThumb = 'flexieduca-case-thumb';
    
    ?>
    
	<?php if ( !empty($img1) ): ?>
	
   	<div class="item-media">
        <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
			<?php echo wp_get_attachment_image($img1, $sizeThumb); ?>

        </a>
    </div>
    <?php endif; ?>	    	

	<div class="item-text">
        <h2><a href="<?php the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h2>
        
        <div class="excerpt"><?php the_excerpt(); ?></div>
    </div>
    
    <div class="continue-reading">
        <?php
        $read_more_link = sprintf(
            /* translators: %s: Name of current post. */
            wp_kses(__('Continue reading %s', 'flexieduca'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
        );
        ?>

        <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
            <?php echo $read_more_link; ?>
        </a>
    </div><!-- .continue-reading -->
	
</div><!-- .case-item -->