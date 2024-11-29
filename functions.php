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
    wp_enqueue_script('script_photos_nathalie_mota', get_theme_file_uri('/js/script_photos_nathalie_mota.js'), [], null, true);
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

function fonts_test() {
  echo '<h1>H1 CECI EST UN SUPER TEST</h1>';
  echo '<h2>H2 CECI EST UN SUPER TEST</h2>';
  echo '<h3>H3 CECI EST UN SUPER TEST</h3>';
  echo '<p class="description">DESCRIPTION PHOTO CECI EST UN SUPER TEST</p>';
  echo '<p>Paragraphe CECI EST UN SUPER TEST</p>';
}

define('THEME_URI', get_template_directory_uri());

function mota_request_photos() {
  // Configuration de la requête
  $query = new WP_Query([
      'post_type' => 'Photos', // Remplacez par le slug correct de votre CPT
      'posts_per_page' => 2,  // Limite à 2 résultats
  ]);

  if ($query->have_posts()) {
      $photos = [];

      while ($query->have_posts()) {
          $query->the_post();

          // Ajouter les informations utiles dans un tableau
          $photos[] = [
              'title' => get_the_title(), // Titre de l'article
              'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '', // URL de l'image mise en avant
              'link'  => get_permalink(), // URL de l'article
          ];
      }

      wp_send_json_success($photos);
  } else {
      wp_send_json_error('Aucune photo trouvée.');
  }

  wp_die();
}

add_action('wp_ajax_photos', 'mota_request_photos');
add_action('wp_ajax_nopriv_photos', 'mota_request_photos');


















































add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) + 1 : 1;

    $args = array(
        'post_type' => 'Photo',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <a class="accueil" href="<?php the_permalink(); ?>" class="photo-link">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'photo-apparentee']);
                } else {
                    echo '<div class="article-content">';
                    echo the_content();
                    echo '</div>';
                }
                ?>
            </a>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '';
    endif;

    die(); // Arrête la requête AJAX ici
}

