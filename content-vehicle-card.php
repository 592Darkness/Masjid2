<?php
/**
 * Template part for displaying vehicle cards
 *
 * @package Guyana_Auto_Dealer
 */

// Get vehicle meta data
$price = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'price');
$sale_price = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'sale_price');
$mileage = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'mileage');
$transmission = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'transmission');
$fuel_type = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'fuel_type');

// Get taxonomies
$make_terms = get_the_terms(get_the_ID(), 'vehicle_make');
$model_terms = get_the_terms(get_the_ID(), 'vehicle_model');
$year_terms = get_the_terms(get_the_ID(), 'vehicle_year');
$type_terms = get_the_terms(get_the_ID(), 'vehicle_type');

$make = !empty($make_terms) ? $make_terms[0]->name : '';
$model = !empty($model_terms) ? $model_terms[0]->name : '';
$year = !empty($year_terms) ? $year_terms[0]->name : '';
$type = !empty($type_terms) ? $type_terms[0]->slug : '';

// Check if vehicle is featured
$featured = guyana_auto_dealer_is_vehicle_featured(get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vehicle-card'); ?>>
    <div class="vehicle-image">
        <?php if ($type) : ?>
            <div class="vehicle-status <?php echo esc_attr($type); ?>">
                <?php echo esc_html(ucfirst($type)); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($featured) : ?>
            <div class="vehicle-featured">
                <i class="fas fa-star"></i>
            </div>
        <?php endif; ?>
        
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('vehicle-thumbnail');
        } else {
            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/no-image.jpg') . '" alt="' . esc_attr__('No Image', 'guyana-auto-dealer') . '">';
        }
        ?>
        
        <?php if ($price) : ?>
            <div class="vehicle-price">
                <?php
                if ($sale_price) {
                    echo '<span class="old-price">' . guyana_auto_dealer_format_price($price) . '</span> ';
                    echo guyana_auto_dealer_format_price($sale_price);
                } else {
                    echo guyana_auto_dealer_format_price($price);
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="vehicle-content">
        <h3 class="vehicle-title">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html($year . ' ' . $make . ' ' . $model); ?></a>
        </h3>
        
        <div class="vehicle-meta">
            <?php if ($mileage) : ?>
                <div class="vehicle-meta-item">
                    <i class="fas fa-tachometer-alt"></i> <?php echo esc_html($mileage); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($transmission) : ?>
                <div class="vehicle-meta-item">
                    <i class="fas fa-cog"></i> <?php echo esc_html(ucfirst($transmission)); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($fuel_type) : ?>
                <div class="vehicle-meta-item">
                    <i class="fas fa-gas-pump"></i> <?php echo esc_html(ucfirst($fuel_type)); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="vehicle-actions">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-small"><?php esc_html_e('View Details', 'guyana-auto-dealer'); ?></a>
            
            <?php
            $phone = get_theme_mod('contact_phone', '+592 123 4567');
            if ($phone) {
                echo '<a href="tel:' . esc_attr(preg_replace('/[^0-9+]/', '', $phone)) . '" class="btn btn-outline btn-small"><i class="fas fa-phone-alt"></i></a>';
            }
            ?>
        </div>
    </div>
</article>
