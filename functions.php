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
    wp_enqueue_script('script_nathalie_mota', get_theme_file_uri('/js/script_nathalie_mota.js'), [], null, true);
}
add_action( 'wp_enqueue_scripts', 'enregistrer_script_nathalie_mota' );

function enregistrer_style_nathalie_mota() {
    wp_enqueue_style( 'style_nathalie_mota', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'enregistrer_style_nathalie_mota' );

// Register a new sidebar simply named 'sidebar'
function add_widget_Support() {
                register_sidebar( array(
                                'name'          => 'Sidebar',
                                'id'            => 'sidebar',
                                'before_widget' => '<div>',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>',
                ) );
}
// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_Widget_Support' );

// Register a new navigation menu
function add_Main_Nav() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
// Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );