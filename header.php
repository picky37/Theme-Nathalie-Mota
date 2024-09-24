<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="my-logo">
       <a href="accueil"><img src="wp-content\themes\Theme-Nathalie-Mota\images\logo_nathalie_mota.svg" alt="Logo de Nathalie Mota"></a>
    </header>
    <?php wp_nav_menu( array( 'header-menu' => 'header-menu' ) ); ?>
</body>