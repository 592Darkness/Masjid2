<?php
/**
 * Custom Post Types for Guyana Auto Dealer
 *
 * @package Guyana_Auto_Dealer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom post types
 */
function guyana_auto_dealer_register_post_types() {
    // Vehicle Custom Post Type
    $labels = array(
        'name'                  => _x('Vehicles', 'Post type general name', 'guyana-auto-dealer'),
        'singular_name'         => _x('Vehicle', 'Post type singular name', 'guyana-auto-dealer'),
        'menu_name'             => _x('Vehicles', 'Admin Menu text', 'guyana-auto-dealer'),
        'name_admin_bar'        => _x('Vehicle', 'Add New on Toolbar', 'guyana-auto-dealer'),
        'add_new'               => __('Add New', 'guyana-auto-dealer'),
        'add_new_item'          => __('Add New Vehicle', 'guyana-auto-dealer'),
        'new_item'              => __('New Vehicle', 'guyana-auto-dealer'),
        'edit_item'             => __('Edit Vehicle', 'guyana-auto-dealer'),
        'view_item'             => __('View Vehicle', 'guyana-auto-dealer'),
        'all_items'             => __('All Vehicles', 'guyana-auto-dealer'),
        'search_items'          => __('Search Vehicles', 'guyana-auto-dealer'),
        'parent_item_colon'     => __('Parent Vehicles:', 'guyana-auto-dealer'),
        'not_found'             => __('No vehicles found.', 'guyana-auto-dealer'),
        'not_found_in_trash'    => __('No vehicles found in Trash.', 'guyana-auto-dealer'),
        'featured_image'        => _x('Vehicle Image', 'Overrides the "Featured Image" phrase', 'guyana-auto-dealer'),
        'set_featured_image'    => _x('Set vehicle image', 'Overrides the "Set featured image" phrase', 'guyana-auto-dealer'),
        'remove_featured_image' => _x('Remove vehicle image', 'Overrides the "Remove featured image" phrase', 'guyana-auto-dealer'),
        'use_featured_image'    => _x('Use as vehicle image', 'Overrides the "Use as featured image" phrase', 'guyana-auto-dealer'),
        'archives'              => _x('Vehicle archives', 'The post type archive label used in nav menus', 'guyana-auto-dealer'),
        'insert_into_item'      => _x('Insert into vehicle', 'Overrides the "Insert into post" phrase', 'guyana-auto-dealer'),
        'uploaded_to_this_item' => _x('Uploaded to this vehicle', 'Overrides the "Uploaded to this post" phrase', 'guyana-auto-dealer'),
        'filter_items_list'     => _x('Filter vehicles list', 'Screen reader text for the filter links heading on the post type listing screen', 'guyana-auto-dealer'),
        'items_list_navigation' => _x('Vehicles list navigation', 'Screen reader text for the pagination heading on the post type listing screen', 'guyana-auto-dealer'),
        'items_list'            => _x('Vehicles list', 'Screen reader text for the items list heading on the post type listing screen', 'guyana-auto-dealer'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'vehicle'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-car',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('vehicle', $args);

    // Register Vehicle Make taxonomy
    $make_labels = array(
        'name'                       => _x('Makes', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Make', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Makes', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Makes', 'guyana-auto-dealer'),
        'all_items'                  => __('All Makes', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Make', 'guyana-auto-dealer'),
        'update_item'                => __('Update Make', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Make', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Make Name', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate makes with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove makes', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used makes', 'guyana-auto-dealer'),
        'not_found'                  => __('No makes found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Makes', 'guyana-auto-dealer'),
    );

    $make_args = array(
        'hierarchical'      => true,
        'labels'            => $make_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-make'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_make', 'vehicle', $make_args);

    // Register Vehicle Model taxonomy
    $model_labels = array(
        'name'                       => _x('Models', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Model', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Models', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Models', 'guyana-auto-dealer'),
        'all_items'                  => __('All Models', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Model', 'guyana-auto-dealer'),
        'update_item'                => __('Update Model', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Model', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Model Name', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate models with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove models', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used models', 'guyana-auto-dealer'),
        'not_found'                  => __('No models found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Models', 'guyana-auto-dealer'),
    );

    $model_args = array(
        'hierarchical'      => true,
        'labels'            => $model_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-model'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_model', 'vehicle', $model_args);

    // Register Vehicle Year taxonomy
    $year_labels = array(
        'name'                       => _x('Years', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Year', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Years', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Years', 'guyana-auto-dealer'),
        'all_items'                  => __('All Years', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Year', 'guyana-auto-dealer'),
        'update_item'                => __('Update Year', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Year', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Year', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate years with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove years', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used years', 'guyana-auto-dealer'),
        'not_found'                  => __('No years found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Years', 'guyana-auto-dealer'),
    );

    $year_args = array(
        'hierarchical'      => false,
        'labels'            => $year_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-year'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_year', 'vehicle', $year_args);

    // Register Vehicle Type taxonomy (new/used)
    $type_labels = array(
        'name'                       => _x('Types', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Type', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Types', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Types', 'guyana-auto-dealer'),
        'all_items'                  => __('All Types', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Type', 'guyana-auto-dealer'),
        'update_item'                => __('Update Type', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Type', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Type Name', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate types with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove types', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used types', 'guyana-auto-dealer'),
        'not_found'                  => __('No types found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Types', 'guyana-auto-dealer'),
    );

    $type_args = array(
        'hierarchical'      => true,
        'labels'            => $type_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-type'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_type', 'vehicle', $type_args);

    // Register Vehicle Body Style taxonomy
    $body_labels = array(
        'name'                       => _x('Body Styles', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Body Style', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Body Styles', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Body Styles', 'guyana-auto-dealer'),
        'all_items'                  => __('All Body Styles', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Body Style', 'guyana-auto-dealer'),
        'update_item'                => __('Update Body Style', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Body Style', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Body Style Name', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate body styles with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove body styles', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used body styles', 'guyana-auto-dealer'),
        'not_found'                  => __('No body styles found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Body Styles', 'guyana-auto-dealer'),
    );

    $body_args = array(
        'hierarchical'      => true,
        'labels'            => $body_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-body'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_body', 'vehicle', $body_args);

    // Register Vehicle Feature taxonomy
    $feature_labels = array(
        'name'                       => _x('Features', 'taxonomy general name', 'guyana-auto-dealer'),
        'singular_name'              => _x('Feature', 'taxonomy singular name', 'guyana-auto-dealer'),
        'search_items'               => __('Search Features', 'guyana-auto-dealer'),
        'popular_items'              => __('Popular Features', 'guyana-auto-dealer'),
        'all_items'                  => __('All Features', 'guyana-auto-dealer'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Feature', 'guyana-auto-dealer'),
        'update_item'                => __('Update Feature', 'guyana-auto-dealer'),
        'add_new_item'               => __('Add New Feature', 'guyana-auto-dealer'),
        'new_item_name'              => __('New Feature Name', 'guyana-auto-dealer'),
        'separate_items_with_commas' => __('Separate features with commas', 'guyana-auto-dealer'),
        'add_or_remove_items'        => __('Add or remove features', 'guyana-auto-dealer'),
        'choose_from_most_used'      => __('Choose from the most used features', 'guyana-auto-dealer'),
        'not_found'                  => __('No features found.', 'guyana-auto-dealer'),
        'menu_name'                  => __('Features', 'guyana-auto-dealer'),
    );

    $feature_args = array(
        'hierarchical'      => false,
        'labels'            => $feature_labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'vehicle-feature'),
        'show_in_rest'      => true,
    );

    register_taxonomy('vehicle_feature', 'vehicle', $feature_args);
}
add_action('init', 'guyana_auto_dealer_register_post_types');

/**
 * Add custom meta boxes for vehicles
 */
function guyana_auto_dealer_add_meta_boxes() {
    add_meta_box(
        'vehicle_details',
        __('Vehicle Details', 'guyana-auto-dealer'),
        'guyana_auto_dealer_vehicle_details_callback',
        'vehicle',
        'normal',
        'high'
    );

    add_meta_box(
        'vehicle_gallery',
        __('Vehicle Gallery', 'guyana-auto-dealer'),
        'guyana_auto_dealer_vehicle_gallery_callback',
        'vehicle',
        'normal',
        'high'
    );

    add_meta_box(
        'vehicle_pricing',
        __('Vehicle Pricing', 'guyana-auto-dealer'),
        'guyana_auto_dealer_vehicle_pricing_callback',
        'vehicle',
        'side',
        'high'
    );

    add_meta_box(
        'vehicle_featured',
        __('Featured Vehicle', 'guyana-auto-dealer'),
        'guyana_auto_dealer_vehicle_featured_callback',
        'vehicle',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'guyana_auto_dealer_add_meta_boxes');

/**
 * Vehicle details meta box callback
 */
function guyana_auto_dealer_vehicle_details_callback($post) {
    wp_nonce_field('vehicle_details_nonce', 'vehicle_details_nonce');
    
    $vin = get_post_meta($post->ID, 'vehicle_vin', true);
    $mileage = get_post_meta($post->ID, 'vehicle_mileage', true);
    $engine = get_post_meta($post->ID, 'vehicle_engine', true);
    $transmission = get_post_meta($post->ID, 'vehicle_transmission', true);
    $fuel_type = get_post_meta($post->ID, 'vehicle_fuel_type', true);
    $color = get_post_meta($post->ID, 'vehicle_color', true);
    $interior_color = get_post_meta($post->ID, 'vehicle_interior_color', true);
    $doors = get_post_meta($post->ID, 'vehicle_doors', true);
    $seats = get_post_meta($post->ID, 'vehicle_seats', true);
    $stock_number = get_post_meta($post->ID, 'vehicle_stock_number', true);
    
    ?>
    <div class="vehicle-meta-box">
        <div class="form-row">
            <div class="form-col">
                <p>
                    <label for="vehicle_vin"><?php esc_html_e('VIN', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_vin" name="vehicle_vin" value="<?php echo esc_attr($vin); ?>" />
                </p>
            </div>
            <div class="form-col">
                <p>
                    <label for="vehicle_stock_number"><?php esc_html_e('Stock Number', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_stock_number" name="vehicle_stock_number" value="<?php echo esc_attr($stock_number); ?>" />
                </p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <p>
                    <label for="vehicle_mileage"><?php esc_html_e('Mileage', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_mileage" name="vehicle_mileage" value="<?php echo esc_attr($mileage); ?>" />
                </p>
            </div>
            <div class="form-col">
                <p>
                    <label for="vehicle_engine"><?php esc_html_e('Engine', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_engine" name="vehicle_engine" value="<?php echo esc_attr($engine); ?>" />
                </p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <p>
                    <label for="vehicle_transmission"><?php esc_html_e('Transmission', 'guyana-auto-dealer'); ?></label>
                    <select id="vehicle_transmission" name="vehicle_transmission">
                        <option value=""><?php esc_html_e('Select Transmission', 'guyana-auto-dealer'); ?></option>
                        <option value="automatic" <?php selected($transmission, 'automatic'); ?>><?php esc_html_e('Automatic', 'guyana-auto-dealer'); ?></option>
                        <option value="manual" <?php selected($transmission, 'manual'); ?>><?php esc_html_e('Manual', 'guyana-auto-dealer'); ?></option>
                        <option value="semi-automatic" <?php selected($transmission, 'semi-automatic'); ?>><?php esc_html_e('Semi-Automatic', 'guyana-auto-dealer'); ?></option>
                        <option value="cvt" <?php selected($transmission, 'cvt'); ?>><?php esc_html_e('CVT', 'guyana-auto-dealer'); ?></option>
                    </select>
                </p>
            </div>
            <div class="form-col">
                <p>
                    <label for="vehicle_fuel_type"><?php esc_html_e('Fuel Type', 'guyana-auto-dealer'); ?></label>
                    <select id="vehicle_fuel_type" name="vehicle_fuel_type">
                        <option value=""><?php esc_html_e('Select Fuel Type', 'guyana-auto-dealer'); ?></option>
                        <option value="gasoline" <?php selected($fuel_type, 'gasoline'); ?>><?php esc_html_e('Gasoline', 'guyana-auto-dealer'); ?></option>
                        <option value="diesel" <?php selected($fuel_type, 'diesel'); ?>><?php esc_html_e('Diesel', 'guyana-auto-dealer'); ?></option>
                        <option value="hybrid" <?php selected($fuel_type, 'hybrid'); ?>><?php esc_html_e('Hybrid', 'guyana-auto-dealer'); ?></option>
                        <option value="electric" <?php selected($fuel_type, 'electric'); ?>><?php esc_html_e('Electric', 'guyana-auto-dealer'); ?></option>
                        <option value="lpg" <?php selected($fuel_type, 'lpg'); ?>><?php esc_html_e('LPG', 'guyana-auto-dealer'); ?></option>
                    </select>
                </p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <p>
                    <label for="vehicle_color"><?php esc_html_e('Exterior Color', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_color" name="vehicle_color" value="<?php echo esc_attr($color); ?>" />
                </p>
            </div>
            <div class="form-col">
                <p>
                    <label for="vehicle_interior_color"><?php esc_html_e('Interior Color', 'guyana-auto-dealer'); ?></label>
                    <input type="text" id="vehicle_interior_color" name="vehicle_interior_color" value="<?php echo esc_attr($interior_color); ?>" />
                </p>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <p>
                    <label for="vehicle_doors"><?php esc_html_e('Doors', 'guyana-auto-dealer'); ?></label>
                    <select id="vehicle_doors" name="vehicle_doors">
                        <option value=""><?php esc_html_e('Select Doors', 'guyana-auto-dealer'); ?></option>
                        <option value="2" <?php selected($doors, '2'); ?>><?php esc_html_e('2', 'guyana-auto-dealer'); ?></option>
                        <option value="3" <?php selected($doors, '3'); ?>><?php esc_html_e('3', 'guyana-auto-dealer'); ?></option>
                        <option value="4" <?php selected($doors, '4'); ?>><?php esc_html_e('4', 'guyana-auto-dealer'); ?></option>
                        <option value="5" <?php selected($doors, '5'); ?>><?php esc_html_e('5', 'guyana-auto-dealer'); ?></option>
                    </select>
                </p>
            </div>
            <div class="form-col">
                <p>
                    <label for="vehicle_seats"><?php esc_html_e('Seats', 'guyana-auto-dealer'); ?></label>
                    <select id="vehicle_seats" name="vehicle_seats">
                        <option value=""><?php esc_html_e('Select Seats', 'guyana-auto-dealer'); ?></option>
                        <option value="2" <?php selected($seats, '2'); ?>><?php esc_html_e('2', 'guyana-auto-dealer'); ?></option>
                        <option value="4" <?php selected($seats, '4'); ?>><?php esc_html_e('4', 'guyana-auto-dealer'); ?></option>
                        <option value="5" <?php selected($seats, '5'); ?>><?php esc_html_e('5', 'guyana-auto-dealer'); ?></option>
                        <option value="6" <?php selected($seats, '6'); ?>><?php esc_html_e('6', 'guyana-auto-dealer'); ?></option>
                        <option value="7" <?php selected($seats, '7'); ?>><?php esc_html_e('7', 'guyana-auto-dealer'); ?></option>
                        <option value="8" <?php selected($seats, '8'); ?>><?php esc_html_e('8', 'guyana-auto-dealer'); ?></option>
                        <option value="9+" <?php selected($seats, '9+'); ?>><?php esc_html_e('9+', 'guyana-auto-dealer'); ?></option>
                    </select>
                </p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Vehicle gallery meta box callback
 */
function guyana_auto_dealer_vehicle_gallery_callback($post) {
    wp_nonce_field('vehicle_gallery_nonce', 'vehicle_gallery_nonce');
    
    $gallery_images = get_post_meta($post->ID, 'vehicle_gallery', true);
    
    ?>
    <div class="vehicle-gallery-meta-box">
        <p><?php esc_html_e('Add images to the vehicle gallery. The featured image will be the main image.', 'guyana-auto-dealer'); ?></p>
        
        <div id="vehicle-gallery-container">
            <?php if ($gallery_images) : ?>
                <?php foreach ($gallery_images as $image_id) : ?>
                    <div class="gallery-image">
                        <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                        <input type="hidden" name="vehicle_gallery[]" value="<?php echo esc_attr($image_id); ?>">
                        <a href="#" class="remove-image"><?php esc_html_e('Remove', 'guyana-auto-dealer'); ?></a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <p>
            <button type="button" class="button add-gallery-images"><?php esc_html_e('Add Gallery Images', 'guyana-auto-dealer'); ?></button>
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Add gallery images
        $('.add-gallery-images').click(function() {
            var frame = wp.media({
                title: '<?php esc_html_e('Select Vehicle Gallery Images', 'guyana-auto-dealer'); ?>',
                button: {
                    text: '<?php esc_html_e('Add to Gallery', 'guyana-auto-dealer'); ?>'
                },
                multiple: true
            });

            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();
                $.each(attachments, function(i, attachment) {
                    $('#vehicle-gallery-container').append(
                        '<div class="gallery-image">' +
                        '<img src="' + attachment.sizes.thumbnail.url + '" alt="">' +
                        '<input type="hidden" name="vehicle_gallery[]" value="' + attachment.id + '">' +
                        '<a href="#" class="remove-image"><?php esc_html_e('Remove', 'guyana-auto-dealer'); ?></a>' +
                        '</div>'
                    );
                });
            });

            frame.open();
            return false;
        });

        // Remove gallery image
        $(document).on('click', '.remove-image', function() {
            $(this).parent().remove();
            return false;
        });
    });
    </script>
    <style>
    #vehicle-gallery-container {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -5px;
    }
    .gallery-image {
        position: relative;
        width: calc(20% - 10px);
        margin: 0 5px 10px;
    }
    .gallery-image img {
        display: block;
        width: 100%;
        height: auto;
    }
    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0,0,0,0.5);
        color: #fff;
        padding: 2px 5px;
        font-size: 12px;
        text-decoration: none;
    }
    .remove-image:hover {
        background: rgba(0,0,0,0.8);
        color: #fff;
    }
    </style>
    <?php
}

/**
 * Vehicle pricing meta box callback
 */
function guyana_auto_dealer_vehicle_pricing_callback($post) {
    wp_nonce_field('vehicle_pricing_nonce', 'vehicle_pricing_nonce');
    
    $price = get_post_meta($post->ID, 'vehicle_price', true);
    $sale_price = get_post_meta($post->ID, 'vehicle_sale_price', true);
    
    ?>
    <div class="vehicle-pricing-meta-box">
        <p>
            <label for="vehicle_price"><?php esc_html_e('Regular Price (GYD)', 'guyana-auto-dealer'); ?></label>
            <input type="text" id="vehicle_price" name="vehicle_price" value="<?php echo esc_attr($price); ?>" />
        </p>
        
        <p>
            <label for="vehicle_sale_price"><?php esc_html_e('Sale Price (GYD, optional)', 'guyana-auto-dealer'); ?></label>
            <input type="text" id="vehicle_sale_price" name="vehicle_sale_price" value="<?php echo esc_attr($sale_price); ?>" />
        </p>
    </div>
    <?php
}

/**
 * Vehicle featured meta box callback
 */
function guyana_auto_dealer_vehicle_featured_callback($post) {
    wp_nonce_field('vehicle_featured_nonce', 'vehicle_featured_nonce');
    
    $featured = get_post_meta($post->ID, 'vehicle_featured', true);
    
    ?>
    <div class="vehicle-featured-meta-box">
        <p>
            <input type="checkbox" id="vehicle_featured" name="vehicle_featured" value="1" <?php checked($featured, '1'); ?> />
            <label for="vehicle_featured"><?php esc_html_e('Mark as Featured Vehicle', 'guyana-auto-dealer'); ?></label>
        </p>
    </div>
    <?php
}

/**
 * Save vehicle meta box data
 */
function guyana_auto_dealer_save_vehicle_meta_box_data($post_id) {
    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check if current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Vehicle Details
    if (isset($_POST['vehicle_details_nonce']) && wp_verify_nonce($_POST['vehicle_details_nonce'], 'vehicle_details_nonce')) {
        if (isset($_POST['vehicle_vin'])) {
            update_post_meta($post_id, 'vehicle_vin', sanitize_text_field($_POST['vehicle_vin']));
        }
        
        if (isset($_POST['vehicle_stock_number'])) {
            update_post_meta($post_id, 'vehicle_stock_number', sanitize_text_field($_POST['vehicle_stock_number']));
        }
        
        if (isset($_POST['vehicle_mileage'])) {
            update_post_meta($post_id, 'vehicle_mileage', sanitize_text_field($_POST['vehicle_mileage']));
        }
        
        if (isset($_POST['vehicle_engine'])) {
            update_post_meta($post_id, 'vehicle_engine', sanitize_text_field($_POST['vehicle_engine']));
        }
        
        if (isset($_POST['vehicle_transmission'])) {
            update_post_meta($post_id, 'vehicle_transmission', sanitize_text_field($_POST['vehicle_transmission']));
        }
        
        if (isset($_POST['vehicle_fuel_type'])) {
            update_post_meta($post_id, 'vehicle_fuel_type', sanitize_text_field($_POST['vehicle_fuel_type']));
        }
        
        if (isset($_POST['vehicle_color'])) {
            update_post_meta($post_id, 'vehicle_color', sanitize_text_field($_POST['vehicle_color']));
        }
        
        if (isset($_POST['vehicle_interior_color'])) {
            update_post_meta($post_id, 'vehicle_interior_color', sanitize_text_field($_POST['vehicle_interior_color']));
        }
        
        if (isset($_POST['vehicle_doors'])) {
            update_post_meta($post_id, 'vehicle_doors', sanitize_text_field($_POST['vehicle_doors']));
        }
        
        if (isset($_POST['vehicle_seats'])) {
            update_post_meta($post_id, 'vehicle_seats', sanitize_text_field($_POST['vehicle_seats']));
        }
    }
    
    // Vehicle Gallery
    if (isset($_POST['vehicle_gallery_nonce']) && wp_verify_nonce($_POST['vehicle_gallery_nonce'], 'vehicle_gallery_nonce')) {
        $gallery_images = isset($_POST['vehicle_gallery']) ? array_map('absint', $_POST['vehicle_gallery']) : array();
        update_post_meta($post_id, 'vehicle_gallery', $gallery_images);
    }
    
    // Vehicle Pricing
    if (isset($_POST['vehicle_pricing_nonce']) && wp_verify_nonce($_POST['vehicle_pricing_nonce'], 'vehicle_pricing_nonce')) {
        if (isset($_POST['vehicle_price'])) {
            update_post_meta($post_id, 'vehicle_price', sanitize_text_field($_POST['vehicle_price']));
        }
        
        if (isset($_POST['vehicle_sale_price'])) {
            update_post_meta($post_id, 'vehicle_sale_price', sanitize_text_field($_POST['vehicle_sale_price']));
        }
    }
    
    // Vehicle Featured
    if (isset($_POST['vehicle_featured_nonce']) && wp_verify_nonce($_POST['vehicle_featured_nonce'], 'vehicle_featured_nonce')) {
        $featured = isset($_POST['vehicle_featured']) ? '1' : '0';
        update_post_meta($post_id, 'vehicle_featured', $featured);
    }
}
add_action('save_post_vehicle', 'guyana_auto_dealer_save_vehicle_meta_box_data');

/**
 * Add model column to admin
 */
function guyana_auto_dealer_add_admin_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['thumbnail'] = __('Image', 'guyana-auto-dealer');
        } elseif ($key == 'date') {
            $new_columns['price'] = __('Price', 'guyana-auto-dealer');
            $new_columns['featured'] = __('Featured', 'guyana-auto-dealer');
            $new_columns[$key] = $value;
        } else {
            $new_columns[$key] = $value;
        }
    }
    
    return $new_columns;
}
add_filter('manage_vehicle_posts_columns', 'guyana_auto_dealer_add_admin_columns');

/**
 * Add content to custom admin columns
 */
function guyana_auto_dealer_custom_column_content($column, $post_id) {
    if ($column == 'thumbnail') {
        if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, array(80, 60));
        } else {
            echo '<img src="' . esc_url(GUYANA_AUTO_DEALER_URI . '/assets/images/no-image.png') . '" width="80" height="60" alt="' . esc_attr__('No Image', 'guyana-auto-dealer') . '">';
        }
    } elseif ($column == 'price') {
        $price = get_post_meta($post_id, 'vehicle_price', true);
        $sale_price = get_post_meta($post_id, 'vehicle_sale_price', true);
        
        if ($price) {
            echo guyana_auto_dealer_format_price($price);
            
            if ($sale_price) {
                echo ' <span class="sale-price">' . guyana_auto_dealer_format_price($sale_price) . '</span>';
            }
        } else {
            echo '—';
        }
    } elseif ($column == 'featured') {
        $featured = get_post_meta($post_id, 'vehicle_featured', true);
        
        if ($featured == '1') {
            echo '<span class="dashicons dashicons-star-filled" style="color:#ffb900;"></span>';
        } else {
            echo '<span class="dashicons dashicons-star-empty"></span>';
        }
    }
}
add_action('manage_vehicle_posts_custom_column', 'guyana_auto_dealer_custom_column_content', 10, 2);

/**
 * Register sortable columns
 */
function guyana_auto_dealer_sortable_columns($columns) {
    $columns['price'] = 'price';
    $columns['featured'] = 'featured';
    return $columns;
}
add_filter('manage_edit-vehicle_sortable_columns', 'guyana_auto_dealer_sortable_columns');

/**
 * Sort admin columns
 */
function guyana_auto_dealer_sort_columns_orderby($query) {
    if (!is_admin()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ($orderby == 'price') {
        $query->set('meta_key', 'vehicle_price');
        $query->set('orderby', 'meta_value_num');
    } elseif ($orderby == 'featured') {
        $query->set('meta_key', 'vehicle_featured');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'guyana_auto_dealer_sort_columns_orderby');

/**
 * Add filter dropdowns to admin
 */
function guyana_auto_dealer_admin_filter_dropdown() {
    global $typenow;
    
    if ($typenow == 'vehicle') {
        // Make dropdown
        $make_taxonomy = 'vehicle_make';
        $makes = get_terms(array('taxonomy' => $make_taxonomy, 'hide_empty' => false));
        $selected_make = isset($_GET[$make_taxonomy]) ? $_GET[$make_taxonomy] : '';
        
        echo '<select name="' . $make_taxonomy . '" id="' . $make_taxonomy . '" class="postform">';
        echo '<option value="">' . __('Filter by Make', 'guyana-auto-dealer') . '</option>';
        
        foreach ($makes as $make) {
            printf(
                '<option value="%s" %s>%s (%s)</option>',
                $make->slug,
                selected($selected_make, $make->slug, false),
                $make->name,
                $make->count
            );
        }
        
        echo '</select>';
        
        // Type dropdown
        $type_taxonomy = 'vehicle_type';
        $types = get_terms(array('taxonomy' => $type_taxonomy, 'hide_empty' => false));
        $selected_type = isset($_GET[$type_taxonomy]) ? $_GET[$type_taxonomy] : '';
        
        echo '<select name="' . $type_taxonomy . '" id="' . $type_taxonomy . '" class="postform">';
        echo '<option value="">' . __('Filter by Type', 'guyana-auto-dealer') . '</option>';
        
        foreach ($types as $type) {
            printf(
                '<option value="%s" %s>%s (%s)</option>',
                $type->slug,
                selected($selected_type, $type->slug, false),
                $type->name,
                $type->count
            );
        }
        
        echo '</select>';
        
        // Featured filter
        $featured = isset($_GET['featured']) ? $_GET['featured'] : '';
        
        echo '<select name="featured" id="featured" class="postform">';
        echo '<option value="">' . __('All Vehicles', 'guyana-auto-dealer') . '</option>';
        echo '<option value="1" ' . selected($featured, '1', false) . '>' . __('Featured', 'guyana-auto-dealer') . '</option>';
        echo '<option value="0" ' . selected($featured, '0', false) . '>' . __('Not Featured', 'guyana-auto-dealer') . '</option>';
        echo '</select>';
    }
}
add_action('restrict_manage_posts', 'guyana_auto_dealer_admin_filter_dropdown');

/**
 * Filter admin listing by custom fields
 */
function guyana_auto_dealer_parse_admin_filter_query($query) {
    global $pagenow, $typenow;
    
    if ($pagenow == 'edit.php' && $typenow == 'vehicle') {
        // Filter by featured
        if (isset($_GET['featured']) && $_GET['featured'] !== '') {
            $query->query_vars['meta_query'][] = array(
                'key' => 'vehicle_featured',
                'value' => $_GET['featured'],
                'compare' => '='
            );
        }
    }
}
add_action('pre_get_posts', 'guyana_auto_dealer_parse_admin_filter_query');

/**
 * Flush rewrite rules on theme activation
 */
function guyana_auto_dealer_rewrite_flush() {
    guyana_auto_dealer_register_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'guyana_auto_dealer_rewrite_flush');
