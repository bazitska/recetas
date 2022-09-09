<?php

    // Crea un bloque Gutenberg para mostrar un grid de recetas
    function bloque_gut_grid_recetas(){

        acf_register_block([
            'name'				=>	'grid_recetas',
            'title'				=>	__('Grid recetas', 'recetas'),
            'description'		=>	__('Muestra un layout grid con las recetas', 'recetas'),
            'render_callback'	=>	'bloque_gut_grid_recetas_render_callback',
            'mode'				=>	'auto',
            'icon'				=>	'grid-view',
            'keywords'			=>	['grid', 'recetas'],
            'enqueue_style'		=>	get_template_directory_uri() . '/blocks/grid-recetas/estilos.css'
        ]);

    }

    // Registramos el bloque
    add_action('acf/init', 'bloque_gut_grid_recetas');

    // Función callback
    function bloque_gut_grid_recetas_render_callback($block){

        if(file_exists( get_theme_file_path("/blocks/grid-recetas/contenido.php"))){
            include(get_theme_file_path("/blocks/grid-recetas/contenido.php"));
        }

    }



?>