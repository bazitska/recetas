<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php if(is_front_page()){ ?>
			<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
		<?php }else{ ?>
			<title><?php wp_title(' | ', 'echo', 'right'); ?><?php bloginfo('name'); ?></title>
		<?php } ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<header>
		<div class="contenedorHeader">
			<div>
				<a href="<?php echo get_site_url(); ?>" title="<?php the_title(); ?>" id="logo_header">
					<?php echo pintar_logo(); ?>
				</a>
				<a href="<?php echo get_site_url(); ?>" title="<?php the_title(); ?>" id="small_logo_header">
					<h1>R</h1>
				</a>
			</div>
			<div>
				<?php get_search_form(); ?>
			</div>
            <nav role="navigation" id="nav-header">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-principal',  'menu_class' => 'nav navbar-nav', 'container' => 'ul' ) ); ?>
			</nav>
			<div class="contenedor-iconos-header">
				<div id="contenedor-lupa-header" class="contenedor-icono-header">
					<img src="<?php echo get_template_directory_uri(); ?>/recursos/img/lupa.png" alt="">
				</div>
				<div id="contenedor-bars-header" class="contenedor-icono-header">
					<img src="<?php echo get_template_directory_uri(); ?>/recursos/img/menu.png" alt="">
				</div>
			</div>	


		</div>
	</header>
	<body <?php body_class(isset($class) ? $class : ''); ?>>
		<div>
