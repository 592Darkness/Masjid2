<?php
/**
 * Custom search form
 *
 * @package Guyana_Auto_Dealer
 */

$unique_id = wp_unique_id('search-form-');
$search_placeholder = esc_attr__('Search...', 'guyana-auto-dealer');

// Are we on a vehicle page?
if (is_post_type_archive('vehicle') || is_tax(array('vehicle_make', 'vehicle_model', 'vehicle_year', 'vehicle_type', 'vehicle_body'))) {
    $search_placeholder = esc_attr__('Search vehicles...', 'guyana-auto-dealer');
}

// Are we on a shop page?
if (function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag())) {
    $search_placeholder = esc_attr__('Search products...', 'guyana-auto-dealer');
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-field-wrapper">
        <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text"><?php echo esc_html_e('Search for:', 'guyana-auto-dealer'); ?></label>
        <input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo $search_placeholder; ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
    </div>
    
    <?php
    // Add specific post type if we're on a specific area
    if (is_post_type_archive('vehicle') || is_tax(array('vehicle_make', 'vehicle_model', 'vehicle_year', 'vehicle_type', 'vehicle_body'))) {
        echo '<input type="hidden" name="post_type" value="vehicle" />';
    } elseif (function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag())) {
        echo '<input type="hidden" name="post_type" value="product" />';
    }
    ?>
</form>
