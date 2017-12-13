<?php
// variables for custom filelds
$audioURL = get_field('audio_contenido');
$resumen = get_field('resumen');
$obj = get_field('objetivos');
?>

<?php if ($audioURL || $resumen || $obj): ?>

    <div class="entry-meta">
        <ul class="accordion">
        <?php if ($audioURL): ?>
            <li>
                <button class="accordion-control"><i class="fa fa-headphones" aria-hidden="true"></i> Audio</button>
                <div class="accordion-panel">
                    <audio controls>
                        <source src="<?php echo $audioURL; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
    <!--                <a href="<?php echo $audioURL; ?>" title="Descargar audio">Descargar audio</a>-->
                </div>
            </li>
        <?php endif; ?>

        <?php if ($obj): ?>
            <li>
                <button class="accordion-control"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Objetivos</button>
                <div class="accordion-panel">
                    <?php echo $obj; ?>
                </div>
            </li>
        <?php endif; ?>
        
        <?php if ($resumen): ?>
            <li>
                <button class="accordion-control"><i class="fa fa-telegram" aria-hidden="true"></i> Resumen</button>
                <div id="resumen" class="accordion-panel">
                    <?php echo $resumen; ?>
                </div>
            </li>
        <?php endif; ?>
        </ul>

    </div><!-- .entry-meta -->

<?php endif; ?>