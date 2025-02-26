<?php get_header(); ?>

<main>
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post(); ?>
            <h1><?php the_title(); ?></h1> <!-- Affiche le titre de la page -->
            <div>
                <?php the_content(); ?> <!-- Affiche le contenu ajouté avec le Block Editor -->
            </div>
    <?php endwhile;
    endif;
    ?>
</main>
<?php include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/modale_contact.php'; ?>
<?php get_footer(); ?>