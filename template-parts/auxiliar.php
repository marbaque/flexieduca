<?php
// variables for custom filelds
$audioURL = get_field('audio_contenido');
$resumen = get_field('resumen');
$obj = get_field('objetivos');
$posts = get_field('contenido_relacionado');
?>

<?php if ($audioURL || $resumen || $obj || $posts): ?>

        <ul class="accordion">
        <?php if ($audioURL): ?>
            <li class="audio">
                <button class="accordion-control audio-btn"><i class="fas fa-headphones"></i> Audio</button>
                <div class="accordion-panel audio">
                    <audio controls>
                        <source src="<?php echo $audioURL; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                   <a class="descargar-audio button" href="<?php echo $audioURL; ?>" title="Descargar audio"><i class="fas fa-download"></i> Descargar</a>
                </div>
            </li>
        <?php endif; ?>

        <?php if ($obj): ?>
            <li class="objetivos">
                <button class="accordion-control objetivos"><i class="far fa-dot-circle"></i> Objetivos</button>
                <div class="accordion-panel">
                    <?php echo $obj; ?>
                </div>
            </li>
        <?php endif; ?>
        
        <?php if ($resumen): ?>
            <li class="resumen">
                <button class="accordion-control"><i class="far fa-edit"></i> Resumen</button>
                <div id="resumen" class="accordion-panel resumen">
                    <?php echo $resumen; ?>
                </div>
            </li>
        <?php endif; ?>
	    
	<?php if ($posts): ?>
            <li class="relacionado">
                <button class="accordion-control"><i class="far fa-edit"></i> Contenido relacionado</button>
                <div class="accordion-panel">
                    <ul>
			<?php foreach ($posts as $post): // variable must be called $post (IMPORTANT)  ?>
			<?php setup_postdata($post); ?>
			    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		    </ul>
                </div>
            </li>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly  ?>
        <?php endif; ?>
        </ul>


<?php endif; ?>