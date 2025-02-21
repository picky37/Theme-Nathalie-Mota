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
function enregistrer_scripts_et_styles_nathalie_mota()
{
    // Enregistrer les scripts
    wp_enqueue_script('script_nathalie_mota', get_theme_file_uri('/js/script_nathalie_mota.js'), [], null, true);

    wp_localize_script(
        'script_nathalie_mota', // Identifiant du script
        'wp_data', // Nom de l'objet JavaScript à exposer
        array(
            'ajax_url' => admin_url('admin-ajax.php'), // URL de admin-ajax.php
        )
    );



    wp_enqueue_script('script_photos_nathalie_mota', get_theme_file_uri('/js/script_photos_nathalie_mota.js'), [], null, true);

    // Enregistrer le style
    wp_enqueue_style('style_nathalie_mota', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enregistrer_scripts_et_styles_nathalie_mota');

// Met dans un constante l'url de la racine du thème
define('THEME_URI', get_template_directory_uri());











































function filter_photos_ajax()
{
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $date_order = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : 'DESC';
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 8;
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0; // Ajout de l'offset

    $date_order = strtoupper($date_order);
    $date_order = in_array($date_order, ['ASC', 'DESC']) ? $date_order : 'DESC';

    $args = [
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'post_date',
        'order'          => $date_order,
        'offset'         => $offset, // Appliquer l'offset
        'tax_query'      => [],
    ];

    if (!empty($format)) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        ];
    }

    if (!empty($categorie)) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $categorie,
        ];
    }

    $query = new WP_Query($args);


    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
            <a href="<?php echo esc_url($full_image_url); ?>" class="lightbox" data-post-link="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php the_title_attribute(); ?>">
                <div class="post-info">
                    <?php
                    $reference = get_post_meta(get_the_ID(), 'Reference', true);
                    if (!empty($reference)) {
                        echo '<p>' . esc_html($reference) . '</p>';
                    }
                    $terms = get_the_terms(get_the_ID(), 'categorie');
                    if ($terms && !is_wp_error($terms)) {
                        $categories = wp_list_pluck($terms, 'name');
                        echo '<p>' . esc_html(implode(', ', $categories)) . '</p>';
                    }
                    ?>
                </div>
                <div class="lightbox-zoom">
                    <img src="http://projet-11-nathalie-mota.local/wp-content/themes/Theme-Nathalie-Mota/images/logo_fullscreen.svg" alt="Icône Plein Écran" class="fullscreen-icon" />
                </div>
                <div class="detail-eye">
                    <img src="http://projet-11-nathalie-mota.local/wp-content/themes/Theme-Nathalie-Mota/images/Icon_eye.svg" alt="Icône oeuil détail" class="eye-icon" />
                </div>
            
            </a>



            <div
                class="post-data"
                data-reference="<?php echo esc_attr($reference); ?>"
                data-category="<?php echo esc_attr(implode(', ', $categories ?? [])); ?>"
                data-date="<?php echo esc_attr(get_the_date('Y-m-d H:i:s')); ?>">
            </div>

<?php
        }
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }

    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos_ajax');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax');
