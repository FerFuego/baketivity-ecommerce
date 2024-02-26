<?php

/**
 * Template Name: My Account Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<div class="baketivity-my-account">

    <?php if (is_user_logged_in()) : ?>

        <div class="baketivity-my-account__dashboard__breadcrumb-mobile">
            <button class="baketivity-my-account__dashboard__breadcrumb-mobile__toggler" aria-expanded="false" toggler-menu="">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="baketivity-my-account__dashboard__breadcrumb-mobile__label"><?= __('Dashboard', 'baketivity'); ?></div>
        </div>

    <?php endif; ?>

    <?php the_content(); ?>

    <?php if (is_page('my-account') && !is_user_logged_in()) :
        get_template_part('template_parts/modules/module', 'banner-login');
    endif; ?>

</div>

<?php get_footer('2022'); ?>