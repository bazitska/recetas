<?php

    /**
     * Obtiene el filtro que está activo en el formulario de búsqueda (para los botones del mismo)
     * @param $tipo_post
     *
     * @return string
     */

    function obtener_filtro_activo($tipo_post){
        return (isset($tipo_post)) ? $tipo_post : "*";
    }

    
?>