<?php
/**
 * The template for displaying all single posts
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
                        <?php
                        get_template_part('template-parts/content', get_post_type());

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
