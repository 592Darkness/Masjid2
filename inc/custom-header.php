<?php
/**
 * Custom Header features
 *
 * @package Guyana_Auto_Dealer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Set up the WordPress core custom header feature.
 */
function guyana_auto_dealer_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('guyana_auto_dealer_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => '000000',
        'width'                  => 1000,
        'height'                 => 250,
        'flex-height'            => true,
        'wp-head-callback'       => 'guyana_auto_dealer_header_style',
    )));
}
add_action('after_setup_theme', 'guyana_auto_dealer_custom_header_setup');

/**
 * Styles the header image and text displayed on the blog.
 */
function guyana_auto_dealer_header_style() {
    $header_text_color = get_header_textcolor();

    // If no custom options for text are set, let's bail
    if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
        return;
    }

    // If we get this far, we have custom styles
    ?>
    <style type="text/css">
    <?php
    // Has the text been hidden?
    if (!display_header_text()) :
        ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
    // If the user has set a custom color for the text, use that
    else :
        ?>
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr($header_text_color); ?>;
        }
    <?php endif; ?>
    </style>
    <?php
}