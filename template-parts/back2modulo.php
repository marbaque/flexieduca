<?php

$post_object = get_field('modulo_asignado');

/*
print_r( $post_object  );
die;
*/

if( $post_object ): 
	// override $post
	$post = $post_object;
	setup_postdata( $post ); 
?>
<div class="back2modulo"><?php echo 'Módulo '; ?><?php the_field('numero_modulo') ?>. <?php the_title(); ?></div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
