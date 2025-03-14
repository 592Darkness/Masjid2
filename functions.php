<?php
/**
 * Guyana Auto Dealer functions and definitions
 *
 * @package Guyana_Auto_Dealer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('GUYANA_AUTO_DEALER_VERSION', '1.0.0');
define('GUYANA_AUTO_DEALER_DIR', get_template_directory());
define('GUYANA_AUTO_DEALER_URI', get_template_directory_uri());

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function guyana_auto_dealer_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add custom image sizes
    add_image_size('vehicle-thumbnail', 370, 250, true);
    add_image_size('vehicle-gallery', 800, 600, true);
    add_image_size('product-thumbnail', 300, 300, true);

    // This theme uses wp_nav_menu() in multiple locations.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'guyana-auto-dealer'),
        'footer' => esc_html__('Footer Menu', 'guyana-auto-dealer'),
    ));

    // Switch default core markup to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('guyana_auto_dealer_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'guyana_auto_dealer_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function guyana_auto_dealer_content_width() {
    $GLOBALS['content_width'] = apply_filters('guyana_auto_dealer_content_width', 1140);
}
add_action('after_setup_theme', 'guyana_auto_dealer_content_width', 0);

/**
 * Register widget area.
 */
function guyana_auto_dealer_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'guyana-auto-dealer'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'guyana-auto-dealer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Shop Sidebar', 'guyana-auto-dealer'),
        'id' => 'shop-sidebar',
        'description' => esc_html__('Add shop widgets here.', 'guyana-auto-dealer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Vehicle Sidebar', 'guyana-auto-dealer'),
        'id' => 'vehicle-sidebar',
        'description' => esc_html__('Add vehicle widgets here.', 'guyana-auto-dealer'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    // Register 4 footer widget areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name' => sprintf(esc_html__('Footer Widget %d', 'guyana-auto-dealer'), $i),
            'id' => 'footer-' . $i,
            'description' => sprintf(esc_html__('Add widgets to footer column %d.', 'guyana-auto-dealer'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="footer-widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
add_action('widgets_init', 'guyana_auto_dealer_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function guyana_auto_dealer_scripts() {
    // CSS files
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    wp_enqueue_style('guyana-auto-dealer-style', get_stylesheet_uri(), array(), GUYANA_AUTO_DEALER_VERSION);
    wp_enqueue_style('guyana-auto-dealer-responsive', GUYANA_AUTO_DEALER_URI . '/assets/css/responsive.css', array(), GUYANA_AUTO_DEALER_VERSION);
    
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('guyana-auto-dealer-woocommerce', GUYANA_AUTO_DEALER_URI . '/assets/css/woocommerce.css', array(), GUYANA_AUTO_DEALER_VERSION);
    }

    // JS files
    wp_enqueue_script('guyana-auto-dealer-navigation', GUYANA_AUTO_DEALER_URI . '/assets/js/main.js', array('jquery'), GUYANA_AUTO_DEALER_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'guyana_auto_dealer_scripts');

/**
 * Implement custom header feature.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/customizer.php';

/**
 * Custom Post Types.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/custom-post-types.php';

/**
 * Theme Options.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/theme-options.php';

/**
 * WooCommerce compatibility.
 */
if (class_exists('WooCommerce')) {
    require GUYANA_AUTO_DEALER_DIR . '/inc/woocommerce.php';
}

/**
 * Custom functions that act independently of the theme templates.
 */
require GUYANA_AUTO_DEALER_DIR . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require GUYANA_AUTO_DEALER_DIR . '/inc/jetpack.php';
}

/**
 * Custom breadcrumbs
 */
function guyana_auto_dealer_breadcrumbs() {
    // Settings
    $separator = '<span class="separator"> / </span>';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumbs';
    $home_title = esc_html__('Home', 'guyana-auto-dealer');

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {
        echo '<div id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
        echo '<span class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '" title="' . $home_title . '">' . $home_title . '</a></span>';
        echo $separator;

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            echo '<span class="breadcrumb-item current">' . post_type_archive_title('', false) . '</span>';
        } elseif (is_archive() && is_tax() && !is_category() && !is_tag()) {
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<span class="breadcrumb-item"><a href="' . esc_url($post_type_archive) . '">' . $post_type_object->labels->name . '</a></span>';
                echo $separator;
            }
            $custom_tax_name = get_queried_object()->name;
            echo '<span class="breadcrumb-item current">' . $custom_tax_name . '</span>';
        } elseif (is_single()) {
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<span class="breadcrumb-item"><a href="' . esc_url($post_type_archive) . '">' . $post_type_object->labels->name . '</a></span>';
                echo $separator;
            }
            // Get post category info
            $category = get_the_category();
            if (!empty($category)) {
                // Get last category post is in
                $last_category = end($category);
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= $parents;
                    $cat_display .= $separator;
                }
            }
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                if (!empty($taxonomy_terms)) {
                    $cat_id = $taxonomy_terms[0]->term_id;
                    $cat_nicename = $taxonomy_terms[0]->slug;
                    $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                    $cat_name = $taxonomy_terms[0]->name;
                }
            }
            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;
                echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
            } elseif (!empty($cat_id)) {
                echo '<span class="breadcrumb-item"><a href="' . esc_url($cat_link) . '">' . $cat_name . '</a></span>';
                echo $separator;
                echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
            } else {
                echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
            }
        } elseif (is_category()) {
            echo '<span class="breadcrumb-item current">' . single_cat_title('', false) . '</span>';
        } elseif (is_page()) {
            // Check if page has a parent
            if ($post->post_parent) {
                // Get all parents
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<span class="breadcrumb-item"><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></span>';
                    $parent_id = $page->post_parent;
                }
                // Display parent breadcrumbs in descending order
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    echo $separator;
                }
            }
            echo '<span class="breadcrumb-item current">' . get_the_title() . '</span>';
        } elseif (is_tag()) {
            // Tag being displayed
            echo '<span class="breadcrumb-item current">' . single_tag_title('', false) . '</span>';
        } elseif (is_day()) {
            // Day archive being displayed
            echo '<span class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></span>';
            echo $separator;
            echo '<span class="breadcrumb-item"><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a></span>';
            echo $separator;
            echo '<span class="breadcrumb-item current">' . get_the_time('d') . '</span>';
        } elseif (is_month()) {
            // Month archive being displayed
            echo '<span class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></span>';
            echo $separator;
            echo '<span class="breadcrumb-item current">' . get_the_time('F') . '</span>';
        } elseif (is_year()) {
            // Year archive being displayed
            echo '<span class="breadcrumb-item current">' . get_the_time('Y') . '</span>';
        } elseif (is_author()) {
            // Author archive being displayed
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="breadcrumb-item current">' . esc_html__('Author: ', 'guyana-auto-dealer') . $userdata->display_name . '</span>';
        } elseif (is_search()) {
            // Search results page
            echo '<span class="breadcrumb-item current">' . esc_html__('Search results for: ', 'guyana-auto-dealer') . get_search_query() . '</span>';
        } elseif (is_404()) {
            // 404 page
            echo '<span class="breadcrumb-item current">' . esc_html__('Error 404', 'guyana-auto-dealer') . '</span>';
        }

        echo '</div>';
    }
}

/**
 * Pagination function
 */
function guyana_auto_dealer_pagination() {
    global $wp_query;
    $big = 999999999; // Need an unlikely integer
    
    echo '<div class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<i class="fas fa-angle-left"></i>',
        'next_text' => '<i class="fas fa-angle-right"></i>',
    ));
    echo '</div>';
}

/**
 * Get social icons
 */
function guyana_auto_dealer_social_icons() {
    $facebook = get_theme_mod('social_facebook', '#');
    $twitter = get_theme_mod('social_twitter', '#');
    $instagram = get_theme_mod('social_instagram', '#');
    $linkedin = get_theme_mod('social_linkedin', '#');
    $youtube = get_theme_mod('social_youtube', '#');

    if ($facebook || $twitter || $instagram || $linkedin || $youtube) {
        echo '<div class="social-icons">';
        
        if ($facebook) {
            echo '<a href="' . esc_url($facebook) . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
        }
        
        if ($twitter) {
            echo '<a href="' . esc_url($twitter) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
        }
        
        if ($instagram) {
            echo '<a href="' . esc_url($instagram) . '" target="_blank"><i class="fab fa-instagram"></i></a>';
        }
        
        if ($linkedin) {
            echo '<a href="' . esc_url($linkedin) . '" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
        }
        
        if ($youtube) {
            echo '<a href="' . esc_url($youtube) . '" target="_blank"><i class="fab fa-youtube"></i></a>';
        }
        
        echo '</div>';
    }
}

/**
 * Display related vehicles
 */
function guyana_auto_dealer_related_vehicles($post_id, $related_count = 3) {
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => $related_count,
        'post_status' => 'publish',
        'post__not_in' => array($post_id),
        'orderby' => 'rand',
    );

    // Get current post terms
    $vehicle_makes = wp_get_post_terms($post_id, 'vehicle_make', array('fields' => 'ids'));
    $vehicle_models = wp_get_post_terms($post_id, 'vehicle_model', array('fields' => 'ids'));
    
    if (!empty($vehicle_makes) && !is_wp_error($vehicle_makes)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'vehicle_make',
            'field' => 'term_id',
            'terms' => $vehicle_makes,
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="related-vehicles">';
        echo '<h3>' . esc_html__('Related Vehicles', 'guyana-auto-dealer') . '</h3>';
        echo '<div class="vehicles-grid">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            get_template_part('template-parts/content', 'vehicle-card');
        }
        
        echo '</div>'; // .vehicles-grid
        echo '</div>'; // .related-vehicles
    }
    
    wp_reset_postdata();
}

/**
 * Ajax vehicle filter
 */
function guyana_auto_dealer_ajax_vehicle_filter() {
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => get_option('posts_per_page'),
        'post_status' => 'publish',
    );

    // Add paged parameter
    if (isset($_POST['paged'])) {
        $args['paged'] = $_POST['paged'];
    }

    // Add tax query if filters are set
    $tax_query = array();

    // Make filter
    if (isset($_POST['make']) && !empty($_POST['make'])) {
        $tax_query[] = array(
            'taxonomy' => 'vehicle_make',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['make']),
        );
    }

    // Model filter
    if (isset($_POST['model']) && !empty($_POST['model'])) {
        $tax_query[] = array(
            'taxonomy' => 'vehicle_model',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['model']),
        );
    }

    // Year filter
    if (isset($_POST['year']) && !empty($_POST['year'])) {
        $tax_query[] = array(
            'taxonomy' => 'vehicle_year',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['year']),
        );
    }

    // Type filter (new/used)
    if (isset($_POST['type']) && !empty($_POST['type'])) {
        $tax_query[] = array(
            'taxonomy' => 'vehicle_type',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['type']),
        );
    }

    // Add tax query to main query args
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Price range filter
    if (isset($_POST['min_price']) && !empty($_POST['min_price'])) {
        $args['meta_query'][] = array(
            'key' => 'vehicle_price',
            'value' => sanitize_text_field($_POST['min_price']),
            'type' => 'numeric',
            'compare' => '>=',
        );
    }

    if (isset($_POST['max_price']) && !empty($_POST['max_price'])) {
        $args['meta_query'][] = array(
            'key' => 'vehicle_price',
            'value' => sanitize_text_field($_POST['max_price']),
            'type' => 'numeric',
            'compare' => '<=',
        );
    }

    // Run the query
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        
        echo '<div class="vehicles-grid">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            get_template_part('template-parts/content', 'vehicle-card');
        }
        
        echo '</div>'; // .vehicles-grid

        // Pagination
        echo '<div class="pagination-wrapper">';
        echo paginate_links(array(
            'base' => '%_%',
            'format' => '?paged=%#%',
            'current' => max(1, $args['paged']),
            'total' => $query->max_num_pages,
            'prev_text' => '<i class="fas fa-angle-left"></i>',
            'next_text' => '<i class="fas fa-angle-right"></i>',
        ));
        echo '</div>';

        $html = ob_get_clean();
        wp_send_json_success($html);
    } else {
        wp_send_json_error(esc_html__('No vehicles found matching your criteria.', 'guyana-auto-dealer'));
    }

    wp_die();
}
add_action('wp_ajax_vehicle_filter', 'guyana_auto_dealer_ajax_vehicle_filter');
add_action('wp_ajax_nopriv_vehicle_filter', 'guyana_auto_dealer_ajax_vehicle_filter');

/**
 * Get all vehicle makes
 */
function guyana_auto_dealer_get_vehicle_makes() {
    $terms = get_terms(array(
        'taxonomy' => 'vehicle_make',
        'hide_empty' => true,
    ));

    return $terms;
}

/**
 * Get vehicle models by make
 */
function guyana_auto_dealer_get_vehicle_models_by_make($make_slug) {
    $terms = get_terms(array(
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

    return $terms;
}

/**
 * Get vehicle years
 */
function guyana_auto_dealer_get_vehicle_years() {
    $terms = get_terms(array(
        'taxonomy' => 'vehicle_year',
        'hide_empty' => true,
    ));

    return $terms;
}

/**
 * Get featured vehicles
 */
function guyana_auto_dealer_get_featured_vehicles($count = 6) {
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'vehicle_featured',
                'value' => '1',
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    return $query;
}

/**
 * Get latest vehicles
 */
function guyana_auto_dealer_get_latest_vehicles($count = 6) {
    $args = array(
        'post_type' => 'vehicle',
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);

    return $query;
}

/**
 * Format price
 */
function guyana_auto_dealer_format_price($price) {
    return 'GYD $' . number_format($price, 0, '.', ',');
}

/**
 * Get vehicle meta
 */
function guyana_auto_dealer_get_vehicle_meta($post_id, $field) {
    return get_post_meta($post_id, 'vehicle_' . $field, true);
}

/**
 * Check if a vehicle is featured
 */
function guyana_auto_dealer_is_vehicle_featured($post_id) {
    return get_post_meta($post_id, 'vehicle_featured', true) == '1';
}

/**
 * Vehicle inquiry form submission handler
 */
function guyana_auto_dealer_inquiry_form_handler() {
    if (isset($_POST['vehicle_inquiry_nonce']) && wp_verify_nonce($_POST['vehicle_inquiry_nonce'], 'vehicle_inquiry_action')) {
        $name = sanitize_text_field($_POST['inquiry_name']);
        $email = sanitize_email($_POST['inquiry_email']);
        $phone = sanitize_text_field($_POST['inquiry_phone']);
        $message = sanitize_textarea_field($_POST['inquiry_message']);
        $vehicle_id = intval($_POST['vehicle_id']);
        $vehicle_title = get_the_title($vehicle_id);

        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            wp_redirect(add_query_arg('inquiry', 'error', get_permalink($vehicle_id)));
            exit;
        }

        // Email recipient
        $to = get_option('admin_email');
        
        // Email subject
        $subject = sprintf(esc_html__('Vehicle Inquiry: %s', 'guyana-auto-dealer'), $vehicle_title);
        
        // Email content
        $body = sprintf(esc_html__('Name: %s', 'guyana-auto-dealer'), $name) . "\r\n\r\n";
        $body .= sprintf(esc_html__('Email: %s', 'guyana-auto-dealer'), $email) . "\r\n\r\n";
        $body .= sprintf(esc_html__('Phone: %s', 'guyana-auto-dealer'), $phone) . "\r\n\r\n";
        $body .= sprintf(esc_html__('Vehicle: %s (ID: %d)', 'guyana-auto-dealer'), $vehicle_title, $vehicle_id) . "\r\n\r\n";
        $body .= sprintf(esc_html__('Message: %s', 'guyana-auto-dealer'), $message);

        // Headers
        $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');

        // Send email
        $mail_sent = wp_mail($to, $subject, $body, $headers);

        if ($mail_sent) {
            wp_redirect(add_query_arg('inquiry', 'success', get_permalink($vehicle_id)));
        } else {
            wp_redirect(add_query_arg('inquiry', 'error', get_permalink($vehicle_id)));
        }
        exit;
    }
}
add_action('admin_post_vehicle_inquiry', 'guyana_auto_dealer_inquiry_form_handler');
add_action('admin_post_nopriv_vehicle_inquiry', 'guyana_auto_dealer_inquiry_form_handler');

/**
 * Display theme credit in footer
 */
function guyana_auto_dealer_footer_credit() {
    $copyright = get_theme_mod('footer_copyright', sprintf(esc_html__('© %s Guyana Auto Dealer. All Rights Reserved.', 'guyana-auto-dealer'), date('Y')));
    return $copyright;
}
