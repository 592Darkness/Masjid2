<?php
/**
 * The template for displaying single vehicle
 *
 * @package Guyana_Auto_Dealer
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while (have_posts()) :
            the_post();
            
            // Get vehicle meta data
            $price = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'price');
            $sale_price = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'sale_price');
            $gallery_images = get_post_meta(get_the_ID(), 'vehicle_gallery', true);
            $mileage = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'mileage');
            $engine = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'engine');
            $transmission = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'transmission');
            $fuel_type = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'fuel_type');
            $color = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'color');
            $interior_color = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'interior_color');
            $doors = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'doors');
            $seats = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'seats');
            $vin = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'vin');
            $stock_number = guyana_auto_dealer_get_vehicle_meta(get_the_ID(), 'stock_number');
            
            // Get taxonomies
            $make_terms = get_the_terms(get_the_ID(), 'vehicle_make');
            $model_terms = get_the_terms(get_the_ID(), 'vehicle_model');
            $year_terms = get_the_terms(get_the_ID(), 'vehicle_year');
            $type_terms = get_the_terms(get_the_ID(), 'vehicle_type');
            $body_terms = get_the_terms(get_the_ID(), 'vehicle_body');
            $feature_terms = get_the_terms(get_the_ID(), 'vehicle_feature');
            
            $make = !empty($make_terms) ? $make_terms[0]->name : '';
            $model = !empty($model_terms) ? $model_terms[0]->name : '';
            $year = !empty($year_terms) ? $year_terms[0]->name : '';
            $type = !empty($type_terms) ? $type_terms[0]->name : '';
            $body = !empty($body_terms) ? $body_terms[0]->name : '';
            ?>

            <header class="page-header">
                <div class="container">
                    <div class="page-header-content">
                        <h1 class="page-title">
                            <?php the_title(); ?>
                        </h1>
                        <?php guyana_auto_dealer_breadcrumbs(); ?>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="row clearfix">
                    <div class="<?php echo is_active_sidebar('vehicle-sidebar') ? 'content-area' : 'full-width'; ?>">

                        <article id="post-<?php the_ID(); ?>" <?php post_class('vehicle-single'); ?>>
                            <div class="vehicle-gallery">
                                <div class="vehicle-main-image">
                                    <?php 
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('vehicle-gallery');
                                    } else {
                                        echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/no-image.jpg') . '" alt="' . esc_attr__('No Image', 'guyana-auto-dealer') . '">';
                                    }
                                    ?>
                                </div>
                                
                                <?php if (!empty($gallery_images)) : ?>
                                    <div class="vehicle-thumbnails">
                                        <div class="vehicle-thumbnail active">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </div>
                                        
                                        <?php foreach ($gallery_images as $image_id) : ?>
                                            <div class="vehicle-thumbnail">
                                                <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="vehicle-title-price">
                                <h2 class="vehicle-single-title"><?php echo esc_html($year . ' ' . $make . ' ' . $model); ?></h2>
                                
                                <div class="vehicle-single-price">
                                    <?php
                                    if ($sale_price) {
                                        echo '<span class="old-price">' . guyana_auto_dealer_format_price($price) . '</span> ';
                                        echo guyana_auto_dealer_format_price($sale_price);
                                    } elseif ($price) {
                                        echo guyana_auto_dealer_format_price($price);
                                    } else {
                                        esc_html_e('Contact Us for Price', 'guyana-auto-dealer');
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="vehicle-single-meta">
                                <?php if ($type) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html($type); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Type', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($mileage) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-tachometer-alt"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html($mileage); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Mileage', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($engine) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html($engine); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Engine', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($transmission) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html(ucfirst($transmission)); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Transmission', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($fuel_type) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-gas-pump"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html(ucfirst($fuel_type)); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Fuel Type', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($color) : ?>
                                    <div class="vehicle-single-meta-item">
                                        <div class="vehicle-single-meta-icon">
                                            <i class="fas fa-palette"></i>
                                        </div>
                                        <div class="vehicle-single-meta-value"><?php echo esc_html($color); ?></div>
                                        <div class="vehicle-single-meta-label"><?php esc_html_e('Color', 'guyana-auto-dealer'); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="vehicle-description">
                                <h3><?php esc_html_e('Description', 'guyana-auto-dealer'); ?></h3>
                                <?php the_content(); ?>
                            </div>
                            
                            <div class="vehicle-details">
                                <h3><?php esc_html_e('Vehicle Details', 'guyana-auto-dealer'); ?></h3>
                                
                                <div class="vehicle-details-table">
                                    <table>
                                        <tbody>
                                            <?php if ($make) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Make', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($make); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($model) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Model', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($model); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($year) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Year', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($year); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($body) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Body Style', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($body); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($doors) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Doors', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($doors); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($seats) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Seats', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($seats); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($interior_color) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Interior Color', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($interior_color); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($vin) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('VIN', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($vin); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php if ($stock_number) : ?>
                                                <tr>
                                                    <th><?php esc_html_e('Stock Number', 'guyana-auto-dealer'); ?></th>
                                                    <td><?php echo esc_html($stock_number); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <?php if (!empty($feature_terms)) : ?>
                                <div class="vehicle-features">
                                    <h3><?php esc_html_e('Features', 'guyana-auto-dealer'); ?></h3>
                                    
                                    <ul class="vehicle-features-list">
                                        <?php foreach ($feature_terms as $feature) : ?>
                                            <li><?php echo esc_html($feature->name); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            
                            <div class="vehicle-actions-single">
                                <?php
                                $phone = get_theme_mod('contact_phone', '+592 123 4567');
                                ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn-primary btn-large btn-icon">
                                    <i class="fas fa-phone-alt"></i> <?php esc_html_e('Call Us', 'guyana-auto-dealer'); ?>
                                </a>
                                
                                <button type="button" class="btn btn-secondary btn-large btn-icon inquiry-trigger">
                                    <i class="fas fa-envelope"></i> <?php esc_html_e('Send Inquiry', 'guyana-auto-dealer'); ?>
                                </button>
                            </div>
                            
                            <!-- Inquiry Form Modal -->
                            <div class="inquiry-form-modal">
                                <div class="inquiry-form-container">
                                    <div class="inquiry-form-header">
                                        <h3><?php esc_html_e('Vehicle Inquiry', 'guyana-auto-dealer'); ?></h3>
                                        <button type="button" class="inquiry-close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="inquiry-form-content">
                                        <p><?php esc_html_e('Please fill out the form below and we will get back to you shortly.', 'guyana-auto-dealer'); ?></p>
                                        
                                        <?php
                                        // Show success/error message if inquiry was submitted
                                        if (isset($_GET['inquiry']) && $_GET['inquiry'] == 'success') {
                                            echo '<div class="form-message success">' . esc_html__('Thank you for your inquiry. We will contact you shortly.', 'guyana-auto-dealer') . '</div>';
                                        } elseif (isset($_GET['inquiry']) && $_GET['inquiry'] == 'error') {
                                            echo '<div class="form-message error">' . esc_html__('There was an error sending your inquiry. Please try again.', 'guyana-auto-dealer') . '</div>';
                                        }
                                        ?>
                                        
                                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="inquiry-form">
                                            <input type="hidden" name="action" value="vehicle_inquiry">
                                            <input type="hidden" name="vehicle_id" value="<?php echo get_the_ID(); ?>">
                                            <?php wp_nonce_field('vehicle_inquiry_action', 'vehicle_inquiry_nonce'); ?>
                                            
                                            <div class="form-row">
                                                <div class="form-col">
                                                    <div class="form-field required">
                                                        <label for="inquiry_name"><?php esc_html_e('Your Name', 'guyana-auto-dealer'); ?></label>
                                                        <input type="text" id="inquiry_name" name="inquiry_name" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-col">
                                                    <div class="form-field required">
                                                        <label for="inquiry_email"><?php esc_html_e('Your Email', 'guyana-auto-dealer'); ?></label>
                                                        <input type="email" id="inquiry_email" name="inquiry_email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-field">
                                                <label for="inquiry_phone"><?php esc_html_e('Your Phone', 'guyana-auto-dealer'); ?></label>
                                                <input type="tel" id="inquiry_phone" name="inquiry_phone">
                                            </div>
                                            
                                            <div class="form-field required">
                                                <label for="inquiry_message"><?php esc_html_e('Your Message', 'guyana-auto-dealer'); ?></label>
                                                <textarea id="inquiry_message" name="inquiry_message" rows="5" required><?php echo esc_textarea(sprintf(__('I am interested in the %s %s %s. Please contact me with more information.', 'guyana-auto-dealer'), $year, $make, $model)); ?></textarea>
                                            </div>
                                            
                                            <div class="form-field">
                                                <button type="submit" class="btn btn-primary btn-large btn-block">
                                                    <?php esc_html_e('Send Inquiry', 'guyana-auto-dealer'); ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <?php
                        // Related vehicles
                        guyana_auto_dealer_related_vehicles(get_the_ID(), 3);
                        ?>

                    </div>

                    <?php if (is_active_sidebar('vehicle-sidebar')) : ?>
                        <div class="widget-area">
                            <?php dynamic_sidebar('vehicle-sidebar'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
