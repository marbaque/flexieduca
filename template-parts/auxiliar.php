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
            <li class="audio">
                <button class="accordion-control audio-btn">Audio</button>
                <div class="accordion-panel audio">
                    <audio controls>
                        <source src="<?php echo $audioURL; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
    <!--                <a href="<?php echo $audioURL; ?>" title="Descargar audio">Descargar audio</a>-->
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

    </div><!-- .entry-meta -->

<?php endif; ?>