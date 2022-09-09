<?php

    // Página de listado de CPT receta

    // Cabecera
    get_header('search');

    
	$terms = get_terms("categoria-receta");
    
?>

    <div class="contenedor">

    <?php
        
        // Comprobamos si tenemos recetas a mostrar

        $args = array(
            'post_type' => 'receta'
        );

        // Si recibimos por $_GET el slug de la categoria, añadimos los parámetros de esa taxonomia a la query

        $term = false;

        if(isset($_GET['categoria']) && $_GET['categoria'] !== "" && strlen($_GET['categoria']) > 0){

            $term = get_term_by('slug', $_GET['categoria'], 'categoria-receta');

            if($term){


                $args['tax_query'] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'categoria-receta',
                        'terms'    => $term->slug,
                        'field' => 'slug'
                    )
                );

            }
        }

        $categoria_incorrecta = (isset($_GET['categoria']) && $_GET['categoria'] !== "" && strlen($_GET['categoria']) > 0 && !$term) ? true : false;

        $query = new WP_Query($args);

        if($categoria_incorrecta){
            
        ?>

            <div class="contenido-no-encontrado">

                <img src="<?php echo get_template_directory_uri(); ?>/recursos/img/sad.png" alt="">
                

                <?php 
                    
                    $categorias_receta = get_terms("categoria-receta");

                    if($categorias_receta && count($categorias_receta) > 0){

                ?>
                    <p class="text-align-center"><?php echo __("La categoría que está buscando no se ha encontrado", "recetas");?>.<br><?php echo __("¿Por qué no prueba con estás?","recetas")?></p>
                    <section class="contenedor-filtros">

                        <?php

                            foreach($categorias_receta as $cat){

                                $nombre_categoria = $cat->name;
                                $slug_categoria = $cat->slug;
                                $id_categoria = $cat->term_id;
                                $url =  $home_url . "?categoria=${slug_categoria}";

                                $clase_item = (isset($_GET['categoria']) && $_GET['categoria'] == $slug_categoria) ? "item-filtro item-filtro-seleccionado" : "item-filtro";

                        ?>
                                <a class="<?=$clase_item;?>" href="<?=$url;?>">
                                    <?=$nombre_categoria;?>
                                </a>
                        <?php

                            }

                        ?>
                        
                    </section>

                <?php
                    }
                ?>

                <a href="/recetas" class="boton-secundario mb-2 mt-2"><?php echo __("Volver a todas las recetas", "recetas");?></a>

            </div>  

        <?php
        }
        else{

            if($query->have_posts()) {

    ?>

        <h1><?php echo __('Nuestras recetas', 'recetas');?></h1>

        <?php

                $categorias_receta = get_terms("categoria-receta");

                if($categorias_receta && count($categorias_receta) > 0){

        ?>

                <section class="contenedor-filtros">

                    <?php

                        global $wp;
                        $home_url = home_url($wp->request);

                        $clase_item = (!isset($_GET['categoria'])) ? "item-filtro item-filtro-seleccionado text-uppercase f-weight-bold" : "item-filtro text-uppercase f-weight-bold";

                    ?>

                        <a href="<?=$home_url;?>" class="<?=$clase_item;?>"><?php echo __("Todas las recetas", "recetas"); ?></a>

                    <?php

                        foreach($categorias_receta as $cat){

                            $nombre_categoria = $cat->name;
                            $slug_categoria = $cat->slug;
                            $id_categoria = $cat->term_id;
                            $url =  $home_url . "?categoria=${slug_categoria}";

                            $clase_item = (isset($_GET['categoria']) && $_GET['categoria'] == $slug_categoria) ? "item-filtro item-filtro-seleccionado" : "item-filtro";

                    ?>
                            <a class="<?=$clase_item;?>" href="<?=$url;?>">
                                <?=$nombre_categoria;?>
                            </a>
                    <?php

                        }

                    ?>

                </section>

        <?php

                }

        ?>
        
        <?php

                $etiquetas_receta = get_terms("etiqueta-receta");


                if($etiquetas_receta && count($etiquetas_receta) > 0){

        ?>

                <section class="contenedor-filtros" id="contenedor-etiquetas">

                    <?php
                    
                        foreach($etiquetas_receta as $et){

                            $nombre_etiqueta = $et->name;
                            $slug_etiqueta = $et->slug;
                            $id_etiqueta = $et->term_id;
                    ?>
                            <div class="item-filtro etiqueta-filtro" id="<?=$slug_etiqueta;?>">
                                <?=$nombre_etiqueta;?>
                            </div>
                    <?php

                        }

                    ?>

                </section>

        <?php

                }

        ?>

            <section>

                <?php

                    while ($query->have_posts()) {

                        $query->the_post();

                        // Recogemos los datos que necesitamos para mostrar la receta

                        $imagen_field = get_field('imagen-receta');

                        $imagen_receta = ($imagen_field) ? wp_get_attachment_image( $imagen_field['ID'], 'thumbnail') : "";
                        $link_receta = get_the_permalink();
                        $titulo_receta = get_the_title();

                ?>

                        <!-- Contenedor de la receta -->
                        <article class="receta-lista">

                            <?php 
                                if($imagen_receta !== ""){
                            ?>
                                <div class="imagen-receta-lista">
                                    <?=$imagen_receta;?> 
                                </div>
                                
                            <?php
                                }
                            ?>

                            <div class="contenido-receta-lista">

                                <div class="titulo-receta-lista">
                                    <?=$titulo_receta;?>
                                </div>
                                
                                <a href="<?=$link_receta;?>" class="boton-principal boton-sm"><?php echo __('Ver la receta','recetas');?></a>

                                    <?php
                                        $etiquetas_receta = wp_get_post_terms(get_the_ID(),"etiqueta-receta");
                                        if($etiquetas_receta && count($etiquetas_receta) > 0){
                                    ?>
                                        <div class="contenedor-etiquetas-receta">

                                            <?php
                                                foreach($etiquetas_receta as $et){
                                                    $nombre_et = $et->name;
                                                    $slug_et = $et->slug;
                                            ?>

                                                <div class="etiqueta-receta etiqueta-<?=$slug_et;?> oculto">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/recursos/img/check.png" alt="<?php echo __('Icono check', 'recetas') ?>">
                                                    <span><?=$nombre_et;?></span>
                                                </div>

                                            <?php 
                                                }
                                            ?>
                                            

                                        </div>
                                    <?php
                                        }
                                    ?>

                            </div>

                        </article>
                <?php
                    
                    }

                ?>

            </section>


<?php 
            }
            else{
?>

        <div class="contenido-no-encontrado">

            <img src="<?php echo get_template_directory_uri(); ?>/recursos/img/sad.png" alt="">
            <p class="text-align-center"><?php echo __("Sin resultados", "recetas");?>.<br><?php echo __("¿Por qué no prueba con estás?","recetas")?></p>
            
        </div>
<?php
        }
    }
?>
    </div>
<?php
    get_footer();
?>