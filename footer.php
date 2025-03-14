<?php
/**
 * The template for displaying the footer
 *
 * @package Guyana_Auto_Dealer
 */

?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <?php if (get_theme_mod('footer_logo')) : ?>
                                <img class="footer-logo" src="<?php echo esc_url(get_theme_mod('footer_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <?php else : ?>
                                <h3 class="footer-widget-title"><?php bloginfo('name'); ?></h3>
                            <?php endif; ?>
                            
                            <p><?php echo esc_html(get_theme_mod('footer_about', 'Guyana Auto Dealer is your trusted source for quality vehicles and auto parts in Guyana. We offer a wide selection of new and used cars, trucks, SUVs, and genuine auto parts.')); ?></p>
                            
                            <?php guyana_auto_dealer_social_icons(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h3 class="footer-widget-title"><?php esc_html_e('Quick Links', 'guyana-auto-dealer'); ?></h3>
                            <ul>
                                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/vehicles/')); ?>"><?php esc_html_e('Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/shop/')); ?>"><?php esc_html_e('Auto Parts', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('About Us', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact Us', 'guyana-auto-dealer'); ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h3 class="footer-widget-title"><?php esc_html_e('Vehicles', 'guyana-auto-dealer'); ?></h3>
                            <ul>
                                <li><a href="<?php echo esc_url(home_url('/vehicle-type/new/')); ?>"><?php esc_html_e('New Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/vehicle-type/used/')); ?>"><?php esc_html_e('Used Vehicles', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/vehicle-make/toyota/')); ?>"><?php esc_html_e('Toyota', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/vehicle-make/honda/')); ?>"><?php esc_html_e('Honda', 'guyana-auto-dealer'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/vehicle-make/nissan/')); ?>"><?php esc_html_e('Nissan', 'guyana-auto-dealer'); ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <?php dynamic_sidebar('footer-4'); ?>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h3 class="footer-widget-title"><?php esc_html_e('Contact Us', 'guyana-auto-dealer'); ?></h3>
                            <ul class="footer-contact-info">
                                <?php 
                                $address = get_theme_mod('contact_address', 'Georgetown, Guyana');
                                $phone = get_theme_mod('contact_phone', '+592 123 4567');
                                $email = get_theme_mod('contact_email', 'info@guyanaauto.com');
                                $hours = get_theme_mod('contact_hours', 'Mon - Fri: 8:00 - 17:00');
                                
                                if ($address) {
                                    echo '<li><i class="fas fa-map-marker-alt"></i>' . esc_html($address) . '</li>';
                                }
                                
                                if ($phone) {
                                    echo '<li><i class="fas fa-phone-alt"></i>' . esc_html($phone) . '</li>';
                                }
                                
                                if ($email) {
                                    echo '<li><i class="fas fa-envelope"></i>' . esc_html($email) . '</li>';
                                }
                                
                                if ($hours) {
                                    echo '<li><i class="fas fa-clock"></i>' . esc_html($hours) . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <?php if (has_nav_menu('footer')) : ?>
                    <nav class="footer-nav">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class' => 'footer-menu',
                            'container' => false,
                            'depth' => 1,
                        ));
                        ?>
                    </nav>
                <?php endif; ?>
                
                <div class="footer-copyright">
                    <?php echo guyana_auto_dealer_footer_credit(); ?>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
