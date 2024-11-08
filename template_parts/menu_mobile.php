<div class="modal">
    <header class="my-header-mobile">
        <a href="accueil"><img class="img_logo" src="<?= THEME_URI ?>/images/logo_nathalie_mota.svg" alt="Logo de Nathalie Mota"></a>
        <img src="<?= THEME_URI ?>/images/Menu.svg" alt="Logo menu hamburger" class="logo_burger2">
    </header>
    <div class="navbar-mobile-list">
        <?php
        wp_nav_menu(array('wp-content\themes\Theme-Nathalie-Mota' => 'Menu 1'));
        ?>
    </div>
</div>