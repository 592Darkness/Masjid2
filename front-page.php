<?php
/**
 * The template for displaying the front page
 *
 * @package Guyana_Auto_Dealer
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Hero Banner
        $hero_title = get_theme_mod('hero_title', __('Find Your Perfect Vehicle', 'guyana-auto-dealer'));
        $hero_subtitle = get_theme_mod('hero_subtitle', __('Guyana\'s Premier Auto Dealer', 'guyana-auto-dealer'));
        $hero_image = get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/hero-banner.jpg');
        ?>
        <section class="hero-banner" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    
                    <!-- Quick Search Form -->
                    <div class="quick-search-form">
                        <form action="<?php echo esc_url(home_url('/vehicles/')); ?>" method="get">
                            <div class="quick-search-row">
                                <div class="quick-search-col">
                                    <select name="vehicle_make" id="quick-make">
                                        <option value=""><?php esc_html_e('All Makes', 'guyana-auto-dealer'); ?></option>
                                        <?php
                                        $makes = get_terms(array(
                                            'taxonomy' => 'vehicle_make',
                                            'hide_empty' => true,
                                        ));
                                        
                                        if (!empty($makes) && !is_wp_error($makes)) {
                                            foreach ($makes as $make) {
                                                echo '<option value="' . esc_attr($make->slug) . '">' . esc_html($make->name) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="quick-search-col">
                                    <select name="vehicle_type" id="quick-type">
                                        <option value=""><?php esc_html_e('All Types', 'guyana-auto-dealer'); ?></option>
                                        <option value="new"><?php esc_html_e('New', 'guyana-auto-dealer'); ?></option>
                                        <option value="used"><?php esc_html_e('Used', 'guyana-auto-dealer'); ?></option>
                                    </select>
                                </div>
                                
                                <div class="quick-search-col">
                                    <select name="min_price" id="quick-min-price">
                                        <option value=""><?php esc_html_e('Min Price', 'guyana-auto-dealer'); ?></option>
                                        <option value="500000">GYD $500,000</option>
                                        <option value="1000000">GYD $1,000,000</option>
                                        <option value="2000000">GYD $2,000,000</option>
                                        <option value="3000000">GYD $3,000,000</option>
                                        <option value="5000000">GYD $5,000,000</option>
                                        <option value="8000000">GYD $8,000,000</option>
                                    </select>
                                </div>
                                
                                <div class="quick-search-col">
                                    <select name="max_price" id="quick-max-price">
                                        <option value=""><?php esc_html_e('Max Price', 'guyana-auto-dealer'); ?></option>
                                        <option value="1000000">GYD $1,000,000</option>
                                        <option value="2000000">GYD $2,000,000</option>
                                        <option value="3000000">GYD $3,000,000</option>
                                        <option value="5000000">GYD $5,000,000</option>
                                        <option value="8000000">GYD $8,000,000</option>
                                        <option value="10000000">GYD $10,000,000</option>
                                        <option value="15000000">GYD $15,000,000</option>
                                    </select>
                                </div>
                                
                                <div class="quick-search-submit">
                                    <button type="submit" class="btn btn-secondary btn-large">
                                        <i class="fas fa-search"></i> <?php esc_html_e('Search', 'guyana-auto-dealer'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vehicle Categories -->
        <section class="vehicle-categories">
            <div class="container">
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
            </div>
        </section>

        <!-- Featured Vehicles -->
        <section class="featured-section featured-vehicles-section">
            <div class="container">
                <div class="featured-section-title">
                    <span class="section-title-main"><?php esc_html_e('Featured Vehicles', 'guyana-auto-dealer'); ?></span>
                    <span class="section-title-sub"><?php esc_html_e('Explore our premium selection of quality vehicles', 'guyana-auto-dealer'); ?></span>
                </div>
                
                <?php
                $featured_vehicles = guyana_auto_dealer_get_featured_vehicles(6);
                
                if ($featured_vehicles->have_posts()) :
                    echo '<div class="vehicles-grid">';
                    
                    while ($featured_vehicles->have_posts()) :
                        $featured_vehicles->the_post();
                        get_template_part('template-parts/content', 'vehicle-card');
                    endwhile;
                    
                    echo '</div>';
                    
                    wp_reset_postdata();
                else :
                    echo '<p class="no-vehicles">' . esc_html__('No featured vehicles found.', 'guyana-auto-dealer') . '</p>';
                endif;
                ?>
                
                <div class="featured-section-footer">
                    <a href="<?php echo esc_url(home_url('/vehicles/')); ?>" class="btn btn-primary btn-large">
                        <?php esc_html_e('View All Vehicles', 'guyana-auto-dealer'); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- Popular Car Makes -->
        <section class="makes-section">
            <div class="container">
                <div class="featured-section-title">
                    <span class="section-title-main"><?php esc_html_e('Popular Makes', 'guyana-auto-dealer'); ?></span>
                    <span class="section-title-sub"><?php esc_html_e('Explore vehicles by manufacturer', 'guyana-auto-dealer'); ?></span>
                </div>
                
                <div class="makes-grid">
                    <?php
                    $makes = get_terms(array(
                        'taxonomy' => 'vehicle_make',
                        'hide_empty' => true,
                        'number' => 8,
                    ));
                    
                    if (!empty($makes) && !is_wp_error($makes)) {
                        foreach ($makes as $make) {
                            $make_image_id = get_term_meta($make->term_id, 'make_image', true);
                            $make_image = $make_image_id ? wp_get_attachment_image_url($make_image_id, 'thumbnail') : '';
                            ?>
                            <div class="make-box">
                                <a href="<?php echo esc_url(get_term_link($make)); ?>">
                                    <?php if ($make_image) : ?>
                                        <img src="<?php echo esc_url($make_image); ?>" alt="<?php echo esc_attr($make->name); ?>">
                                    <?php else : ?>
                                        <div class="make-icon">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="make-title"><?php echo esc_html($make->name); ?></h3>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php if (class_exists('WooCommerce')) : ?>
        <!-- Popular Car Parts -->
        <section class="featured-section featured-parts-section">
            <div class="container">
                <div class="featured-section-title">
                    <span class="section-title-main"><?php esc_html_e('Featured Auto Parts', 'guyana-auto-dealer'); ?></span>
                    <span class="section-title-sub"><?php esc_html_e('Quality parts for your vehicle maintenance needs', 'guyana-auto-dealer'); ?></span>
                </div>
                
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    echo '<ul class="products">';
                    
                    while ($products->have_posts()) :
                        $products->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                    
                    echo '</ul>';
                    
                    wp_reset_postdata();
                else :
                    echo '<p class="no-products">' . esc_html__('No featured products found.', 'guyana-auto-dealer') . '</p>';
                endif;
                ?>
                
                <div class="featured-section-footer">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary btn-large">
                        <?php esc_html_e('Shop All Parts', 'guyana-auto-dealer'); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Why Choose Us -->
        <section class="why-choose-section">
            <div class="container">
                <div class="featured-section-title">
                    <span class="section-title-main"><?php esc_html_e('Why Choose Us', 'guyana-auto-dealer'); ?></span>
                    <span class="section-title-sub"><?php esc_html_e('Reasons to trust Guyana Auto Dealer for your next vehicle purchase', 'guyana-auto-dealer'); ?></span>
                </div>
                
                <div class="featured-boxes">
                    <div class="featured-box">
                        <div class="featured-box-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/quality-vehicles.jpg'); ?>" alt="<?php esc_attr_e('Quality Vehicles', 'guyana-auto-dealer'); ?>">
                        </div>
                        <div class="featured-box-content">
                            <h3 class="featured-box-title"><?php esc_html_e('Quality Vehicles', 'guyana-auto-dealer'); ?></h3>
                            <div class="featured-box-text">
                                <?php esc_html_e('We meticulously inspect and verify all our vehicles to ensure you get only the best quality.', 'guyana-auto-dealer'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="featured-box">
                        <div class="featured-box-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/genuine-parts.jpg'); ?>" alt="<?php esc_attr_e('Genuine Parts', 'guyana-auto-dealer'); ?>">
                        </div>
                        <div class="featured-box-content">
                            <h3 class="featured-box-title"><?php esc_html_e('Genuine Parts', 'guyana-auto-dealer'); ?></h3>
                            <div class="featured-box-text">
                                <?php esc_html_e('We stock only authentic and genuine auto parts to ensure reliability and performance.', 'guyana-auto-dealer'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="featured-box">
                        <div class="featured-box-image">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/customer-service.jpg'); ?>" alt="<?php esc_attr_e('Exceptional Service', 'guyana-auto-dealer'); ?>">
                        </div>
                        <div class="featured-box-content">
                            <h3 class="featured-box-title"><?php esc_html_e('Exceptional Service', 'guyana-auto-dealer'); ?></h3>
                            <div class="featured-box-text">
                                <?php esc_html_e('Our dedicated team provides personalized service to meet your automotive needs.', 'guyana-auto-dealer'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testimonials-section">
            <div class="container">
                <div class="featured-section-title">
                    <span class="section-title-main"><?php esc_html_e('Customer Testimonials', 'guyana-auto-dealer'); ?></span>
                    <span class="section-title-sub"><?php esc_html_e('What our satisfied customers have to say', 'guyana-auto-dealer'); ?></span>
                </div>
                
                <div class="testimonials-slider">
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p><?php esc_html_e('I found my dream car at Guyana Auto Dealer. The staff was knowledgeable and helped me through the entire buying process. I couldn\'t be happier with my purchase!', 'guyana-auto-dealer'); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonial-1.jpg'); ?>" alt="<?php esc_attr_e('Customer 1', 'guyana-auto-dealer'); ?>">
                            </div>
                            <div class="testimonial-author-info">
                                <h4><?php esc_html_e('David Singh', 'guyana-auto-dealer'); ?></h4>
                                <span><?php esc_html_e('Georgetown', 'guyana-auto-dealer'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p><?php esc_html_e('The selection of auto parts is extensive, and their prices are very competitive. Fast delivery and great customer service. Highly recommended for all your vehicle needs!', 'guyana-auto-dealer'); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonial-2.jpg'); ?>" alt="<?php esc_attr_e('Customer 2', 'guyana-auto-dealer'); ?>">
                            </div>
                            <div class="testimonial-author-info">
                                <h4><?php esc_html_e('Sarah Williams', 'guyana-auto-dealer'); ?></h4>
                                <span><?php esc_html_e('New Amsterdam', 'guyana-auto-dealer'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <p><?php esc_html_e('I\'ve been a loyal customer for years. Their after-sales service is exceptional, and they truly care about customer satisfaction. The team goes above and beyond!', 'guyana-auto-dealer'); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonial-3.jpg'); ?>" alt="<?php esc_attr_e('Customer 3', 'guyana-auto-dealer'); ?>">
                            </div>
                            <div class="testimonial-author-info">
                                <h4><?php esc_html_e('Michael Rodriguez', 'guyana-auto-dealer'); ?></h4>
                                <span><?php esc_html_e('Linden', 'guyana-auto-dealer'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2 class="cta-title"><?php esc_html_e('Ready to find your next vehicle?', 'guyana-auto-dealer'); ?></h2>
                    <p class="cta-text"><?php esc_html_e('Visit our showroom today or browse our online inventory to discover great deals on quality vehicles and auto parts.', 'guyana-auto-dealer'); ?></p>
                    <div class="cta-buttons">
                        <a href="<?php echo esc_url(home_url('/vehicles/')); ?>" class="btn btn-secondary btn-large"><?php esc_html_e('View Inventory', 'guyana-auto-dealer'); ?></a>
                        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="btn btn-outline btn-large"><?php esc_html_e('Contact Us', 'guyana-auto-dealer'); ?></a>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // If the page has content
        while (have_posts()) :
            the_post();
            
            if (get_the_content()) :
                ?>
                <section class="page-content-section">
                    <div class="container">
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
                <?php
            endif;
            
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
