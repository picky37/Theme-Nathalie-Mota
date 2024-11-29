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
        } ?>

    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>

  </div>
  <?php include 'wp-content\themes\Theme-Nathalie-Mota\template_parts\modale_contact.php'; ?>

  
    <?php

    $number_of_photos = 8;
    $myOrderby = "none";

    include 'wp-content\themes\Theme-Nathalie-Mota\template_parts\photo_block.php';

    var_dump($number_of_photos);

    ?>




</main>
<?php get_footer(); ?>