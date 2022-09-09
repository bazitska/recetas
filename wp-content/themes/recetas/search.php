<?php

	// Búsqueda

	// Tipo de Post
	$post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : "";

	// Cadena a buscar
	$busqueda = $_GET['s'];

	// Cabecera
	get_header("search"); 

?>

	<div class="contenedor">

		<?php

			if(have_posts()){
			
		?>
            <div class="titulo-busqueda">
                <a href="javascript:history.back()"><img src="<?php echo get_template_directory_uri(); ?>/recursos/img/back.png" alt="<?php _x('Flecha para volver atras', 'recetas'); ?>"></a>
				<h1><?php echo __("Resultado de busqueda", "recetas"); ?>: <span class="color-destacado"><?=$busqueda;?></span></h1>
            </div>

			<?php
				if($post_type == "receta"){
			?>

				<section>

					<?php
				
						while(have_posts()){

							the_post();

							$imagen_field = get_field('imagen-receta');

							$imagen_receta = ($imagen_field) ? wp_get_attachment_image( $imagen_field['ID'], 'thumbnail') : "";
							$link_receta = get_the_permalink();
							$titulo_receta = get_the_title();

					?>

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
							</div>

						</article>
					
					<?php
						}
					}
					?>

				</section>

			<?php
				}
				else{
			?>


				<div class="contenido-no-encontrado">

					<img src="<?php echo get_template_directory_uri(); ?>/recursos/img/sad.png" alt="">
					<p class="text-align-center"><?php echo __("Sin resultados", "recetas");?></p>
					<a href="/recetas" class="boton-secundario mb-2 mt-2"><?php echo __("Volver a todas las recetas", "recetas");?></a>
				</div>

			<?php
				}
			?>

	</div>


	<?php 

		// Footer
		get_footer();

	?>

