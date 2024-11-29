<?php
/**
 * Nathalie Mota functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nathalie Mota
 * @since Nathalie Mota 1.0
 */

/**
 * Register block styles.
 */

// Fonction combinée pour enregistrer les scripts et les styles
function enregistrer_scripts_et_styles_nathalie_mota() {
    // Enregistrer les scripts
    wp_enqueue_script('script_nathalie_mota', get_theme_file_uri('/js/script_nathalie_mota.js'), [], null, true);
    wp_enqueue_script('script_photos_nathalie_mota', get_theme_file_uri('/js/script_photos_nathalie_mota.js'), [], null, true);
    
    // Enregistrer le style
    wp_enqueue_style('style_nathalie_mota', get_stylesheet_uri());
    
    }
    add_action('wp_enqueue_scripts', 'enregistrer_scripts_et_styles_nathalie_mota');

// Met dans un constante l'url de la racine du thème
define('THEME_URI', get_template_directory_uri());