<style scoped>
    .woocommerce,
    .woocommerce-error {
        position: absolute;
        right: 0;
    }    
    .woocommerce-message,
    .woocommerce-error li {
        font-family: 'FilsonPro';
        font-size: 12px;
        font-weight: 500;
        line-height: 12px;
    }
    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message, 
    .woocommerce-noreviews {
        background-color: transparent !important;
        border: 0;
        padding: 0;
    }
    .referral-bg-behavior {
        background-image: url(<?php echo get_sub_field('background_desktop')['url'];
        ?>);
    }

    @media (max-width: 992px) {
        .referral-bg-behavior {
            background-image: url(<?php echo get_sub_field('background_mobile')['url'];
            ?>);
        }
    }
</style>
<div class="hero-referral referral-bg-behavior">
    <div class="hero-referral__container">
        <div class="hero-referral__left">
            <h1 class="hero-referral__title"><?php echo get_sub_field('title'); ?></h1>
            <p class="hero-referral__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
            <?php if (is_user_logged_in()) :
                echo do_shortcode('[automatewoo_referrals_page]');
            else : ?>
                <a class="ba-form-login__cta" href="#ba-form-login">Login or Register</a>
            <?php endif; ?>
            <div class="hero-referral__message" id="js-referral-message"></div>
        </div>
        <div class="hero-referral__right"></div>
    </div>
</div>