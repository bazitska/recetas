<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="searchform">
	
	<input type="text" class="search-field" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo __('Buscar receta', 'recetas');?>" id="search-field">
    
	<input type="submit" value="<?php echo __('Buscar', 'recetas');?>" id="boton-buscar">
	
	<input type="hidden" name="post_type" value="receta"/>

</form>