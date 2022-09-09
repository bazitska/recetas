<?php

	/**
	* Plantilla para mostrar el contenido de la página
	*/

	// Cabecera
	get_header();

	echo "<div class='contenedor'>";

	if(have_posts()){
		the_post();
		if(has_post_thumbnail()){
			the_post_thumbnail('thumbnail');
		}

?>


<?php
		the_title("<h1 class='titulo-pagina'>","</h1>");
		the_content();
	}
	else{
		echo __('No hay contenido en este post.', 'recetas');
	}

	echo "</div>";

	// Footer
	get_footer();

?>
