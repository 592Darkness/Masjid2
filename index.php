<?php
/**
 * The main template file
 *
 * @package Guyana_Auto_Dealer
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <header class="page-header">
                <div class="container">
                    <div class="page-header-content">
                        <h1 class="page-title">
                            <?php
                            if (is_home() && !is_front_page()) {
                                single_post_title();
                            } else {
                                esc_html_e('Latest News', 'guyana-auto-dealer');
                            }
                            ?>
                        </h1>
                        <?php guyana_auto_dealer_breadcrumbs(); ?>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="row clearfix">
                    <div class="<?php echo is_active_sidebar('sidebar-1') ? 'content-area' : 'full-width'; ?>">
                        <div class="posts-wrapper">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();

                                /*
                                * Include the Post-Type-specific template for the content.
                                * If you want to override this in a child theme, then include a file
                                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                */
                                get_template_part('template-parts/content', get_post_type());

                            endwhile;
                            ?>
                        </div>

                        <?php
                        // Pagination
                        guyana_auto_dealer_pagination();
                        ?>
                    </div>

                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <div class="widget-area">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php else : ?>

            <div class="container">
                <?php get_template_part('template-parts/content', 'none'); ?>
            </div>

        <?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
