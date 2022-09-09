<?php

    /**
     * @package Bisiesto
     */
    /*
        Plugin Name: Entidades Recetas
        Plugin URI: https://bisiesto.es
        Description: Entidades del proyecto 'recetas'
        Version: 1.0.0
        Author: Bisiesto
        Author URI: https://bisiesto.es
        License: GPLv2 or later
        Text Domain: recetas
    */

    // Creamos el CPT de Recetas
    function crear_cpt_receta(){

        // Labels del CPT
        $labels = array(
            'name' =>               _x('Recetas', 'post type general name', 'recetas'),
            'singular_name' =>      _x('Receta', 'post type singular name', 'recetas'),
            'menu_name' =>          _x('Recetas', 'admin menu', 'recetas'),
            'name_admin_bar' =>     _x('Recetas', 'add new on admin bar', 'recetas'),
            'add_new' =>            _x('Añadir nueva', 'receta', 'recetas'),
            'add_new_item' =>       __('Añadir una nueva receta', 'recetas'),
            'new_item' =>           __('Nueva receta', 'recetas'),
            'edit_item' =>          __('Editar receta', 'recetas'),
            'view_item' =>          __('Ver receta', 'recetas'),
            'all_items' =>          __('Todas las recetas', 'recetas'),
            'search_items' =>       __('Buscar receta', 'recetas'),
            'parent_item_colon' =>  __('Padre:', 'recetas'),
            'not_found' =>          __('No se han encontrado recetas', 'recetas'),
            'not_found_in_trash' => __('No hay recetas en la papelera', 'recetas')
        );

        // Parametros del CPT
        $args = array(
            'labels'                => $labels,
            'description'           => __('Entidad del proyecto \"recetas\"', 'recetas'),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'   	    => true,
            'show_in_rest'          => true,
            'query_var'      	    => true,
            'rewrite'        	    => array( 'slug' => 'receta'),
            'capability_type'	    => 'post',
            'has_archive'    	    => true,
            'hierarchical'   	    => true,
            'menu_position'  	    => null,
            'supports'       	    => array('title','page-attributes'),
            'menu_icon'             => 'dashicons-food',
            'show_in_rest'          => true,
            'rest_base'             => 'receta',
            'can_export'            => true
        );

        // Registramos el CPT
        register_post_type('receta', $args);
        

        // Parametros de la taxonomía Categoría
        $args_tax_cat = array(
            'hierarchical'          => true,
            'label'                 => __('Categorías', 'recetas'),
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array('slug' => 'categoria-receta'),
            'public'         	    => true,
            'show_in_rest'          => true
        );

        // Registramos taxonomía de Categoría
        register_taxonomy('categoria-receta', 'receta', $args_tax_cat);

        // Parámetros de la taxonomía Etiqueta
        $args_tax_et = array(
            'hierarchical'          => true,
            'label'                 => __('Etiquetas', 'recetas'),
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array('slug' => 'etiqueta-receta'),
            'public'         	    => true,
            'show_in_rest'          => true
        );

        // Registramos taxonomía de Etiqueta
        register_taxonomy('etiqueta-receta', 'receta', $args_tax_et);

    }

    add_action('init', 'crear_cpt_receta');

    add_filter( 'register_post_type_args', 'wpse247328_register_post_type_args', 10, 2);

    function wpse247328_register_post_type_args($args, $post_type){

        if('receta' === $post_type){
            $args['rewrite']['slug'] = 'recetas';
        }
        return $args;

    }


?>