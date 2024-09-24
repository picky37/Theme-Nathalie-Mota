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

function enregistrer_script_nathalie_mota() {
    wp_register_script( 'script_nathalie_mota', get_stylesheet_directory_uri() . '/js/script_nathalie_mota.js', '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enregistrer_script_nathalie_mota' );