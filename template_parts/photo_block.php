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

        <a class="accueil" class="photo-link">
            <!-- <img src="wp-content\themes\Theme-Nathalie-Mota\images\regard.svg" alt="Logo" class="regard"> -->

            <?php
            // Afficher l'image mise en avant ou le contenu si aucune mise en avant
            if (has_post_thumbnail()) {
                the_post_thumbnail('large', ['class' => 'photo-apparentee']);
            } else {
                // Afficher le contenu de l'article si aucune image mise en avant
                echo '<div class="lightbox">
  <button class="lightbox__close">Fermer</button>
  <button class="lightbox__next">Suivant</button>
  <button class="lightbox__prev">Précédent</button>
  <div class="lightbox__container">';
    echo '<a href="' . get_permalink() . '">';

  
  echo the_content(); // the_content() affiche le contenu de l'article

echo'</a>';
 echo '</div>';
echo '</div>';
                
                
            } 
            ?>

        </a>

    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>

</div>
