<?php
/**
 * Theme Options and Customizer Settings
 *
 * @package Guyana_Auto_Dealer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register theme customizer settings
 */
function guyana_auto_dealer_theme_options_customize_register($wp_customize) {
    
    // Site Identity section already exists, so we'll just add to it
    
    // Header Logo
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
        'label' => __('Header Logo', 'guyana-auto-dealer'),
        'description' => __('Upload a logo to be displayed in the header. Recommended size: 200x60px', 'guyana-auto-dealer'),
        'section' => 'title_tagline',
        'settings' => 'header_logo',
        'priority' => 20,
    )));
    
    // Footer Logo
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'guyana-auto-dealer'),
        'description' => __('Upload a logo to be displayed in the footer. Recommended size: 150x45px', 'guyana-auto-dealer'),
        'section' => 'title_tagline',
        'settings' => 'footer_logo',
        'priority' => 30,
    )));
    
    // Add General Settings section
    $wp_customize->add_section('general_settings', array(
        'title' => __('General Settings', 'guyana-auto-dealer'),
        'priority' => 30,
    ));
    
    // Favicon
    $wp_customize->add_setting('favicon', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'favicon', array(
        'label' => __('Favicon', 'guyana-auto-dealer'),
        'description' => __('Upload a favicon for your site. Recommended size: 32x32px', 'guyana-auto-dealer'),
        'section' => 'general_settings',
        'settings' => 'favicon',
    )));
    
    // Add Contact Information section
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'guyana-auto-dealer'),
        'priority' => 40,
    ));
    
    // Phone
    $wp_customize->add_setting('contact_phone', array(
        'default' => '+592 123 4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label' => __('Phone Number', 'guyana-auto-dealer'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@guyanaauto.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => __('Email Address', 'guyana-auto-dealer'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Address
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Georgetown, Guyana',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => __('Address', 'guyana-auto-dealer'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Business Hours
    $wp_customize->add_setting('contact_hours', array(
        'default' => 'Mon - Fri: 8:00 - 17:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_hours', array(
        'label' => __('Business Hours', 'guyana-auto-dealer'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Add Social Media section
    $wp_customize->add_section('social_media', array(
        'title' => __('Social Media', 'guyana-auto-dealer'),
        'priority' => 50,
    ));
    
    // Facebook
    $wp_customize->add_setting('social_facebook', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_facebook', array(
        'label' => __('Facebook URL', 'guyana-auto-dealer'),
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // Twitter
    $wp_customize->add_setting('social_twitter', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_twitter', array(
        'label' => __('Twitter URL', 'guyana-auto-dealer'),
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('social_instagram', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_instagram', array(
        'label' => __('Instagram URL', 'guyana-auto-dealer'),
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('social_linkedin', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_linkedin', array(
        'label' => __('LinkedIn URL', 'guyana-auto-dealer'),
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('social_youtube', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_youtube', array(
        'label' => __('YouTube URL', 'guyana-auto-dealer'),
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // Add Homepage Settings section
    $wp_customize->add_section('homepage_settings', array(
        'title' => __('Homepage Settings', 'guyana-auto-dealer'),
        'priority' => 60,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default' => __('Find Your Perfect Vehicle', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => __('Guyana\'s Premier Auto Dealer', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Hero Image
    $wp_customize->add_setting('hero_image', array(
        'default' => get_template_directory_uri() . '/assets/images/hero-banner.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => __('Hero Banner Image', 'guyana-auto-dealer'),
        'description' => __('Upload an image for the hero banner. Recommended size: 1920x600px', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'settings' => 'hero_image',
    )));
    
    // Featured Vehicles Title
    $wp_customize->add_setting('featured_vehicles_title', array(
        'default' => __('Featured Vehicles', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('featured_vehicles_title', array(
        'label' => __('Featured Vehicles Title', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Featured Vehicles Subtitle
    $wp_customize->add_setting('featured_vehicles_subtitle', array(
        'default' => __('Explore our premium selection of quality vehicles', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('featured_vehicles_subtitle', array(
        'label' => __('Featured Vehicles Subtitle', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Featured Vehicles Count
    $wp_customize->add_setting('featured_vehicles_count', array(
        'default' => 6,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('featured_vehicles_count', array(
        'label' => __('Number of Featured Vehicles', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
            'step' => 3,
        ),
    ));
    
    // Featured Parts Title
    $wp_customize->add_setting('featured_parts_title', array(
        'default' => __('Featured Auto Parts', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('featured_parts_title', array(
        'label' => __('Featured Auto Parts Title', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Featured Parts Subtitle
    $wp_customize->add_setting('featured_parts_subtitle', array(
        'default' => __('Quality parts for your vehicle maintenance needs', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('featured_parts_subtitle', array(
        'label' => __('Featured Auto Parts Subtitle', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // Featured Parts Count
    $wp_customize->add_setting('featured_parts_count', array(
        'default' => 4,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('featured_parts_count', array(
        'label' => __('Number of Featured Auto Parts', 'guyana-auto-dealer'),
        'section' => 'homepage_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 4,
            'max' => 12,
            'step' => 4,
        ),
    ));
    
    // Add Footer Settings section
    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer Settings', 'guyana-auto-dealer'),
        'priority' => 70,
    ));
    
    // Footer About Text
    $wp_customize->add_setting('footer_about', array(
        'default' => __('Guyana Auto Dealer is your trusted source for quality vehicles and auto parts in Guyana. We offer a wide selection of new and used cars, trucks, SUVs, and genuine auto parts.', 'guyana-auto-dealer'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('footer_about', array(
        'label' => __('Footer About Text', 'guyana-auto-dealer'),
        'section' => 'footer_settings',
        'type' => 'textarea',
    ));
    
    // Footer Copyright
    $wp_customize->add_setting('footer_copyright', array(
        'default' => sprintf(esc_html__('© %s Guyana Auto Dealer. All Rights Reserved.', 'guyana-auto-dealer'), date('Y')),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_copyright', array(
        'label' => __('Footer Copyright Text', 'guyana-auto-dealer'),
        'section' => 'footer_settings',
        'type' => 'text',
    ));
    
    // Add Color Settings section
    $wp_customize->add_section('color_settings', array(
        'title' => __('Color Settings', 'guyana-auto-dealer'),
        'priority' => 80,
    ));
    
    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#009E60',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'guyana-auto-dealer'),
        'section' => 'color_settings',
        'settings' => 'primary_color',
    )));
    
    // Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#FCD116',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color', 'guyana-auto-dealer'),
        'section' => 'color_settings',
        'settings' => 'secondary_color',
    )));
    
    // Accent Color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#CE1126',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => __('Accent Color', 'guyana-auto-dealer'),
        'section' => 'color_settings',
        'settings' => 'accent_color',
    )));
    
    // Text Color
    $wp_customize->add_setting('text_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'label' => __('Text Color', 'guyana-auto-dealer'),
        'section' => 'color_settings',
        'settings' => 'text_color',
    )));
    
    // Add SEO Settings section
    $wp_customize->add_section('seo_settings', array(
        'title' => __('SEO Settings', 'guyana-auto-dealer'),
        'priority' => 90,
    ));
    
    // Header Meta Tags
    $wp_customize->add_setting('header_meta_tags', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('header_meta_tags', array(
        'label' => __('Header Meta Tags', 'guyana-auto-dealer'),
        'description' => __('Add custom meta tags to be included in the header. Example: Google Analytics, Verification tags, etc.', 'guyana-auto-dealer'),
        'section' => 'seo_settings',
        'type' => 'textarea',
    ));
    
    // Add Custom Scripts section
    $wp_customize->add_section('custom_scripts', array(
        'title' => __('Custom Scripts', 'guyana-auto-dealer'),
        'priority' => 100,
    ));
    
    // Header Scripts
    $wp_customize->add_setting('header_scripts', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('header_scripts', array(
        'label' => __('Header Scripts', 'guyana-auto-dealer'),
        'description' => __('Add custom scripts to be included in the header. Will be placed before the closing head tag.', 'guyana-auto-dealer'),
        'section' => 'custom_scripts',
        'type' => 'textarea',
    ));
    
    // Footer Scripts
    $wp_customize->add_setting('footer_scripts', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('footer_scripts', array(
        'label' => __('Footer Scripts', 'guyana-auto-dealer'),
        'description' => __('Add custom scripts to be included in the footer. Will be placed before the closing body tag.', 'guyana-auto-dealer'),
        'section' => 'custom_scripts',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'guyana_auto_dealer_theme_options_customize_register');

/**
 * Generate custom CSS from theme options
 */
function guyana_auto_dealer_custom_css() {
    $primary_color = get_theme_mod('primary_color', '#009E60');
    $secondary_color = get_theme_mod('secondary_color', '#FCD116');
    $accent_color = get_theme_mod('accent_color', '#CE1126');
    $text_color = get_theme_mod('text_color', '#333333');
    
    $custom_css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
            --accent-color: {$accent_color};
            --text-color: {$text_color};
        }
    ";
    
    wp_add_inline_style('guyana-auto-dealer-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'guyana_auto_dealer_custom_css');

/**
 * Add custom meta tags to header
 */
function guyana_auto_dealer_custom_meta_tags() {
    $meta_tags = get_theme_mod('header_meta_tags', '');
    
    if (!empty($meta_tags)) {
        echo $meta_tags; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action('wp_head', 'guyana_auto_dealer_custom_meta_tags');

/**
 * Add custom scripts to header
 */
function guyana_auto_dealer_custom_header_scripts() {
    $header_scripts = get_theme_mod('header_scripts', '');
    
    if (!empty($header_scripts)) {
        echo $header_scripts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action('wp_head', 'guyana_auto_dealer_custom_header_scripts');

/**
 * Add custom scripts to footer
 */
function guyana_auto_dealer_custom_footer_scripts() {
    $footer_scripts = get_theme_mod('footer_scripts', '');
    
    if (!empty($footer_scripts)) {
        echo $footer_scripts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action('wp_footer', 'guyana_auto_dealer_custom_footer_scripts');

/**
 * Load custom JS variables for AJAX
 */
function guyana_auto_dealer_enqueue_scripts() {
    $js_vars = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('guyana_auto_dealer_nonce'),
        'is_vehicle_archive' => is_post_type_archive('vehicle') || is_tax(array('vehicle_make', 'vehicle_model', 'vehicle_year', 'vehicle_type', 'vehicle_body')),
        'all_models_text' => __('All Models', 'guyana-auto-dealer'),
        'ajax_error_text' => __('There was an error processing your request. Please try again.', 'guyana-auto-dealer'),
    );
    
    wp_localize_script('guyana-auto-dealer-navigation', 'guyana_auto_dealer_vars', $js_vars);
}
add_action('wp_enqueue_scripts', 'guyana_auto_dealer_enqueue_scripts');

/**
 * AJAX handler for getting models by make
 */
function guyana_auto_dealer_get_models_by_make() {
    check_ajax_referer('guyana_auto_dealer_nonce', 'nonce');
    
    $make_slug = isset($_POST['make']) ? sanitize_text_field($_POST['make']) : '';
    
    if (empty($make_slug)) {
        wp_send_json_error(__('Make is required', 'guyana-auto-dealer'));
    }
    
    $models = get_terms(array(
        'taxonomy' => 'vehicle_model',
        'hide_empty' => true,
        'meta_query' => array(
            array(
                'key' => 'vehicle_make',
                'value' => $make_slug,
                'compare' => '=',
            ),
        ),
    ));
    
    if (empty($models) || is_wp_error($models)) {
        wp_send_json_error(__('No models found for this make', 'guyana-auto-dealer'));
    }
    
    $models_data = array();
    
    foreach ($models as $model) {
        $models_data[] = array(
            'id' => $model->term_id,
            'name' => $model->name,
            'slug' => $model->slug,
        );
    }
    
    wp_send_json_success($models_data);
}
add_action('wp_ajax_get_models_by_make', 'guyana_auto_dealer_get_models_by_make');
add_action('wp_ajax_nopriv_get_models_by_make', 'guyana_auto_dealer_get_models_by_make');
