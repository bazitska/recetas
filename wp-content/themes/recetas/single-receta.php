<?php
    /**
    * Plantilla para mostrar el contenido de la receta
    */

    // Cabecera
    get_header();

    echo "<div class='contenedor'>";
    
    if(have_posts()){

        the_post();

        $imagen_field = get_field('imagen-receta');
        $ingredientes_field = get_field('ingredientes-receta');
        $tiempo_elaboracion_field = get_field('tiempo-elaboracion-receta');
        $pasos_elaboracion_field = get_field('pasos-elaboracion');
        
        $titulo_receta = get_the_title();
        $imagen_receta = ($imagen_field) ? wp_get_attachment_image( $imagen_field['ID'], 'full') : "";
        $elaboracion_receta = ($elaboracion_field && strlen(trim($elaboracion_field)) > 0) ? $elaboracion_field : "";
        $tiempo_elaboracion_receta = ($tiempo_elaboracion_field  && strlen(trim($tiempo_elaboracion_field )) > 0) ? $tiempo_elaboracion_field  : "";
?>

        <article class="receta">

            <div class="titulo-receta">
                <a href="javascript:history.back()"><img src="<?php echo get_template_directory_uri(); ?>/recursos/img/back.png" alt="<?php _x('Flecha para volver atras', 'recetas'); ?>"></a>
                
                <h1><?=$titulo_receta;?></h1>
            </div>
            <?php 
                if($imagen_receta !== ""){
            ?>
                <div class="imagen-receta">
                    <?=$imagen_receta;?>
                </div>
            <?php
                }
            ?>

            <div class="contenido-receta">

                <?php 
                    if($tiempo_elaboracion_receta !== ""){
                ?>
                    <div class="tiempo-elaboracion-receta">
                        <span class="f-weight-bold"><?php echo __('Tiempo de elaboracion', 'recetas'); ?>: </span>
                        <?=$tiempo_elaboracion_receta;?>
                    </div>
                <?php
                    }
                ?>
                <?php 
                    if($ingredientes_field && count($ingredientes_field) > 0){
                ?>
                    <div class="elaboracion-receta">
                        <span class="f-weight-bold mb-1 d-block"><?php echo __('Ingredientes', 'recetas'); ?></span>
                        <div class="contenedor-ingredientes-receta">
                            <ul>
                                <?php 
                                    foreach($ingredientes_field as $ing){
                                        echo "<li>${ing['cantidad']} ${ing['nombre-ingrediente']}</li>";
                                    }
                                ?>    
                            </ul>

                        </div>
                    </div>
                <?php
                    }
                ?>
                <?php 
                    if($pasos_elaboracion_field && count($pasos_elaboracion_field) > 0){
                ?>
                    <div class="elaboracion-receta">
                        <span class="f-weight-bold mb-1 d-block"><?php echo __('Preparación', 'recetas'); ?></span>
                        <div class="contenedor-pasos">
                            <?php
                                $i = 1;
                                foreach($pasos_elaboracion_field as $paso){
                                    echo "<div class='paso-receta'><span>${i}</span>${paso['descripcion-paso']}</div>";
                                    ++$i;
                                }
                            ?>    
                        </div>
                    </div>
                <?php
                    }
                ?>


            </div>

        </article>

<?php
        the_content();
    }
    else{
        echo __('No se ha encontrado el contenido de esta receta', 'recetas');
    }

    echo "</div>";

    // Footer
    get_footer();

?>