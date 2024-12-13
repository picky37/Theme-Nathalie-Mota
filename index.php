<?php get_header(); ?>
<main class="wrap">
    <div class="randomHeader">
        <img class="titre_header_desktop" src="/wp-content/themes/Theme-Nathalie-Mota/images/titreHeader.svg">
        <?php
        $related_args = array(
            'post_type' => 'Photo', // Utilisez le type de post approprié
            'posts_per_page' => 1,
            'orderby' => 'rand',
        );
        $related_query = new WP_Query($related_args);

        if ($related_query->have_posts()) :
            while ($related_query->have_posts()) : $related_query->the_post();
        ?>

                <?php
                // Afficher l'image mise en avant ou le contenu si aucune mise en avant
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'photo-header']);
                } else {
                    // Afficher le contenu de l'article si aucune image mise en avant
                    echo '<div class="image-header">';
                    echo the_content(); // the_content() affiche le contenu de l'article
                    echo '</div>';
                }
                ?>

        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/modale_contact.php'; ?>

    <?php
    // Filtre pour les formats
    $formats = get_terms(array(
        'taxonomy' => 'format',
        'hide_empty' => false,
    ));
    ?>

    <div class="photo-filters">
        <select id="taxonomy-filter">
            <option value="">FORMATS</option>
            <?php foreach ($formats as $format) : ?>
                <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
            <?php endforeach; ?>
        </select>

        <button id="filter-button">Appliquer les filtres</button>
    </div>

    <?php
    $categories = get_terms(array(
        'taxonomy' => 'categorie',
        'hide_empty' => false,
    ));
    ?>

    <!-- Filtre pour les catégories -->
    <div class="photo-filters">
        <select id="categorie-filter">
            <option value="">CATÉGORIES</option>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?php echo $categorie->slug; ?>"><?php echo $categorie->name; ?></option>
            <?php endforeach; ?>
        </select>

        <button id="filter-button">Appliquer les filtres</button>
    </div>

    <?php
    $number_of_photos = 16;
    $myOrderby = "none";

    include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/photo_block.php';
    include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/lightbox.php';
    ?>

    <button id="load-more" data-page="1">Charger plus</button>
</main>
<?php get_footer(); ?>
