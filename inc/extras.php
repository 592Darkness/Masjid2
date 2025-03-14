<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Guyana_Auto_Dealer
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function guyana_auto_dealer_body_classes_extra($classes) {
    // Add class if is front page
    if (is_front_page() && !is_home()) {
        $classes[] = 'front-page';
    }
    
    // Add class if is WooCommerce page
    if (class_exists('WooCommerce')) {
        if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
            $classes[] = 'woocommerce-page';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'guyana_auto_dealer_body_classes_extra');

/**
 * Add a custom image size for vehicle thumbnails
 */
function guyana_auto_dealer_add_image_sizes() {
    add_image_size('vehicle-thumb', 370, 250, true);
    add_image_size('vehicle-large', 800, 600, true);
}
add_action('after_setup_theme', 'guyana_auto_dealer_add_image_sizes');

/**
 * Register Sidebar Widgets
 */
function guyana_auto_dealer_widgets_extra() {
    register_sidebar(array(
        'name'          => esc_html__('Home Widgets', 'guyana-auto-dealer'),
        'id'            => 'home-widgets',
        'description'   => esc_html__('Add widgets here to appear on home page.', 'guyana-auto-dealer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'guyana_auto_dealer_widgets_extra');

/**
 * Modify the archive title
 */
function guyana_auto_dealer_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    
    return $title;
}
add_filter('get_the_archive_title', 'guyana_auto_dealer_archive_title');

/**
 * Filter the except length
 */
function guyana_auto_dealer_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'guyana_auto_dealer_custom_excerpt_length', 999);

/**
 * Filter the excerpt "read more" string
 */
function guyana_auto_dealer_extras_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'guyana_auto_dealer_extras_excerpt_more');

/**
 * Add custom query vars
 */
function guyana_auto_dealer_custom_query_vars($vars) {
    $vars[] = 'vehicle_make';
    $vars[] = 'vehicle_model';
    $vars[] = 'vehicle_year';
    $vars[] = 'price_min';
    $vars[] = 'price_max';
    return $vars;
}
add_filter('query_vars', 'guyana_auto_dealer_custom_query_vars');