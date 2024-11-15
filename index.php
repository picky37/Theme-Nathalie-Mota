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
  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius eaque earum delectus, est dolorem aliquam beatae iste quibusdam, esse tempora deserunt amet ora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quoora deserunt amet voluptatibus soluta. Sed neque modi facere quo voluptatibus soluta. Sed neque modi facere quo quibusdam?</p>
  <?php include 'wp-content\themes\Theme-Nathalie-Mota\template_parts\modale_contact.php'; ?>


  <div class="photos-apparentees accueil">

    <?php
    // Requête pour afficher des articles similaires
    $related_args = array(
      'post_type' => 'Photo', // Utilisez le type de post approprié
      'posts_per_page' => 8,
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




</main>
<?php get_footer(); ?>