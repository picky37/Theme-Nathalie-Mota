<?php
get_header();
?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>

        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>

    <?php
    endwhile;
else :
    ?>

    <p>Aucun contenu disponible.</p>

<?php
endif;
?>

<?php
get_footer();
?>
