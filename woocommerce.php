<?php
/**
 * WooCommerce compatibility file
 *
 * @package Guyana_Auto_Dealer
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Make sure WooCommerce is active
if (!class_exists('WooCommerce')) {
    return;
}

/**
 * WooCommerce setup function.
 */
function guyana_auto_dealer_woocommerce_setup() {
    // Declare WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'guyana_auto_dealer_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 */
function guyana_auto_dealer_woocommerce_scripts() {
    wp_enqueue_style('guyana-auto-dealer-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), GUYANA_AUTO_DEALER_VERSION);
}
add_action('wp_enqueue_scripts', 'guyana_auto_dealer_woocommerce_scripts');

/**
 * Define number of products per row.
 */
function guyana_auto_dealer_woocommerce_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'guyana_auto_dealer_woocommerce_loop_columns');

/**
 * Products per page.
 */
function guyana_auto_dealer_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'guyana_auto_dealer_woocommerce_products_per_page');

/**
 * Related Products Args.
 */
function guyana_auto_dealer_woocommerce_related_products_args($args) {
    $defaults = array(
        'posts_per_page' => 4,
        'columns' => 4,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'guyana_auto_dealer_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Remove default WooCommerce sidebar.
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Add custom wrapper for WooCommerce pages.
 */
function guyana_auto_dealer_woocommerce_wrapper_before() {
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row clearfix">
                    <div class="<?php echo is_active_sidebar('shop-sidebar') ? 'content-area' : 'full-width'; ?>">
    <?php
}
add_action('woocommerce_before_main_content', 'guyana_auto_dealer_woocommerce_wrapper_before');

/**
 * Close the custom wrapper for WooCommerce pages.
 */
function guyana_auto_dealer_woocommerce_wrapper_after() {
    ?>
                    </div>
                    <?php if (is_active_sidebar('shop-sidebar')) : ?>
                        <div class="widget-area">
                            <?php dynamic_sidebar('shop-sidebar'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php
}
add_action('woocommerce_after_main_content', 'guyana_auto_dealer_woocommerce_wrapper_after');

/**
 * Add custom page header to WooCommerce pages.
 */
function guyana_auto_dealer_woocommerce_page_header() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        ?>
        <header class="page-header">
            <div class="container">
                <div class="page-header-content">
                    <h1 class="page-title">
                        <?php woocommerce_page_title(); ?>
                    </h1>
                    <?php guyana_auto_dealer_breadcrumbs(); ?>
                </div>
            </div>
        </header>
        <?php
    }
}
add_action('woocommerce_before_main_content', 'guyana_auto_dealer_woocommerce_page_header', 5);

/**
 * Add filter widgets to shop page.
 */
function guyana_auto_dealer_woocommerce_filter_widgets() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        if (is_active_sidebar('shop-filter')) {
            ?>
            <div class="shop-filter-wrapper">
                <div class="shop-filter-toggle">
                    <span><?php esc_html_e('Filter Products', 'guyana-auto-dealer'); ?></span>
                    <i class="fas fa-filter"></i>
                </div>
                <div class="shop-filter-content">
                    <?php dynamic_sidebar('shop-filter'); ?>
                </div>
            </div>
            <?php
        }
    }
}
add_action('woocommerce_before_shop_loop', 'guyana_auto_dealer_woocommerce_filter_widgets', 15);

/**
 * Add custom widget area for shop filters.
 */
function guyana_auto_dealer_woocommerce_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Shop Filters', 'guyana-auto-dealer'),
        'id' => 'shop-filter',
        'description' => esc_html__('Add shop filter widgets here.', 'guyana-auto-dealer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'guyana_auto_dealer_woocommerce_widgets_init');

/**
 * Customize WooCommerce product search form.
 */
function guyana_auto_dealer_woocommerce_product_search_form($form) {
    $form = '<form role="search" method="get" class="woocommerce-product-search" action="' . esc_url(home_url('/')) . '">
        <div class="search-field-wrapper">
            <input type="search" id="woocommerce-product-search-field-' . esc_attr(rand(0, 99)) . '" class="search-field" placeholder="' . esc_attr__('Search products&hellip;', 'guyana-auto-dealer') . '" value="' . get_search_query() . '" name="s" />
            <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
        </div>
        <input type="hidden" name="post_type" value="product" />
    </form>';

    return $form;
}
add_filter('get_product_search_form', 'guyana_auto_dealer_woocommerce_product_search_form');

/**
 * Add before and after for product thumbnails.
 */
function guyana_auto_dealer_woocommerce_before_shop_loop_item_title() {
    echo '<div class="product-thumb-wrapper">';
}
add_action('woocommerce_before_shop_loop_item_title', 'guyana_auto_dealer_woocommerce_before_shop_loop_item_title', 5);

function guyana_auto_dealer_woocommerce_after_shop_loop_item_title() {
    echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'guyana_auto_dealer_woocommerce_after_shop_loop_item_title', 15);

/**
 * Wrap product title in div.
 */
function guyana_auto_dealer_woocommerce_template_loop_product_title() {
    echo '<div class="product-title-wrap"><h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2></div>';
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'guyana_auto_dealer_woocommerce_template_loop_product_title', 10);

/**
 * Customize add to cart button.
 */
function guyana_auto_dealer_woocommerce_loop_add_to_cart_args($args, $product) {
    $args['class'] .= ' btn btn-primary';
    return $args;
}
add_filter('woocommerce_loop_add_to_cart_args', 'guyana_auto_dealer_woocommerce_loop_add_to_cart_args', 10, 2);

/**
 * Customize cart fragments to update cart count.
 */
function guyana_auto_dealer_woocommerce_cart_fragments($fragments) {
    $fragments['.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'guyana_auto_dealer_woocommerce_cart_fragments');

/**
 * Add quantity buttons.
 */
function guyana_auto_dealer_woocommerce_quantity_input_template() {
    ?>
    <script type="text/html" id="tmpl-guyana-auto-dealer-quantity-button">
        <div class="quantity-buttons">
            <button type="button" class="quantity-button minus">-</button>
            <button type="button" class="quantity-button plus">+</button>
        </div>
    </script>
    <?php
}
add_action('wp_footer', 'guyana_auto_dealer_woocommerce_quantity_input_template');

/**
 * Add quantity buttons to the quantity input through JS.
 */
function guyana_auto_dealer_woocommerce_quantity_buttons_script() {
    if (is_woocommerce() || is_cart() || is_checkout()) {
        ?>
        <script>
            (function($) {
                // Add buttons after quantity inputs
                function addQuantityButtons() {
                    $('.quantity').each(function() {
                        var $quantity = $(this);
                        var $input = $quantity.find('.qty');
                        
                        if ($quantity.find('.quantity-buttons').length === 0) {
                            var buttonTemplate = wp.template('guyana-auto-dealer-quantity-button');
                            $quantity.append(buttonTemplate());
                        }
                    });
                }
                
                // On page load
                $(document).ready(function() {
                    addQuantityButtons();
                });
                
                // After AJAX events (e.g. update cart)
                $(document).ajaxComplete(function() {
                    addQuantityButtons();
                });
                
            })(jQuery);
        </script>
        <?php
    }
}
add_action('wp_footer', 'guyana_auto_dealer_woocommerce_quantity_buttons_script');

/**
 * Add categories to single product.
 */
function guyana_auto_dealer_woocommerce_template_single_categories() {
    global $product;
    echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories">', '</div>');
}
add_action('woocommerce_single_product_summary', 'guyana_auto_dealer_woocommerce_template_single_categories', 5);

/**
 * Add social sharing buttons to single product.
 */
function guyana_auto_dealer_woocommerce_share() {
    ?>
    <div class="product-share">
        <span class="share-title"><?php esc_html_e('Share:', 'guyana-auto-dealer'); ?></span>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="share-twitter">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" class="share-whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <?php
}
add_action('woocommerce_share', 'guyana_auto_dealer_woocommerce_share');

/**
 * Add tabs before related products on single product.
 */
function guyana_auto_dealer_woocommerce_output_product_data_tabs() {
    woocommerce_output_product_data_tabs();
}
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_after_single_product_summary', 'guyana_auto_dealer_woocommerce_output_product_data_tabs', 5);

/**
 * Customize the product tags displayed on single product pages.
 */
function guyana_auto_dealer_woocommerce_template_single_tags() {
    global $product;
    echo wc_get_product_tag_list($product->get_id(), ', ', '<div class="product-tags"><span>' . esc_html__('Tags:', 'guyana-auto-dealer') . '</span> ', '</div>');
}
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'guyana_auto_dealer_woocommerce_template_single_tags', 40);

/**
 * Hide related products if none exist.
 */
function guyana_auto_dealer_woocommerce_hide_related_products($args) {
    global $product;
    
    if (!$product) {
        return $args;
    }
    
    $related = wc_get_related_products($product->get_id(), $args['posts_per_page']);
    
    if (empty($related)) {
        return array(
            'posts_per_page' => 0,
            'columns' => 0,
            'orderby' => '',
            'order' => '',
        );
    }
    
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'guyana_auto_dealer_woocommerce_hide_related_products');

/**
 * Customize the order received page.
 */
function guyana_auto_dealer_woocommerce_thankyou_order_received_text($text, $order) {
    if ($order) {
        $text = sprintf(
            /* translators: %s: customer first name */
            esc_html__('Thank you %s! Your order has been received.', 'guyana-auto-dealer'),
            esc_html($order->get_billing_first_name())
        );
    }
    return $text;
}
add_filter('woocommerce_thankyou_order_received_text', 'guyana_auto_dealer_woocommerce_thankyou_order_received_text', 10, 2);

/**
 * Register a custom post type for auto parts that integrates with WooCommerce.
 */
function guyana_auto_dealer_register_auto_parts_product_type() {
    require_once get_template_directory() . '/inc/woocommerce/class-wc-product-auto-part.php';
}
add_action('plugins_loaded', 'guyana_auto_dealer_register_auto_parts_product_type');

/**
 * Add 'auto_part' to product type selector.
 */
function guyana_auto_dealer_add_auto_part_product_type($types) {
    $types['auto_part'] = __('Auto Part', 'guyana-auto-dealer');
    return $types;
}
add_filter('product_type_selector', 'guyana_auto_dealer_add_auto_part_product_type');

/**
 * Add tabs for auto part product type.
 */
function guyana_auto_dealer_auto_part_product_tabs($tabs) {
    $tabs['auto_part'] = array(
        'label' => __('Auto Part', 'guyana-auto-dealer'),
        'target' => 'auto_part_product_data',
        'class' => array('show_if_auto_part'),
    );
    return $tabs;
}
add_filter('woocommerce_product_data_tabs', 'guyana_auto_dealer_auto_part_product_tabs');

/**
 * Add auto part product tab content.
 */
function guyana_auto_dealer_auto_part_product_tab_content() {
    ?>
    <div id="auto_part_product_data" class="panel woocommerce_options_panel">
        <?php
        woocommerce_wp_text_input(array(
            'id' => '_part_number',
            'label' => __('Part Number', 'guyana-auto-dealer'),
            'placeholder' => '',
            'description' => __('Enter the part number for this auto part.', 'guyana-auto-dealer'),
            'desc_tip' => true,
        ));
        
        woocommerce_wp_text_input(array(
            'id' => '_manufacturer',
            'label' => __('Manufacturer', 'guyana-auto-dealer'),
            'placeholder' => '',
            'description' => __('Enter the manufacturer of this auto part.', 'guyana-auto-dealer'),
            'desc_tip' => true,
        ));
        
        woocommerce_wp_select(array(
            'id' => '_condition',
            'label' => __('Condition', 'guyana-auto-dealer'),
            'options' => array(
                '' => __('Select condition', 'guyana-auto-dealer'),
                'new' => __('New', 'guyana-auto-dealer'),
                'used' => __('Used', 'guyana-auto-dealer'),
                'refurbished' => __('Refurbished', 'guyana-auto-dealer'),
            ),
            'description' => __('Select the condition of this auto part.', 'guyana-auto-dealer'),
            'desc_tip' => true,
        ));
        
        woocommerce_wp_checkbox(array(
            'id' => '_is_oem',
            'label' => __('Is OEM Part?', 'guyana-auto-dealer'),
            'description' => __('Check if this is an Original Equipment Manufacturer (OEM) part.', 'guyana-auto-dealer'),
            'desc_tip' => true,
        ));
        
        woocommerce_wp_textarea_input(array(
            'id' => '_compatible_vehicles',
            'label' => __('Compatible Vehicles', 'guyana-auto-dealer'),
            'placeholder' => '',
            'description' => __('Enter the makes/models/years this part is compatible with. One per line.', 'guyana-auto-dealer'),
            'desc_tip' => true,
        ));
        ?>
    </div>
    <?php
}
add_action('woocommerce_product_data_panels', 'guyana_auto_dealer_auto_part_product_tab_content');

/**
 * Save auto part product data.
 */
function guyana_auto_dealer_save_auto_part_product_data($post_id) {
    // Part Number
    if (isset($_POST['_part_number'])) {
        update_post_meta($post_id, '_part_number', sanitize_text_field($_POST['_part_number']));
    }
    
    // Manufacturer
    if (isset($_POST['_manufacturer'])) {
        update_post_meta($post_id, '_manufacturer', sanitize_text_field($_POST['_manufacturer']));
    }
    
    // Condition
    if (isset($_POST['_condition'])) {
        update_post_meta($post_id, '_condition', sanitize_text_field($_POST['_condition']));
    }
    
    // Is OEM
    $is_oem = isset($_POST['_is_oem']) ? 'yes' : 'no';
    update_post_meta($post_id, '_is_oem', $is_oem);
    
    // Compatible Vehicles
    if (isset($_POST['_compatible_vehicles'])) {
        update_post_meta($post_id, '_compatible_vehicles', sanitize_textarea_field($_POST['_compatible_vehicles']));
    }
}
add_action('woocommerce_process_product_meta', 'guyana_auto_dealer_save_auto_part_product_data');

/**
 * Display auto part details on the product page.
 */
function guyana_auto_dealer_display_auto_part_details() {
    global $product;
    
    // Check if the product is an auto part
    if ($product->get_type() !== 'auto_part') {
        return;
    }
    
    // Get auto part details
    $part_number = get_post_meta($product->get_id(), '_part_number', true);
    $manufacturer = get_post_meta($product->get_id(), '_manufacturer', true);
    $condition = get_post_meta($product->get_id(), '_condition', true);
    $is_oem = get_post_meta($product->get_id(), '_is_oem', true);
    $compatible_vehicles = get_post_meta($product->get_id(), '_compatible_vehicles', true);
    
    // Display details if any exist
    if ($part_number || $manufacturer || $condition || $is_oem === 'yes' || $compatible_vehicles) {
        echo '<div class="auto-part-details">';
        echo '<h3>' . esc_html__('Auto Part Details', 'guyana-auto-dealer') . '</h3>';
        echo '<table class="auto-part-details-table">';
        
        if ($part_number) {
            echo '<tr>';
            echo '<th>' . esc_html__('Part Number:', 'guyana-auto-dealer') . '</th>';
            echo '<td>' . esc_html($part_number) . '</td>';
            echo '</tr>';
        }
        
        if ($manufacturer) {
            echo '<tr>';
            echo '<th>' . esc_html__('Manufacturer:', 'guyana-auto-dealer') . '</th>';
            echo '<td>' . esc_html($manufacturer) . '</td>';
            echo '</tr>';
        }
        
        if ($condition) {
            echo '<tr>';
            echo '<th>' . esc_html__('Condition:', 'guyana-auto-dealer') . '</th>';
            echo '<td>';
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
                    echo esc_html($condition);
            }
            echo '</td>';
            echo '</tr>';
        }
        
        if ($is_oem === 'yes') {
            echo '<tr>';
            echo '<th>' . esc_html__('OEM Part:', 'guyana-auto-dealer') . '</th>';
            echo '<td>' . esc_html__('Yes', 'guyana-auto-dealer') . '</td>';
            echo '</tr>';
        }
        
        if ($compatible_vehicles) {
            echo '<tr>';
            echo '<th>' . esc_html__('Compatible Vehicles:', 'guyana-auto-dealer') . '</th>';
            echo '<td>';
            $vehicles = explode("\n", $compatible_vehicles);
            foreach ($vehicles as $vehicle) {
                echo esc_html(trim($vehicle)) . '<br>';
            }
            echo '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'guyana_auto_dealer_display_auto_part_details', 25);
