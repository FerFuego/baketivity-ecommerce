<div class="big-menu-user" id="js-module-user">
    <div class="big-menu-user__content">
        <ul class="big-menu-user__list">
            <li class="big-menu-user__item menu-item menu-item-type-taxonomy menu-item-object-categories-category current-menu-item">
                <a class="big-menu-user__item-link js-site-link" href="/my-account/" aria-current="page">
                    <img class="big-menu-user__img" src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/user-black.svg" alt="user-account" width="14">
                    <?= (is_user_logged_in()) ? __('Account', 'baketivity') : __('Login / Sign Up', 'baketivity'); ?>
                </a>
            </li>
            <li class="big-menu-user__item menu-item menu-item-type-taxonomy menu-item-object-categories-category current-menu-item">
                <a class="big-menu-user__item-link js-site-link" href="/referral" aria-current="page">
                    <img class="big-menu-user__img" src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/user-referrer.svg" alt="user-referrer" width="20">
                    <?= __('Refer A Friend', 'baketivity'); ?>
                </a>
            </li>
            <?php if (is_user_logged_in()) : ?>
                <li class="big-menu-user__item menu-item menu-item-type-taxonomy menu-item-object-categories-category current-menu-item">
                    <a class="big-menu-user__item-link js-site-link" href="<?php echo wp_logout_url(home_url()); ?>" aria-current="page">
                        <img class="big-menu-user__img" src="<?= get_stylesheet_directory_uri(); ?>/images/navbar/user-logout.svg" alt="user-logout" width="15">
                        <?= __('Log Out', 'baketivity'); ?>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>