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

               
                
echo ' <a href="' . get_permalink() . '" class="lightbox" title="">';

                echo the_content(); // the_content() affiche le contenu de l'article

                echo '</a>';
               
                
            


                ?>

            </a>

    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>



</div>