<?php
/**
 * Auto Parts Product Type
 *
 * @package    Guyana_Auto_Dealer
 * @subpackage WooCommerce
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Auto Part Product Class
 */
class WC_Product_Auto_Part extends WC_Product {
    
    /**
     * Initialize auto part product.
     *
     * @param WC_Product|int $product Product instance or ID.
     */
    public function __construct($product = 0) {
        $this->product_type = 'auto_part';
        parent::__construct($product);
    }
    
    /**
     * Get internal type.
     *
     * @return string
     */
    public function get_type() {
        return 'auto_part';
    }
    
    /**
     * Get the add to cart button text.
     *
     * @return string
     */
    public function add_to_cart_text() {
        $text = $this->is_purchasable() && $this->is_in_stock() ? __('Add to cart', 'guyana-auto-dealer') : __('Read more', 'guyana-auto-dealer');
        
        return apply_filters('woocommerce_product_add_to_cart_text', $text, $this);
    }
    
    /**
     * Get the add to cart button text description - used in aria tags.
     *
     * @return string
     */
    public function add_to_cart_description() {
        /* translators: %s: Product title */
        $text = $this->is_purchasable() && $this->is_in_stock() ? __('Add &ldquo;%s&rdquo; to your cart', 'guyana-auto-dealer') : __('Read more about &ldquo;%s&rdquo;', 'guyana-auto-dealer');
        
        return apply_filters('woocommerce_product_add_to_cart_description', sprintf($text, $this->get_name()), $this);
    }
    
    /**
     * Get the part number.
     *
     * @param string $context What the value is for. Valid values are 'view' and 'edit'.
     * @return string
     */
    public function get_part_number($context = 'view') {
        return get_post_meta($this->get_id(), '_part_number', true);
    }
    
    /**
     * Get the manufacturer.
     *
     * @param string $context What the value is for. Valid values are 'view' and 'edit'.
     * @return string
     */
    public function get_manufacturer($context = 'view') {
        return get_post_meta($this->get_id(), '_manufacturer', true);
    }
    
    /**
     * Get the condition.
     *
     * @param string $context What the value is for. Valid values are 'view' and 'edit'.
     * @return string
     */
    public function get_condition($context = 'view') {
        return get_post_meta($this->get_id(), '_condition', true);
    }
    
    /**
     * Check if is OEM part.
     *
     * @param string $context What the value is for. Valid values are 'view' and 'edit'.
     * @return bool
     */
    public function is_oem($context = 'view') {
        return 'yes' === get_post_meta($this->get_id(), '_is_oem', true);
    }
    
    /**
     * Get compatible vehicles.
     *
     * @param string $context What the value is for. Valid values are 'view' and 'edit'.
     * @return string
     */
    public function get_compatible_vehicles($context = 'view') {
        return get_post_meta($this->get_id(), '_compatible_vehicles', true);
    }
    
    /**
     * Returns whether or not the product has compatible vehicles.
     *
     * @return boolean
     */
    public function has_compatible_vehicles() {
        return '' !== $this->get_compatible_vehicles();
    }
    
    /**
     * Returns an array of compatible vehicles.
     *
     * @return array
     */
    public function get_compatible_vehicles_array() {
        $vehicles = $this->get_compatible_vehicles();
        
        if (empty($vehicles)) {
            return array();
        }
        
        return array_filter(array_map('trim', explode("\n", $vehicles)));
    }
    
    /**
     * Set part number.
     *
     * @param string $part_number Part number.
     */
    public function set_part_number($part_number) {
        update_post_meta($this->get_id(), '_part_number', $part_number);
    }
    
    /**
     * Set manufacturer.
     *
     * @param string $manufacturer Manufacturer.
     */
    public function set_manufacturer($manufacturer) {
        update_post_meta($this->get_id(), '_manufacturer', $manufacturer);
    }
    
    /**
     * Set condition.
     *
     * @param string $condition Condition.
     */
    public function set_condition($condition) {
        update_post_meta($this->get_id(), '_condition', $condition);
    }
    
    /**
     * Set is OEM.
     *
     * @param bool $is_oem Is OEM.
     */
    public function set_is_oem($is_oem) {
        update_post_meta($this->get_id(), '_is_oem', true === $is_oem ? 'yes' : 'no');
    }
    
    /**
     * Set compatible vehicles.
     *
     * @param string $compatible_vehicles Compatible vehicles.
     */
    public function set_compatible_vehicles($compatible_vehicles) {
        update_post_meta($this->get_id(), '_compatible_vehicles', $compatible_vehicles);
    }
}

/**
 * Register the product type in WooCommerce.
 */
add_filter('woocommerce_product_class', 'guyana_auto_dealer_register_auto_part_product_class', 10, 2);
function guyana_auto_dealer_register_auto_part_product_class($classname, $product_type) {
    if ($product_type === 'auto_part') {
        $classname = 'WC_Product_Auto_Part';
    }
    
    return $classname;
}

/**
 * Add to cart button text.
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'guyana_auto_dealer_auto_part_add_to_cart_text', 10, 2);
function guyana_auto_dealer_auto_part_add_to_cart_text($text, $product) {
    if ($product && $product->is_type('auto_part')) {
        return __('Add to Cart', 'guyana-auto-dealer');
    }
    
    return $text;
}

/**
 * Adjust the product data tabs.
 */
add_filter('woocommerce_product_tabs', 'guyana_auto_dealer_auto_part_tabs', 20);
function guyana_auto_dealer_auto_part_tabs($tabs) {
    global $product;
    
    if ($product && $product->is_type('auto_part')) {
        // Add compatibility tab if the product has compatible vehicles
        if ($product->has_compatible_vehicles()) {
            $tabs['compatibility'] = array(
                'title'    => __('Compatibility', 'guyana-auto-dealer'),
                'priority' => 20,
                'callback' => 'guyana_auto_dealer_auto_part_compatibility_tab',
            );
        }
    }
    
    return $tabs;
}

/**
 * Content for the compatibility tab.
 */
function guyana_auto_dealer_auto_part_compatibility_tab() {
    global $product;
    
    if ($product && $product->is_type('auto_part')) {
        $compatible_vehicles = $product->get_compatible_vehicles_array();
        
        if (!empty($compatible_vehicles)) {
            echo '<h3>' . esc_html__('Compatible Vehicles', 'guyana-auto-dealer') . '</h3>';
            echo '<ul class="compatible-vehicles-list">';
            
            foreach ($compatible_vehicles as $vehicle) {
                echo '<li>' . esc_html($vehicle) . '</li>';
            }
            
            echo '</ul>';
        }
    }
}

/**
 * Display Auto Part details on the add to cart page.
 */
add_action('woocommerce_before_add_to_cart_button', 'guyana_auto_dealer_before_add_to_cart_button');
function guyana_auto_dealer_before_add_to_cart_button() {
    global $product;
    
    if ($product && $product->is_type('auto_part')) {
        $part_number = $product->get_part_number();
        $manufacturer = $product->get_manufacturer();
        $condition = $product->get_condition();
        $is_oem = $product->is_oem();
        
        echo '<div class="auto-part-data">';
        
        if ($part_number) {
            echo '<div class="auto-part-data-item">';
            echo '<span class="auto-part-data-label">' . esc_html__('Part Number:', 'guyana-auto-dealer') . '</span> ';
            echo '<span class="auto-part-data-value">' . esc_html($part_number) . '</span>';
            echo '</div>';
        }
        
        if ($manufacturer) {
            echo '<div class="auto-part-data-item">';
            echo '<span class="auto-part-data-label">' . esc_html__('Manufacturer:', 'guyana-auto-dealer') . '</span> ';
            echo '<span class="auto-part-data-value">' . esc_html($manufacturer) . '</span>';
            echo '</div>';
        }
        
        if ($condition) {
            echo '<div class="auto-part-data-item">';
            echo '<span class="auto-part-data-label">' . esc_html__('Condition:', 'guyana-auto-dealer') . '</span> ';
            echo '<span class="auto-part-data-value">';
            
            switch ($condition) {
                case 'new':
                    esc_html_e('New', 'guyana-auto-dealer');
                    break;
                case 'used':
                    esc_html_e('Used', 'guyana-auto-dealer');
                    break;
                case 'refurbished':
                    esc_html_e('Refurbished', 'guyana-auto-dealer');
                    break;
                default:
                    echo esc_html(ucfirst($condition));
            }
            
            echo '</span>';
            echo '</div>';
        }
        
        if ($is_oem) {
            echo '<div class="auto-part-data-item">';
            echo '<span class="auto-part-data-label">' . esc_html__('OEM Part:', 'guyana-auto-dealer') . '</span> ';
            echo '<span class="auto-part-data-value">' . esc_html__('Yes', 'guyana-auto-dealer') . '</span>';
            echo '</div>';
        }
        
        echo '</div>';
    }
}

/**
 * Add Auto Part data to structured data.
 */
add_filter('woocommerce_structured_data_product', 'guyana_auto_dealer_auto_part_structured_data', 10, 2);
function guyana_auto_dealer_auto_part_structured_data($markup, $product) {
    if ($product && $product->is_type('auto_part')) {
        $markup['mpn'] = $product->get_part_number();
        
        if ($product->get_manufacturer()) {
            $markup['brand'] = array(
                '@type' => 'Brand',
                'name' => $product->get_manufacturer(),
            );
        }
        
        // Add itemCondition
        if ($product->get_condition()) {
            $condition = $product->get_condition();
            $condition_map = array(
                'new' => 'https://schema.org/NewCondition',
                'used' => 'https://schema.org/UsedCondition',
                'refurbished' => 'https://schema.org/RefurbishedCondition',
            );
            
            if (isset($condition_map[$condition])) {
                $markup['itemCondition'] = $condition_map[$condition];
            }
        }
    }
    
    return $markup;
}

/**
 * Add vehicle compatibility filter widget.
 */
add_action('widgets_init', 'guyana_auto_dealer_register_vehicle_compatibility_widget');
function guyana_auto_dealer_register_vehicle_compatibility_widget() {
    register_widget('Guyana_Auto_Dealer_Vehicle_Compatibility_Widget');
}

/**
 * Vehicle Compatibility Widget class.
 */
class Guyana_Auto_Dealer_Vehicle_Compatibility_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'vehicle_compatibility',
            __('Vehicle Compatibility', 'guyana-auto-dealer'),
            array('description' => __('Filter auto parts by vehicle compatibility.', 'guyana-auto-dealer'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        if (!is_shop() && !is_product_category() && !is_product_tag()) {
            return;
        }
        
        $title = apply_filters('widget_title', $instance['title']);
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        // Get vehicle makes
        $makes = get_terms(array(
            'taxonomy' => 'vehicle_make',
            'hide_empty' => true,
        ));
        
        $selected_make = isset($_GET['vehicle_make']) ? sanitize_text_field($_GET['vehicle_make']) : '';
        $selected_model = isset($_GET['vehicle_model']) ? sanitize_text_field($_GET['vehicle_model']) : '';
        $selected_year = isset($_GET['vehicle_year']) ? sanitize_text_field($_GET['vehicle_year']) : '';
        
        echo '<form action="' . esc_url(wc_get_page_permalink('shop')) . '" method="get" class="vehicle-compatibility-form">';
        
        // Make dropdown
        echo '<div class="form-field">';
        echo '<label for="vehicle_make">' . esc_html__('Make', 'guyana-auto-dealer') . '</label>';
        echo '<select name="vehicle_make" id="vehicle_make" class="compatibility-select">';
        echo '<option value="">' . esc_html__('Select Make', 'guyana-auto-dealer') . '</option>';
        
        if (!empty($makes) && !is_wp_error($makes)) {
            foreach ($makes as $make) {
                echo '<option value="' . esc_attr($make->slug) . '" ' . selected($selected_make, $make->slug, false) . '>' . esc_html($make->name) . '</option>';
            }
        }
        
        echo '</select>';
        echo '</div>';
        
        // Model dropdown
        echo '<div class="form-field">';
        echo '<label for="vehicle_model">' . esc_html__('Model', 'guyana-auto-dealer') . '</label>';
        echo '<select name="vehicle_model" id="vehicle_model" class="compatibility-select"' . (empty($selected_make) ? ' disabled' : '') . '>';
        echo '<option value="">' . esc_html__('Select Model', 'guyana-auto-dealer') . '</option>';
        
        if (!empty($selected_make)) {
            $models = get_terms(array(
                'taxonomy' => 'vehicle_model',
                'hide_empty' => true,
                'meta_query' => array(
                    array(
                        'key' => 'vehicle_make',
                        'value' => $selected_make,
                        'compare' => '=',
                    ),
                ),
            ));
            
            if (!empty($models) && !is_wp_error($models)) {
                foreach ($models as $model) {
                    echo '<option value="' . esc_attr($model->slug) . '" ' . selected($selected_model, $model->slug, false) . '>' . esc_html($model->name) . '</option>';
                }
            }
        }
        
        echo '</select>';
        echo '</div>';
        
        // Year dropdown
        echo '<div class="form-field">';
        echo '<label for="vehicle_year">' . esc_html__('Year', 'guyana-auto-dealer') . '</label>';
        echo '<select name="vehicle_year" id="vehicle_year" class="compatibility-select">';
        echo '<option value="">' . esc_html__('Select Year', 'guyana-auto-dealer') . '</option>';
        
        $years = get_terms(array(
            'taxonomy' => 'vehicle_year',
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'DESC',
        ));
        
        if (!empty($years) && !is_wp_error($years)) {
            foreach ($years as $year) {
                echo '<option value="' . esc_attr($year->slug) . '" ' . selected($selected_year, $year->slug, false) . '>' . esc_html($year->name) . '</option>';
            }
        }
        
        echo '</select>';
        echo '</div>';
        
        // Submit button
        echo '<div class="form-field">';
        echo '<button type="submit" class="btn btn-primary btn-block">' . esc_html__('Find Parts', 'guyana-auto-dealer') . '</button>';
        echo '</div>';
        
        // Keep any existing query params
        foreach ($_GET as $key => $value) {
            if ($key !== 'vehicle_make' && $key !== 'vehicle_model' && $key !== 'vehicle_year') {
                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
            }
        }
        
        echo '</form>';
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : __('Find Parts for Your Vehicle', 'guyana-auto-dealer');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'guyana-auto-dealer'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        
        return $instance;
    }
}

/**
 * Filter products by vehicle compatibility.
 */
add_action('woocommerce_product_query', 'guyana_auto_dealer_filter_products_by_vehicle');
function guyana_auto_dealer_filter_products_by_vehicle($query) {
    if (isset($_GET['vehicle_make']) && !empty($_GET['vehicle_make'])) {
        $make = sanitize_text_field($_GET['vehicle_make']);
        $model = isset($_GET['vehicle_model']) ? sanitize_text_field($_GET['vehicle_model']) : '';
        $year = isset($_GET['vehicle_year']) ? sanitize_text_field($_GET['vehicle_year']) : '';
        
        // Build the vehicle string to match
        $vehicle_strings = array();
        
        if (!empty($make)) {
            $make_term = get_term_by('slug', $make, 'vehicle_make');
            if ($make_term) {
                $vehicle_strings[] = $make_term->name;
            }
        }
        
        if (!empty($model)) {
            $model_term = get_term_by('slug', $model, 'vehicle_model');
            if ($model_term) {
                $vehicle_strings[] = $model_term->name;
            }
        }
        
        if (!empty($year)) {
            $year_term = get_term_by('slug', $year, 'vehicle_year');
            if ($year_term) {
                $vehicle_strings[] = $year_term->name;
            }
        }
        
        if (!empty($vehicle_strings)) {
            // Get all products of type auto_part
            $auto_part_products = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'fields' => 'ids',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_type',
                        'field' => 'slug',
                        'terms' => 'auto_part',
                    ),
                ),
            ));
            
            $compatible_products = array();
            
            if ($auto_part_products->have_posts()) {
                foreach ($auto_part_products->posts as $product_id) {
                    $compatible_vehicles = get_post_meta($product_id, '_compatible_vehicles', true);
                    
                    if (!empty($compatible_vehicles)) {
                        $vehicle_lines = explode("\n", $compatible_vehicles);
                        
                        foreach ($vehicle_lines as $line) {
                            $line = trim($line);
                            $match = true;
                            
                            foreach ($vehicle_strings as $string) {
                                if (stripos($line, $string) === false) {
                                    $match = false;
                                    break;
                                }
                            }
                            
                            if ($match) {
                                $compatible_products[] = $product_id;
                                break;
                            }
                        }
                    }
                }
            }
            
            if (!empty($compatible_products)) {
                $query->set('post__in', $compatible_products);
            } else {
                // No compatible products found
                $query->set('post__in', array(0));
            }
        }
    }
    
    return $query;
}

/**
 * Add AJAX handler for getting models by make.
 */
add_action('wp_ajax_get_models_by_make', 'guyana_auto_dealer_ajax_get_models_by_make');
add_action('wp_ajax_nopriv_get_models_by_make', 'guyana_auto_dealer_ajax_get_models_by_make');
function guyana_auto_dealer_ajax_get_models_by_make() {
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

/**
 * Load compatibility widget JavaScript.
 */
add_action('wp_enqueue_scripts', 'guyana_auto_dealer_compatibility_widget_scripts');
function guyana_auto_dealer_compatibility_widget_scripts() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        wp_enqueue_script('guyana-auto-dealer-compatibility', get_template_directory_uri() . '/assets/js/compatibility-widget.js', array('jquery'), GUYANA_AUTO_DEALER_VERSION, true);
        
        wp_localize_script('guyana-auto-dealer-compatibility', 'compatibility_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('guyana_auto_dealer_nonce'),
            'select_model_text' => __('Select Model', 'guyana-auto-dealer'),
        ));
    }
}

/**
 * Create compatibility-widget.js file.
 */
function guyana_auto_dealer_create_compatibility_widget_js() {
    $file_path = get_template_directory() . '/assets/js/compatibility-widget.js';
    
    // Check if file already exists
    if (file_exists($file_path)) {
        return;
    }
    
    // Create js directory if it doesn't exist
    wp_mkdir_p(dirname($file_path));
    
    $js_content = "/**
 * Vehicle Compatibility Widget JavaScript
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Handle make dropdown change
        $('#vehicle_make').on('change', function() {
            var makeSlug = $(this).val();
            var modelSelect = $('#vehicle_model');
            
            // Reset the model dropdown
            modelSelect.html('<option value=\"\">' + compatibility_vars.select_model_text + '</option>');
            modelSelect.prop('disabled', true);
            
            if (makeSlug) {
                // Get models for the selected make
                $.ajax({
                    url: compatibility_vars.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'get_models_by_make',
                        make: makeSlug,
                        nonce: compatibility_vars.nonce
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            $.each(response.data, function(index, model) {
                                modelSelect.append('<option value=\"' + model.slug + '\">' + model.name + '</option>');
                            });
                            modelSelect.prop('disabled', false);
                        }
                    }
                });
            }
        });
    });
})(jQuery);";
    
    // Write the file
    file_put_contents($file_path, $js_content);
}
add_action('after_switch_theme', 'guyana_auto_dealer_create_compatibility_widget_js');
