<div class="mobile-navigation__menu-users">
    <div class="mobile-navigation__menu-users__inner">
        <?php if (is_user_logged_in()) : ?>
            <div class="mobile-navigation__menu-users__item">
                <a class="mobile-navigation__menu-users__link" href="/my-account/">
                    <img src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/user-icon.svg" alt="user-account" width="22">
                </a>
                <?= __('My <br />account', 'baketivity'); ?>
            </div>
        <?php else : ?>
            <div class="mobile-navigation__menu-users__item">
                <a class="mobile-navigation__menu-users__link" href="/my-account/">
                    <img src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/signup-icon.svg" alt="sigup-account" width="27">
                </a>
                <?= __('Login /<br />Sign up', 'baketivity'); ?>
            </div>
        <?php endif; ?>
        <div class="mobile-navigation__menu-users__item">
            <a class="mobile-navigation__menu-users__link" href="/referral/">
                <img src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/referer.svg" alt="user-referrer" width="32">
            </a>
            <?= __('Refer<br />a friend', 'baketivity'); ?>
        </div>
        <div class="mobile-navigation__menu-users__item">
            <a class="mobile-navigation__menu-users__link" href="/cart/">
                <img src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/cart-icon.svg" alt="cart-icon" width="27">
            </a>
            <?= __('My cart', 'baketivity'); ?>
        </div>
        <?php if (is_user_logged_in()) : ?>
            <div class="mobile-navigation__menu-users__item">
                <a class="mobile-navigation__menu-users__link" href="<?php echo wp_logout_url(home_url()); ?>">
                    <img src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/logout.svg" alt="logout" width="37">
                </a>
                <?= __('Log out', 'baketivity'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>