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