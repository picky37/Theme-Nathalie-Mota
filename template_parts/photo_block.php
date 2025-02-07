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
                <div class="post-info">
                    <?php
                    // Récupérer la référence
                    $reference = get_post_meta(get_the_ID(), 'Reference', true);
                    if (!empty($reference)) {
                        echo '<p>' . esc_html($reference) . '</p>';
                    }
                    // Récupérer les catégories
                    $terms = get_the_terms(get_the_ID(), 'categorie');
                    if ($terms && !is_wp_error($terms)) {
                        $categories = wp_list_pluck($terms, 'name');
                        echo '<p>' . esc_html(implode(', ', $categories)) . '</p>';
                    }
                    ?>
                </div>
            </a>
            


            <!-- Div avec les attributs data-* -->
            <div 
                class="post-data" 
                data-reference="<?php echo esc_attr($reference); ?>" 
                data-category="<?php echo esc_attr(implode(', ', $categories ?? [])); ?>"
                data-date="<?php echo esc_attr(get_the_date('Y-m-d H:i:s')); ?>">
                
            </div>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
