<?php
/**
 * The template for displaying all pages
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
            ?>

            <header class="page-header">
                <div class="container">
                    <div class="page-header-content">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <?php guyana_auto_dealer_breadcrumbs(); ?>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="row clearfix">
                    <div class="<?php echo is_active_sidebar('sidebar-1') ? 'content-area' : 'full-width'; ?>">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content-wrapper'); ?>>
                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'guyana-auto-dealer'),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>
                            </div><!-- .entry-content -->

                            <?php if (get_edit_post_link()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    edit_post_link(
                                        sprintf(
                                            wp_kses(
                                                /* translators: %s: Name of current post. Only visible to screen readers */
                                                __('Edit <span class="screen-reader-text">%s</span>', 'guyana-auto-dealer'),
                                                array(
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                )
                                            ),
                                            wp_kses_post(get_the_title())
                                        ),
                                        '<span class="edit-link">',
                                        '</span>'
                                    );
                                    ?>
                                </footer><!-- .entry-footer -->
                            <?php endif; ?>
                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>

                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <div class="widget-area">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
