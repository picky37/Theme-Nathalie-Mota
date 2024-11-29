<div class="photos-apparentees">

    <?php
    // Requête pour afficher des articles similaires
    $related_args = array(
        'post_type' => 'Photo', // Utilisez le type de post approprié
        'posts_per_page' => $number_of_photos,
        'orderby' => $myOrderby,
    );
    $related_query = new WP_Query($related_args);

    if ($related_query->have_posts()) :
        while ($related_query->have_posts()) : $related_query->the_post();
    ?>
           
                <a class="accueil" href="<?php the_permalink(); ?>" class="photo-link">
                    <!-- <img src="wp-content\themes\Theme-Nathalie-Mota\images\regard.svg" alt="Logo" class="regard"> -->
            
            <?php
            // Afficher l'image mise en avant ou le contenu si aucune mise en avant
            if (has_post_thumbnail()) {

                echo '<div class="lightbox">
                <button class="lightbox__close">Fermer</button>
                <button class="lightbox__next">Suivant</button>
                <button class="lightbox__prev">Précédent</button>
                <div class="lightbox__container">';
                the_post_thumbnail('large', ['class' => 'photo-apparentee']);
                echo'</div>';
              echo'</div>';

            } else {

                echo '<div class="lightbox">
                <button class="lightbox__close">Fermer</button>
                <button class="lightbox__next">Suivant</button>
                <button class="lightbox__prev">Précédent</button>
                <div class="lightbox__container">';
                echo '<div class="article-content">';
                echo the_content(); // the_content() affiche le contenu de l'article
                echo '</div>';
                echo'</div>';
              echo'</div>';
                // Afficher le contenu de l'article si aucune image mise en avant
                
            } ?>

    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>