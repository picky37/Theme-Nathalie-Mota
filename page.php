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

<?php get_footer(); ?>
