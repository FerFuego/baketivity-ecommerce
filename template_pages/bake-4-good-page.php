<?php

/**
 * Template Name: Bake 4 Good
 * 
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="bake4good-page">
    <?php if (have_rows('page__flexible-content')) : ?>
        <?php while (have_rows('page__flexible-content')) : the_row(); ?>

            <?php if (get_row_layout() == 'hero_bake4good') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-bake4good'); ?>

            <?php elseif (get_row_layout() == 'video_streaming') : ?>
                <style scoped>
                    .support-video {
                        max-width: 800px;
                    }
                </style>
                <?php get_template_part('template_parts/modules/module', 'video_streaming'); ?>

            <?php elseif (get_row_layout() == 'raise-funds') : ?>
                <?php get_template_part('template_parts/modules/module', 'raise-funds'); ?>

            <?php elseif (get_row_layout() == 'proud-partners') : ?>
                <?php get_template_part('template_parts/modules/module', 'proud-partners'); ?>

            <?php elseif (get_row_layout() == 'fundraising-drive') : ?>
                <?php get_template_part('template_parts/modules/module', 'fundraising-drive'); ?>

            <?php elseif (get_row_layout() == 'fundraising-goals') : ?>
                <?php get_template_part('template_parts/modules/module', 'fundraising-goals'); ?>

            <?php elseif (get_row_layout() == 'raise-money') : ?>
                <?php get_template_part('template_parts/modules/module', 'raise-money'); ?>

            <?php elseif (get_row_layout() == 'every-baketivity-kit-includes') : ?>
                <?php get_template_part('template_parts/modules/module', 'every-baketivity-kit-includes'); ?>

            <?php elseif (get_row_layout() == 'best-sellers') : ?>
                <?php get_template_part('template_parts/modules/module', 'best-sellers'); ?>

            <?php elseif (get_row_layout() == 'started-fundraising-form') : ?>
                <?php get_template_part('template_parts/modules/module', 'started-fundraising-form'); ?>

            <?php elseif (get_row_layout() == 'we-serve-more-families') : ?>
                <?php get_template_part('template_parts/modules/module', 'we-serve-more-families'); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>