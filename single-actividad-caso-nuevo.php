<?php
acf_form_head();

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

	<?php
	while (have_posts()) : the_post();
	    get_template_part('template-parts/content-multimedia');

	    acf_form(array(
		'post_id'	=> 'new_post',
		'post_title'	=> true,
		'post_content'	=> true,
	    ));
	    
	endwhile; // End of the loop.
	?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
