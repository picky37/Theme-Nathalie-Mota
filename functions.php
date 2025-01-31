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











































function filter_photos_ajax() {
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'tax_query' => [],
    ];

    if (!empty($format)) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        ];
    }

    if (!empty($categorie)) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie,
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Génère le même HTML que dans ton template
            $full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <a href="<?php echo esc_url($full_image_url); ?>" class="lightbox" data-post-link="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php the_title_attribute(); ?>">
                <div class="post-info">
                    <?php
                    // Récupérer la référence
                    $reference = get_post_meta(get_the_ID(), 'Reference', true);
                    if (!empty($reference)) {
                        echo '<p>' . esc_html($reference) . '</p>';
                    }
                    // Récupérer les catégories
                    $terms = get_the_terms(get_the_ID(), 'categorie');
                    if ($terms && !is_wp_error($terms)) {
                        $categories = wp_list_pluck($terms, 'name');
                        echo '<p>' . esc_html(implode(', ', $categories)) . '</p>';
                    }
                    ?>
                </div>
                <div class="lightbox-zoom"><img src="http://projet-11-nathalie-mota.local/wp-content/themes/Theme-Nathalie-Mota/images/logo_fullscreen.svg" alt="Icône Plein Écran" class="fullscreen-icon" /></div>
                <div class="detail-eye"><img src="http://projet-11-nathalie-mota.local/wp-content/themes/Theme-Nathalie-Mota/images/Icon_eye.svg" alt="Icône oeuil détail" class="eye-icon" /></div>

            </a>
            <?php
        }
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }

    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos_ajax');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax');



































































// Créer une fonction pour charger des articles - Photo
function load_more() {
    $page = $_GET['page']; // Récupère le numéro de page à charger à partir de la requête GET

    $args_custom_posts = array(
        'post_type' => 'photo', // Type de publication personnalisée à charger
        'posts_per_page' => 8, // Nombre de publications à afficher par page
    );

    // Vérification des paramètres de catégorie et de format dans la requête GET
    if( 
        $_GET['category'] != NULL && 
        $_GET['category'] != 'ALL' &&
        $_GET['format'] != NULL &&
        $_GET['format'] != 'ALL'
    ){
        // Si à la fois la catégorie et le format sont spécifiés, nous créons une requête complexe (opérateur logique "ET")
        $args_custom_posts['tax_query'] = array(
            'relation' => 'AND', // Opérateur logique "ET" pour s'assurer que les deux requêtes sont satisfaites
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $_GET['category']
            ),
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $_GET['format']
            )
        );
    }else{
        // Si seule la catégorie est spécifiée
        if( 
            $_GET['category'] != NULL && 
            $_GET['category'] != 'ALL'
        ){
            // Crée une requête pour filtrer par catégorie
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'slug',
                    'terms'    => $_GET['category']
                )
            );
        }
        // Si seul le format est spécifié
        if(
            $_GET['format'] != NULL &&
            $_GET['format'] != 'ALL' 
        ){
            // Crée une requête pour filtrer par format
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'format',
                    'field'    => 'slug',
                    'terms'    => $_GET['format']
                )
            );
        }
    }
    $args_custom_posts['orderby'] = 'date'; // Trie les publications par date
    $args_custom_posts['order'] = $_GET['dateSort'] != 'ALL' ? $_GET['dateSort'] : 'DESC'; // Ordonne par ordre descendant si le tri par date est spécifié
    $args_custom_posts['paged'] = $page; // Gère la pagination en fonction du numéro de page

    $custom_posts_query = new WP_Query($args_custom_posts); // Effectue une requête WordPress pour obtenir les publications personnalisées

    if ($custom_posts_query->have_posts()) {
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
             // Contenu | Article - Même format que dans "photo-block.php"
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <!-- Section | Overlay Catalogue -->
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Icône de l'œil"> <!-- Icône de l'œil | Information Photo -->
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i><!-- Icône de plein écran -->
                                    <?php
                                    // Récupère la référence et la catégorie de l'image associée
                                    $related_reference_photo = get_field('reference_photo');
                                    $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                    $related_category_names = array();

                                    if ($related_categories) {
                                        foreach ($related_categories as $category) {
                                            $related_category_names[] = esc_html($category->name);
                                        }
                                    }
                                    ?>
                                    <div class="photo-info">
                                        <div class="photo-info-left">
                                            <p><?php echo esc_html($related_reference_photo); ?></p>
                                        </div>
                                        <div class="photo-info-right">
                                            <p><?php echo implode(', ', $related_category_names); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php
            // Fin de la structure du contenu de l'article
        endwhile;
        wp_reset_postdata(); // Réinitialise les données des publications personnalisées
    } else {
        // Aucun autre article à charger
    }
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_load_more_posts'
add_action('wp_ajax_nopriv_load_more_posts', 'load_more'); // Associe la fonction 'load_more_posts' à l'action AJAX 'wp_ajax_nopriv_load_more_posts'