<?php

    /**
     * Block Name: Bloque 
     *
     * Bloque utilizado para mostrar el grid de recetas
     */

    if(get_field('mostrar_titulo_grid_recetas') && get_field('mostrar_titulo_grid_recetas') !== null){

        $mostrar_titulo_seccion = (get_field('mostrar_titulo_grid_recetas') == "si") ? true : false;
        $titulo_seccion = "";
        if($mostrar_titulo_seccion){
            $titulo_seccion_field = get_field('titulo-grid-recetas');
            $titulo_seccion = ($titulo_seccion_field !== null && strlen($titulo_seccion_field) > 0) ? $titulo_seccion_field : __("Recetas","recetas");  
        }
        
    }




    $args = array(
        'post_type' => 'receta',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'orderby'   => 'menu_order',
        'order'     => 'ASC'
    );

    $recetas = new WP_Query($args);

    // Comprobamos si hay recetas

    if($recetas->have_posts()){

?>

<?php
    if($mostrar_titulo_seccion){
?>
    <div class="contenedor-grid-recetas"><h2><?=$titulo_seccion?></h2>
<?php
    }
?>

<section class="recetas-grid">

    <?php

            while($recetas->have_posts()){

                $recetas->the_post();
                $nombre_receta = get_the_title();
                $imagen_receta = (get_field('imagen-receta',get_the_ID())) ? wp_get_attachment_image( get_field('imagen-receta', get_the_ID())['ID'], "medium") : "";
                $link_receta = get_the_permalink();
                $duracion_receta = (get_field('tiempo-elaboracion-receta',get_the_ID()) && strlen(trim(get_field('tiempo-elaboracion-receta',get_the_ID()))) > 0) ? get_field('tiempo-elaboracion-receta',get_the_ID()) : "";

    ?>

                <article class="tarjeta-grid-receta">
                    <?php
                        if($imagen_receta !== ""){
                    ?>
                    <div class="cabecera-tarjeta-grid-receta">
                        <?=$imagen_receta;?>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="contenido-tarjeta-grid-receta">

                        <h3 class="nombre-tarjeta-grid-receta">
                            <?=$nombre_receta;?>
                        </h3>
                        <?php

                            if(isset($duracion_receta) && $duracion_receta !== ""){
                        ?>
                                <div class="tiempo-elaboracion-tarjeta-grid-receta"><span>Tiempo de elaboración apróximado: </span><span class="f-weight-bold"><?=$duracion_receta;?></span></div>
                        <?php 
                            }
                        ?>
                        <a href="<?=$link_receta;?>" class="boton-principal boton-sm">Ver receta</a>

                    </div>

                </article>
                
    <?php

            }

            wp_reset_postdata();

    ?>

</section>

<?php
    if($mostrar_titulo_seccion){
?>
    </div>
<?php
    }
?>

<?php 

    }
?>