<?php
/**
 * Guyana Auto Dealer Theme Customizer
 *
 * @package Guyana_Auto_Dealer
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function guyana_auto_dealer_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'guyana_auto_dealer_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'guyana_auto_dealer_customize_partial_blogdescription',
        ));
    }

    // Add Theme Options Section
    $wp_customize->add_section('theme_options', array(
        'title'    => __('Theme Options', 'guyana-auto-dealer'),
        'priority' => 130,
    ));

    // Add Footer Copyright Setting
    $wp_customize->add_setting('footer_copyright', array(
        'default'           => sprintf(__('© %s Guyana Auto Dealer. All Rights Reserved.', 'guyana-auto-dealer'), date('Y')),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label'    => __('Footer Copyright Text', 'guyana-auto-dealer'),
        'section'  => 'theme_options',
        'type'     => 'text',
    ));

    // Add Contact Information Section
    $wp_customize->add_section('contact_info', array(
        'title'    => __('Contact Information', 'guyana-auto-dealer'),
        'priority' => 140,
    ));

    // Add Phone Number Setting
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+592 123 4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Phone Number', 'guyana-auto-dealer'),
        'section'  => 'contact_info',
        'type'     => 'text',
    ));

    // Add Email Setting
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'info@guyanaauto.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'    => __('Email Address', 'guyana-auto-dealer'),
        'section'  => 'contact_info',
        'type'     => 'text',
    ));

    // Add Address Setting
    $wp_customize->add_setting('contact_address', array(
        'default'           => 'Georgetown, Guyana',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label'    => __('Address', 'guyana-auto-dealer'),
        'section'  => 'contact_info',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'guyana_auto_dealer_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function guyana_auto_dealer_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function guyana_auto_dealer_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function guyana_auto_dealer_customize_preview_js() {
    wp_enqueue_script('guyana-auto-dealer-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'guyana_auto_dealer_customize_preview_js');