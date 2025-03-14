<?php
/**
 * The header for our theme
 *
 * @package Guyana_Auto_Dealer
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'guyana-auto-dealer'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <div class="header-contact-info">
                        <?php 
                        $phone = get_theme_mod('contact_phone', '+592 123 4567');
                        $email = get_theme_mod('contact_email', 'info@guyanaauto.com');
                        $address = get_theme_mod('contact_address', 'Georgetown, Guyana');
                        $hours = get_theme_mod('contact_hours', 'Mon - Fri: 8:00 - 17:00');
                        
                        if ($phone) {
                            echo '<div class="header-phone"><i class="fas fa-phone-alt"></i>' . esc_html($phone) . '</div>';
                        }
                        
                        if ($email) {
                            echo '<div class="header-email"><i class="fas fa-envelope"></i>' . esc_html($email) . '</div>';
                        }
                        
                        if ($hours) {
                            echo '<div class="header-hours"><i class="fas fa-clock"></i>' . esc_html($hours) . '</div>';
                        }
                        ?>
                    </div>
                    <div class="header-social-icons">
                        <?php guyana_auto_dealer_social_icons(); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="header-main">
            <div class="container">
                <div class="header-container">
                    <div class="site-branding">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php
                            $guyana_auto_dealer_description = get_bloginfo('description', 'display');
                            if ($guyana_auto_dealer_description || is_customize_preview()) {
                                ?>
                                <p class="site-description"><?php echo $guyana_auto_dealer_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                                <?php
                            }
                        }
                        ?>
                    </div><!-- .site-branding -->

                    <div class="header-actions">
                        <?php if (class_exists('WooCommerce')) : ?>
                            <div class="header-search-toggle">
                                <i class="fas fa-search"></i>
                            </div>
                            
                            <div class="header-search-form">
                                <?php get_search_form(); ?>
                            </div>
                            
                            <div class="header-cart">
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <nav id="site-navigation" class="main-navigation">
            <div class="container">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'main-menu',
                    'container' => false,
                ));
                ?>
            </div>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
