<div id="related-photos" class="photos-apparentees">
    <?php
    $related_args = array(
        'post_type'      => 'Photo',
        'posts_per_page' => $number_of_photos,
        'orderby'        => $myOrderby,
    );
    $related_query = new WP_Query($related_args);

    if ($related_query->have_posts()) :
        while ($related_query->have_posts()) : $related_query->the_post();
            // Récupérer l'image mise en avant
            $full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
            <a href="<?php echo esc_url($full_image_url); ?>" class="lightbox" data-post-link="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url($full_image_url); ?>" alt="<?php the_title_attribute(); ?>">
            </a>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
