<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header();

// Get content from Blog Page
$page_blog = get_page_by_path('blog'); ?>

<main class="blog-page">
    <?php if ( have_rows( 'blog__flexible-content', $page_blog->ID ) ) : ?>
        <?php while ( have_rows('blog__flexible-content', $page_blog->ID ) ) : the_row(); ?>

            <?php if ( get_row_layout() == 'blog-header' ) : ?>
                <?php get_template_part( 'template_parts/modules/module', 'blog-header' ); ?>
                <?php get_template_part( 'template_parts/modules/module', 'blog-body' ); ?>
            <?php elseif ( get_row_layout() == 'blog-banner-cta-1' ) : ?>
                <?php get_template_part( 'template_parts/modules/module', 'blog-banner-cta-1' ); ?>
            <?php elseif ( get_row_layout() == 'blog-banner-cta-2' ) : ?>
                <?php get_template_part( 'template_parts/modules/module', 'blog-banner-cta-2' ); ?>
            <?php elseif ( get_row_layout() == 'faq' ) : ?>
                <?php get_template_part( 'template_parts/modules/module', 'accordion-faq' ); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer();