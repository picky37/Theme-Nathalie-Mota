<?php get_header(); ?>

<main class="wrap">
    <div class="randomHeader">
        <img class="titre_header_desktop"
            src="/wp-content/themes/Theme-Nathalie-Mota/images/titreHeader.svg" alt="Logo du header Nathalie Mota">

        <?php
        $related_args = [
            'post_type'      => 'Photo', // Utilisez le type de post approprié
            'posts_per_page' => 1,
            'orderby'        => 'rand',
        ];
        $related_query = new WP_Query($related_args);

        if ($related_query->have_posts()) :
            while ($related_query->have_posts()) :
                $related_query->the_post();
        ?>
                <?php
                // Afficher l'image mise en avant ou le contenu si aucune mise en avant
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', ['class' => 'photo-header']);
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
    $formats = get_terms([
        'taxonomy'   => 'format',
        'hide_empty' => false,
    ]);
    ?>

    <div class="mesFiltres">
        <div class="photo-filters">
            <?php
            $categories = get_terms([
                'taxonomy'   => 'categorie',
                'hide_empty' => false,
            ]);
            ?>

            <!-- Filtre pour les catégories -->
            <select id="categorie-filter" class="select2">
                <option value="">CATÉGORIES</option>
                <?php foreach ($categories as $categorie) : ?>
                    <option value="<?php echo esc_attr($categorie->slug); ?>">
                        <?php echo esc_html($categorie->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Filtre pour les formats -->
            <select id="taxonomy-filter" class="select2">
                <option value="">FORMATS</option>
                <?php foreach ($formats as $format) : ?>
                    <option value="<?php echo esc_attr($format->slug); ?>">
                        <?php echo esc_html($format->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Filtre | Trier par date -->
            <!-- <label for="date-sort"></label> -->
            <select name="date-sort" id="date-sort" class="select2">
                <option value="ALL">TRIER PAR</option>
                <option value="DESC">Du plus récent au plus ancien</option>
                <option value="ASC">Du plus ancien au plus récent</option>
            </select>
        </div>
    </div>

    <?php
    $number_of_photos = 8;
    $myOrderby = "DESC";
    $filter_by_category = false;

    include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/photo_block.php';
    ?>

    <div class="loadMore">
        <button id="load-more">Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>