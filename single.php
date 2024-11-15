<?php
get_header();
?>

<?php include 'wp-content\themes\Theme-Nathalie-Mota\template_parts\modale_contact.php'; ?>

<div class="single-post-container">

    <div class="post-header">

        <div class="post-details">

            <h1 class="post-title"><?php the_title(); ?></h1>

            <p class="post-reference">Référence : <?php echo esc_html(get_post_meta(get_the_ID(), 'Reference', true)); ?></p>

            <?php $reference = esc_attr(get_post_meta(get_the_ID(), 'Reference', true)); ?>

            <div id="reference-container" data-reference="<?php echo htmlspecialchars($reference, ENT_QUOTES, 'UTF-8'); ?>"></div>

            <p class="post-category">
                Catégorie :
                <?php
                $terms = get_the_terms(get_the_ID(), 'categorie');
                if ($terms && !is_wp_error($terms)) {
                    $categories = wp_list_pluck($terms, 'name');
                    echo esc_html(implode(', ', $categories));
                }
                ?>
            </p>

            <p class="post-format">
                Format :
                <?php
                $terms = get_the_terms(get_the_ID(), 'format');
                if ($terms && !is_wp_error($terms)) {
                    $formats = wp_list_pluck($terms, 'name');
                    echo esc_html(implode(', ', $formats));
                }
                ?>
            </p>

            <p class="post-type">Type : <?php echo esc_html(get_post_meta(get_the_ID(), 'Type', true)); ?></p>

            <p class="post-year">Année : <?php echo get_the_time('Y'); ?></p>

        </div>

        <div class="post-image">

            <?php the_content(); ?>

        </div>

    </div>

    <div class="post-contact">

        <p>Cette photo vous intéresse ?</p>

        <li id="menu-item-x"><a href="#modale" class="contact-button">Contact</a></li>

    </div>

    <div class="post-related">

        <h3>Vous aimerez aussi</h3>

        <div class="photos-apparentees">

            <?php
            // Requête pour afficher des articles similaires
            $related_args = array(
                'post_type' => 'Photo', // Utilisez le type de post approprié
                'posts_per_page' => 2,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie', // Remplacez par le slug de votre taxonomie
                        'field'    => 'term_id', // Peut être 'slug' ou 'name' selon votre besoin
                        'terms'    => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids')), // Récupère les IDs des termes de la taxonomie associés au post actuel
                        'operator' => 'IN', // Inclut les posts ayant au moins une des catégories
                    ),
                ),
            );
            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post();
            ?>
                    <a href="<?php the_permalink(); ?>" class="photo-link">
                        <?php
                        // Afficher l'image mise en avant ou le contenu si aucune mise en avant
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('large', ['class' => 'photo-apparentee']);
                        } else {
                            // Afficher le contenu de l'article si aucune image mise en avant
                            echo '<div class="article-content">';
                            echo the_content(); // the_content() affiche le contenu de l'article
                            echo '</div>';
                        } ?>

                <?php
                endwhile;
                wp_reset_postdata();
            endif;
                ?>
        </div>
    </div>
</div>

<!-- <div class="photos-apparentees">
  <img src="/wp-content/themes/Theme-Nathalie-Mota/images/nathalie-4.jpeg" alt="Image 1">
  <img src="/wp-content/themes/Theme-Nathalie-Mota/images/nathalie-5.jpeg" alt="Image 2">
</div> -->

<?php
get_footer();
?>