<?php
/**
 * Functions which enhance the theme by hooking into WordPress
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
function guyana_auto_dealer_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add class if WooCommerce is active
    if (class_exists('WooCommerce')) {
        $classes[] = 'woocommerce-active';
    }

    return $classes;
}
add_filter('body_class', 'guyana_auto_dealer_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function guyana_auto_dealer_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'guyana_auto_dealer_pingback_header');

/**
 * Modify the "read more" excerpt string.
 */
function guyana_auto_dealer_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'guyana_auto_dealer_excerpt_more');

/**
 * Set excerpt length.
 */
function guyana_auto_dealer_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'guyana_auto_dealer_excerpt_length');

/**
 * Add custom meta tags to the header.
 */
function guyana_auto_dealer_meta_tags() {
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php
}
add_action('wp_head', 'guyana_auto_dealer_meta_tags', 1);