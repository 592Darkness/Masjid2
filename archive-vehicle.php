<?php
/**
 * The template for displaying vehicle archive pages
 *
 * @package Guyana_Auto_Dealer
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <div class="container">
                <div class="page-header-content">
                    <h1 class="page-title">
                        <?php
                        if (is_tax()) {
                            $term = get_queried_object();
                            if ($term->taxonomy == 'vehicle_make') {
                                /* translators: %s: Vehicle make name */
                                printf(esc_html__('%s Vehicles', 'guyana-auto-dealer'), $term->name);
                            } elseif ($term->taxonomy == 'vehicle_model') {
                                /* translators: %s: Vehicle model name */
                                printf(esc_html__('%s Models', 'guyana-auto-dealer'), $term->name);
                            } elseif ($term->taxonomy == 'vehicle_year') {
                                /* translators: %s: Vehicle year */
                                printf(esc_html__('%s Year Models', 'guyana-auto-dealer'), $term->name);
                            } elseif ($term->taxonomy == 'vehicle_type') {
                                if ($term->slug == 'new') {
                                    esc_html_e('New Vehicles', 'guyana-auto-dealer');
                                } elseif ($term->slug == 'used') {
                                    esc_html_e('Used Vehicles', 'guyana-auto-dealer');
                                } else {
                                    echo esc_html($term->name);
                                }
                            } elseif ($term->taxonomy == 'vehicle_body') {
                                /* translators: %s: Vehicle body style name */
                                printf(esc_html__('%s Vehicles', 'guyana-auto-dealer'), $term->name);
                            } else {
                                echo esc_html($term->name);
                            }
                        } else {
                            esc_html_e('All Vehicles', 'guyana-auto-dealer');
                        }
                        ?>
                    </h1>
                    <?php guyana_auto_dealer_breadcrumbs(); ?>
                </div>
            </div>
        </header>

        <div class="container">
            <!-- Vehicle Search Form -->
            <div class="vehicle-search-form">
                <form action="<?php echo esc_url(home_url('/vehicles/')); ?>" method="get" id="vehicle-filter-form">
                    <div class="vehicle-search-row">
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Make', 'guyana-auto-dealer'); ?></label>
                            <select name="vehicle_make" id="vehicle_make" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('All Makes', 'guyana-auto-dealer'); ?></option>
                                <?php
                                $makes = get_terms(array(
                                    'taxonomy' => 'vehicle_make',
                                    'hide_empty' => true,
                                ));
                                
                                $selected_make = isset($_GET['vehicle_make']) ? sanitize_text_field($_GET['vehicle_make']) : '';
                                
                                if (!empty($makes) && !is_wp_error($makes)) {
                                    foreach ($makes as $make) {
                                        printf(
                                            '<option value="%s" %s>%s</option>',
                                            esc_attr($make->slug),
                                            selected($selected_make, $make->slug, false),
                                            esc_html($make->name)
                                        );
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Model', 'guyana-auto-dealer'); ?></label>
                            <select name="vehicle_model" id="vehicle_model" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('All Models', 'guyana-auto-dealer'); ?></option>
                                <?php
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
                                    
                                    $selected_model = isset($_GET['vehicle_model']) ? sanitize_text_field($_GET['vehicle_model']) : '';
                                    
                                    if (!empty($models) && !is_wp_error($models)) {
                                        foreach ($models as $model) {
                                            printf(
                                                '<option value="%s" %s>%s</option>',
                                                esc_attr($model->slug),
                                                selected($selected_model, $model->slug, false),
                                                esc_html($model->name)
                                            );
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Year', 'guyana-auto-dealer'); ?></label>
                            <select name="vehicle_year" id="vehicle_year" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('All Years', 'guyana-auto-dealer'); ?></option>
                                <?php
                                $years = get_terms(array(
                                    'taxonomy' => 'vehicle_year',
                                    'hide_empty' => true,
                                    'orderby' => 'name',
                                    'order' => 'DESC',
                                ));
                                
                                $selected_year = isset($_GET['vehicle_year']) ? sanitize_text_field($_GET['vehicle_year']) : '';
                                
                                if (!empty($years) && !is_wp_error($years)) {
                                    foreach ($years as $year) {
                                        printf(
                                            '<option value="%s" %s>%s</option>',
                                            esc_attr($year->slug),
                                            selected($selected_year, $year->slug, false),
                                            esc_html($year->name)
                                        );
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Type', 'guyana-auto-dealer'); ?></label>
                            <select name="vehicle_type" id="vehicle_type" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('All Types', 'guyana-auto-dealer'); ?></option>
                                <?php
                                $types = get_terms(array(
                                    'taxonomy' => 'vehicle_type',
                                    'hide_empty' => true,
                                ));
                                
                                $selected_type = isset($_GET['vehicle_type']) ? sanitize_text_field($_GET['vehicle_type']) : '';
                                
                                if (!empty($types) && !is_wp_error($types)) {
                                    foreach ($types as $type) {
                                        printf(
                                            '<option value="%s" %s>%s</option>',
                                            esc_attr($type->slug),
                                            selected($selected_type, $type->slug, false),
                                            esc_html($type->name)
                                        );
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="vehicle-search-row">
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Min Price', 'guyana-auto-dealer'); ?></label>
                            <select name="min_price" id="min_price" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('No Min', 'guyana-auto-dealer'); ?></option>
                                <option value="500000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '500000'); ?>>GYD $500,000</option>
                                <option value="1000000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '1000000'); ?>>GYD $1,000,000</option>
                                <option value="2000000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '2000000'); ?>>GYD $2,000,000</option>
                                <option value="3000000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '3000000'); ?>>GYD $3,000,000</option>
                                <option value="5000000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '5000000'); ?>>GYD $5,000,000</option>
                                <option value="8000000" <?php selected(isset($_GET['min_price']) ? $_GET['min_price'] : '', '8000000'); ?>>GYD $8,000,000</option>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Max Price', 'guyana-auto-dealer'); ?></label>
                            <select name="max_price" id="max_price" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('No Max', 'guyana-auto-dealer'); ?></option>
                                <option value="1000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '1000000'); ?>>GYD $1,000,000</option>
                                <option value="2000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '2000000'); ?>>GYD $2,000,000</option>
                                <option value="3000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '3000000'); ?>>GYD $3,000,000</option>
                                <option value="5000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '5000000'); ?>>GYD $5,000,000</option>
                                <option value="8000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '8000000'); ?>>GYD $8,000,000</option>
                                <option value="10000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '10000000'); ?>>GYD $10,000,000</option>
                                <option value="15000000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '15000000'); ?>>GYD $15,000,000</option>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Body Style', 'guyana-auto-dealer'); ?></label>
                            <select name="vehicle_body" id="vehicle_body" class="vehicle-search-select">
                                <option value=""><?php esc_html_e('All Body Styles', 'guyana-auto-dealer'); ?></option>
                                <?php
                                $bodies = get_terms(array(
                                    'taxonomy' => 'vehicle_body',
                                    'hide_empty' => true,
                                ));
                                
                                $selected_body = isset($_GET['vehicle_body']) ? sanitize_text_field($_GET['vehicle_body']) : '';
                                
                                if (!empty($bodies) && !is_wp_error($bodies)) {
                                    foreach ($bodies as $body) {
                                        printf(
                                            '<option value="%s" %s>%s</option>',
                                            esc_attr($body->slug),
                                            selected($selected_body, $body->slug, false),
                                            esc_html($body->name)
                                        );
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="vehicle-search-col">
                            <label class="vehicle-search-label"><?php esc_html_e('Sort By', 'guyana-auto-dealer'); ?></label>
                            <select name="orderby" id="orderby" class="vehicle-search-select">
                                <option value="date" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date'); ?>><?php esc_html_e('Newest First', 'guyana-auto-dealer'); ?></option>
                                <option value="price-low" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price-low'); ?>><?php esc_html_e('Price (Low to High)', 'guyana-auto-dealer'); ?></option>
                                <option value="price-high" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price-high'); ?>><?php esc_html_e('Price (High to Low)', 'guyana-auto-dealer'); ?></option>
                                <option value="title" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'title'); ?>><?php esc_html_e('Name (A-Z)', 'guyana-auto-dealer'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="vehicle-search-actions">
                        <button type="reset" class="btn btn-outline vehicle-search-reset">
                            <?php esc_html_e('Reset', 'guyana-auto-dealer'); ?>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> <?php esc_html_e('Search', 'guyana-auto-dealer'); ?>
                        </button>
                    </div>
                </form>
            </div>

            <div class="row clearfix">
                <div class="<?php echo is_active_sidebar('vehicle-sidebar') ? 'content-area' : 'full-width'; ?>">
                    <div id="vehicle-results">
                        <?php if (have_posts()) : ?>
                            <div class="vehicles-grid">
                                <?php
                                /* Start the Loop */
                                while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'vehicle-card');

                                endwhile;
                                ?>
                            </div>

                            <?php
                            // Pagination
                            guyana_auto_dealer_pagination();
                            ?>

                        <?php else : ?>

                            <p class="no-vehicles"><?php esc_html_e('No vehicles found matching your criteria.', 'guyana-auto-dealer'); ?></p>

                        <?php endif; ?>
                    </div>
                </div>

                <?php if (is_active_sidebar('vehicle-sidebar')) : ?>
                    <div class="widget-area">
                        <?php get_sidebar('vehicle'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
