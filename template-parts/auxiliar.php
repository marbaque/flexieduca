<?php
// variables for custom filelds
$audioURL = get_field('audio_contenido');
$resumen = get_field('resumen');
$obj = get_field('objetivos');

$meta = get_field('metadatos_audio');
$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
?>

<?php if ($audioURL || $resumen || $obj || $posts): ?>

        <ul class="accordion">
        <?php if ($audioURL): ?>
            <li class="audio">
                <button class="accordion-control audio-btn"><i class="fa fa-headphones"></i> Audio</button>
                <div class="accordion-panel audio">
                    <audio controls>
                        <source src="<?php echo $audioURL; ?>" type="audio/mpeg">
                        <?php echo __( 'Su navegador no admite el elemento de audio.', 'flexieduca' ); ?>
                    </audio>
                   <p class="descargar-audio button"><a href="<?php echo $audioURL; ?>" title="Descargar audio"><i class="fa fa-download"></i> Descargar</a></p>

		   <?php if ($meta): ?>
			   <p class="meta"><?php echo $meta; ?></p>
		   <?php else: ?>
		   	<p class="meta">© Universidad Estatal a Distancia, 2018. <i><?php echo $title; ?></i>. Mercadeo digital para la nueva economía [Audio en podcast].</p>
		   <?php endif; ?>

                </div>
            </li>
        <?php endif; ?>

        <?php if ($obj): ?>
            <li class="objetivos">
                <button class="accordion-control objetivos">Objetivos</button>
                <div class="accordion-panel">
                    <?php echo $obj; ?>
                </div>
            </li>
        <?php endif; ?>

        <?php if ($resumen): ?>
            <li class="resumen">
                <button class="accordion-control">Resumen</button>
                <div id="resumen" class="accordion-panel resumen">
                    <?php echo $resumen; ?>
                </div>
            </li>
        <?php endif; ?>
        </ul>




<?php endif; ?>
