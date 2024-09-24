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

 function my_nathalie_mota_enqueue_scripts() {
    // Enqueue le fichier custom.js avec jQuery comme dépendance
    wp_enqueue_script( 'my-first-custom-script', get_template_directory_uri() . '/js/script_nathalie_mota.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_nathalie_mota_enqueue_scripts' );