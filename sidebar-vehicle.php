<?php
/**
 * The sidebar containing the vehicle widget area
 *
 * @package Guyana_Auto_Dealer
 */

if (!is_active_sidebar('vehicle-sidebar')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('vehicle-sidebar'); ?>
    
    <?php
    // If it's a single vehicle page, add a contact form widget
    if (is_singular('vehicle')) :
        $phone = get_theme_mod('contact_phone', '+592 123 4567');
        ?>
        <div class="widget contact-info-widget">
            <h2 class="widget-title"><?php esc_html_e('Need More Information?', 'guyana-auto-dealer'); ?></h2>
            
            <div class="contact-info">
                <?php if ($phone) : ?>
                    <div class="contact-phone">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                    </div>
                <?php endif; ?>
                
                <button type="button" class="btn btn-primary btn-large btn-block inquiry-trigger">
                    <i class="fas fa-envelope"></i> <?php esc_html_e('Send Inquiry', 'guyana-auto-dealer'); ?>
                </button>
            </div>
        </div>
        
        <?php
        // Get related vehicles based on make
        $make_terms = get_the_terms(get_the_ID(), 'vehicle_make');
        
        if (!empty($make_terms) && !is_wp_error($make_terms)) :
            $make_id = $make_terms[0]->term_id;
            
            $args = array(
                'post_type' => 'vehicle',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'vehicle_make',
                        'field' => 'term_id',
                        'terms' => $make_id,
                    ),
                ),
            );
            
            $query = new WP_Query($args);
            
            if ($query->have_posts()) :
                ?>
                <div class="widget widget-similar-vehicles">
                    <h2 class="widget-title"><?php esc_html_e('Similar Vehicles', 'guyana-auto-dealer'); ?></h2>
                    
                    <div class="widget-vehicles">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="widget-vehicle">
                                <a href="<?php the_permalink(); ?>" class="widget-vehicle-image">
                                    <?php 
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('thumbnail');
                                    } else {
                                        echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/no-image.jpg') . '" alt="' . esc_attr__('No Image', 'guyana-auto-dealer') . '">';
                                    }
                                    ?>
                                </a>
                                <div class="widget-vehicle-content">
                                    <h3 class="widget-vehicle-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <?php
                                    $price = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'price');
                                    if ($price) :
                                        ?>
                                        <div class="widget-vehicle-price">
                                            <?php echo guyana_auto_dealer_format_price($price); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php
            endif;
        endif;
    endif;
    ?>
</aside><!-- #secondary -->
