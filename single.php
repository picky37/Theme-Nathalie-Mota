<?php
get_header();
?>
<?php include 'wp-content\themes\Theme-Nathalie-Mota\template_parts\modale_contact.php'; ?>
<div class="single-post-container">
    <div class="post-header">
        <div class="post-details">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <p class="post-reference">Référence : <?php echo esc_html(get_post_meta(get_the_ID(), 'Reference', true)); ?></p>
            <?php $reference = esc_attr(get_post_meta(get_the_ID(), 'Reference', true));?>
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
        <h2>Vous aimerez aussi</h2>
        <div class="related-posts">
            <?php
            // Requête pour afficher des articles similaires
            $related_args = array(
                'post_type' => 'mariage', // Utilisez le type de post approprié
                'posts_per_page' => 2,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post();
                    ?>
                    <div class="related-post">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </div>
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

<div class="photos-apparentees">
    <?php
    // Obtenez l'ID de la catégorie courante si vous êtes sur un article
    $current_category_id = null;
    if (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $current_category_id = $categories[0]->term_id;
        }
    }

    // Requête WP_Query
    $args = [
        'post_type'      => 'Photo', // Changez en 'photos' pour un type personnalisé
        'posts_per_page' => 2, // Limiter à 2 résultats
        'cat'            => $current_category_id, // Utilisez l'ID de la catégorie courante
        'post__not_in'   => [get_the_ID()], // Exclure l'article actuel (facultatif)
    ];

    $query = new WP_Query($args);

// Vérifiez si la requête retourne des résultats
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
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
            }
            ?>
            
        </a>
        <?php
    }
    wp_reset_postdata(); // Réinitialisez les données globales après la boucle personnalisée
} else {
    echo '<p>Aucun article apparenté trouvé.</p>';
}
?>
</div>

<?php
get_footer();
?>
