<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexieduca
 */
?>
<?php get_template_part('template-parts/tools'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="entry-header">
        <?php flexieduca_the_category_list(); ?>
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        
        
        ?>
            
    </header><!-- .entry-header -->
    
    <?php
        if ( has_post_thumbnail() ) { ?>
            <figure class="featured-image full-bleed">
                <?php
                    the_post_thumbnail('flexieduca-index-img');
                ?>
            </figure>
        <?php } ?>

    <div class="post-content">
        <div class="post-content__wrap">
            
            <?php get_template_part('template-parts/auxiliar'); ?>
            
            <div class="post-content__body">

                <div class="entry-content">
                    <?php
                    the_content(sprintf(
                            wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'flexieduca'), array(
                        'span' => array(
                            'class' => array(),
                        ),
                                            )
                                    ), get_the_title()
                    ));

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'flexieduca'),
                        'after' => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php flexieduca_entry_footer(); ?>
                </footer><!-- .entry-footer -->

            </div><!----.post_content__body--->
        </div><!----.post_content__wrap--->
        
        <?php
        

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
        <?php if ( ! is_singular('actividad') ) { ?>
        <div class="ebook-nav">
            <?php flexieduca_post_navigation(); ?>
        </div>
        <?php } ?>
        

    </div><!--post content-->


</article><!-- #post-<?php the_ID(); ?> -->

