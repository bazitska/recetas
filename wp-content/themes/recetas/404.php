<?php

	/**
	 * Plantilla para mostrar el ERROR 404.
	*/

	// Cabecera
	get_header(); 

?>

<div class="contenedor">

	<div class="contenedor-404">

		<img src="<?php echo get_template_directory_uri(); ?>/recursos/img/error-404.png" alt="<?php _x('Sin imagen', 'recetas'); ?>">

		<p>
			<?php echo __('No se ha encontrado la página que estaba buscando', 'recetas'); ?> :(
		</p>

		<a href="<?php echo site_url();?>" class="boton-principal">Ir al inicio</a>
		
	</div>

</div>

<?php

	// Footer
	get_footer();

?>