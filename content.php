<?php
/**
 * Template part for displaying posts
 *
 * @package Guyana_Auto_Dealer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
    <?php if (has_post_thumbnail() && !is_single()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
    <?php elseif (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <i class="fas fa-calendar-alt"></i>
                    <?php
                    echo '<a href="' . esc_url(get_permalink()) . '">';
                    echo esc_html(get_the_date());
                    echo '</a>';
                    ?>
                </span>

                <span class="byline">
                    <i class="fas fa-user"></i>
                    <?php
                    printf(
                        '<a href="%s">%s</a>',
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        esc_html(get_the_author())
                    );
                    ?>
                </span>

                <?php if (has_category()) : ?>
                    <span class="cat-links">
                        <i class="fas fa-folder"></i>
                        <?php the_category(', '); ?>
                    </span>
                <?php endif; ?>

                <?php if (has_tag() && is_single()) : ?>
                    <span class="tags-links">
                        <i class="fas fa-tags"></i>
                        <?php the_tags('', ', '); ?>
                    </span>
                <?php endif; ?>

                <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
                    <span class="comments-link">
                        <i class="fas fa-comments"></i>
                        <?php
                        comments_popup_link(
                            esc_html__('Leave a comment', 'guyana-auto-dealer'),
                            esc_html__('1 Comment', 'guyana-auto-dealer'),
                            esc_html__('% Comments', 'guyana-auto-dealer')
                        );
                        ?>
                    </span>
                <?php endif; ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (is_singular()) : ?>
        <div class="entry-content">
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'guyana-auto-dealer'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'guyana-auto-dealer'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
    <?php else : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="read-more btn btn-outline">
                <?php esc_html_e('Read More', 'guyana-auto-dealer'); ?>
            </a>
        </div><!-- .entry-summary -->
    <?php endif; ?>

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <div class="post-navigation">
                <div class="nav-links">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i> %title'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', '%title <i class="fas fa-arrow-right"></i>'); ?>
                    </div>
                </div>
            </div>
            
            <?php if (has_tag()) : ?>
                <div class="post-tags">
                    <span class="tags-title"><?php esc_html_e('Tags:', 'guyana-auto-dealer'); ?></span>
                    <?php the_tags('', ' '); ?>
                </div>
            <?php endif; ?>
            
            <div class="post-share">
                <span class="share-title"><?php esc_html_e('Share:', 'guyana-auto-dealer'); ?></span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="share-twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" class="share-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
