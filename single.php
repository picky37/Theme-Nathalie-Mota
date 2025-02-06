<?php
get_header();
?>

<?php include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/modale_contact.php'; ?>

<div class="single-post-container">

    <div class="post-header">

        <div class="post-details">

            <h1 class="post-title"><?php the_title(); ?></h1>

            <p class="post-reference">Référence : <?php echo esc_html(get_post_meta(get_the_ID(), 'Reference', true)); ?></p>

            <?php $reference = esc_attr(get_post_meta(get_the_ID(), 'Reference', true)); ?>

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

            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => get_the_title())); ?>

        </div>

    </div>

    <div class="post-contact">

        <p>Cette photo vous intéresse ?</p>

        <li id="menu-item-x"><a href="#modale" id="contact-button">Contact</a></li>

    </div>

<div class="traitNoir"></div>

    <div class="post-related">

        <h3>Vous aimerez aussi</h3>

        <?php 
        $number_of_photos = 2;
        $myOrderby = "rand";
        include 'wp-content/themes/Theme-Nathalie-Mota/template_parts/photo_block.php'; 
        ?>
    </div>
</div>

<?php
get_footer();
?>
