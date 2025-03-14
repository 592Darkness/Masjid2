<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Guyana_Auto_Dealer
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="error-404 not-found">
            <header class="page-header">
                <div class="container">
                    <div class="page-header-content">
                        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'guyana-auto-dealer'); ?></h1>
                        <?php guyana_auto_dealer_breadcrumbs(); ?>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="error-content">
                    <div class="error-image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/404.svg'); ?>" alt="<?php esc_attr_e('404 Not Found', 'guyana-auto-dealer'); ?>">
                    </div>
                    
                    <div class="page-content">
                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search or check out some of our popular pages below.', 'guyana-auto-dealer'); ?></p>

                        <?php get_search_form(); ?>

                        <div class="error-suggestions">
                            <div class="error-suggestion-col">
                                <h2><?php esc_html_e('Vehicles', 'guyana-auto-dealer'); ?></h2>
                                <ul>
                                    <li><a href="<?php echo esc_url(home_url('/vehicles/')); ?>"><?php esc_html_e('All Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/vehicle-type/new/')); ?>"><?php esc_html_e('New Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/vehicle-type/used/')); ?>"><?php esc_html_e('Used Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                </ul>
                            </div>
                            
                            <div class="error-suggestion-col">
                                <h2><?php esc_html_e('Popular Makes', 'guyana-auto-dealer'); ?></h2>
                                <ul>
                                    <?php
                                    $makes = get_terms(array(
                                        'taxonomy' => 'vehicle_make',
                                        'orderby' => 'count',
                                        'order' => 'DESC',
                                        'number' => 5,
                                        'hide_empty' => true,
                                    ));
                                    
                                    if (!empty($makes) && !is_wp_error($makes)) {
                                        foreach ($makes as $make) {
                                            echo '<li><a href="' . esc_url(get_term_link($make)) . '">' . esc_html($make->name) . '</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <?php if (class_exists('WooCommerce')) : ?>
                                <div class="error-suggestion-col">
                                    <h2><?php esc_html_e('Auto Parts', 'guyana-auto-dealer'); ?></h2>
                                    <ul>
                                        <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('All Products', 'guyana-auto-dealer'); ?></a></li>
                                        <?php
                                        $product_cats = get_terms(array(
                                            'taxonomy' => 'product_cat',
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 3,
                                            'hide_empty' => true,
                                        ));
                                        
                                        if (!empty($product_cats) && !is_wp_error($product_cats)) {
                                            foreach ($product_cats as $cat) {
                                                echo '<li><a href="' . esc_url(get_term_link($cat)) . '">' . esc_html($cat->name) . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            
                            <div class="error-suggestion-col">
                                <h2><?php esc_html_e('Information', 'guyana-auto-dealer'); ?></h2>
                                <ul>
                                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'guyana-auto-dealer'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('About Us', 'guyana-auto-dealer'); ?></a></li>
                                    <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact Us', 'guyana-auto-dealer'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
