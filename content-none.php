<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Guyana_Auto_Dealer
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'guyana-auto-dealer'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :

            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'guyana-auto-dealer'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );

        elseif (is_search()) :
            ?>

            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'guyana-auto-dealer'); ?></p>
            <?php
            get_search_form();

        elseif (is_post_type_archive('vehicle')) :
            ?>

            <p><?php esc_html_e('No vehicles found. Try adjusting your search criteria or browse our categories.', 'guyana-auto-dealer'); ?></p>
            
            <div class="categories-wrapper">
                <div class="category-box">
                    <a href="<?php echo esc_url(home_url('/vehicle-type/new/')); ?>">
                        <div class="category-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3 class="category-title"><?php esc_html_e('New Vehicles', 'guyana-auto-dealer'); ?></h3>
                    </a>
                </div>
                
                <div class="category-box">
                    <a href="<?php echo esc_url(home_url('/vehicle-type/used/')); ?>">
                        <div class="category-icon">
                            <i class="fas fa-car-alt"></i>
                        </div>
                        <h3 class="category-title"><?php esc_html_e('Used Vehicles', 'guyana-auto-dealer'); ?></h3>
                    </a>
                </div>
                
                <div class="category-box">
                    <a href="<?php echo esc_url(home_url('/shop/')); ?>">
                        <div class="category-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="category-title"><?php esc_html_e('Auto Parts', 'guyana-auto-dealer'); ?></h3>
                    </a>
                </div>
                
                <div class="category-box">
                    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">
                        <div class="category-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="category-title"><?php esc_html_e('Customer Support', 'guyana-auto-dealer'); ?></h3>
                    </a>
                </div>
            </div>

        elseif (is_tax('vehicle_make') || is_tax('vehicle_model') || is_tax('vehicle_year') || is_tax('vehicle_type') || is_tax('vehicle_body')) :
            ?>

            <p><?php esc_html_e('No vehicles found in this category. Try checking other categories or use our search form.', 'guyana-auto-dealer'); ?></p>
            
            <div class="vehicle-search-form">
                <form action="<?php echo esc_url(home_url('/vehicles/')); ?>" method="get">
                    <div class="vehicle-search-row">
                        <div class="vehicle-search-col">
                            <input type="text" name="s" placeholder="<?php esc_attr_e('Search vehicles...', 'guyana-auto-dealer'); ?>" class="vehicle-search-input">
                            <input type="hidden" name="post_type" value="vehicle">
                        </div>
                        <div class="vehicle-search-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> <?php esc_html_e('Search', 'guyana-auto-dealer'); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        else :
            ?>

            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'guyana-auto-dealer'); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
