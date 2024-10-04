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
<!-- include 'wp-content\themes\Theme-Nathalie-Mota\templates_part\menu_mobile.php';  -->
    <header class="my-header">
       <a href="accueil"><img class="img_logo" src="<?=THEME_URI?>/images/logo_nathalie_mota.svg" alt="Logo de Nathalie Mota"></a>
       <img src="<?=THEME_URI?>/images/Menu.svg" alt="Logo menu hamburger" class="logo_burger">
<?php
       wp_nav_menu( array('wp-content\themes\Theme-Nathalie-Mota'=> 'Menu 1') );
?>
    </header>
    
</body>