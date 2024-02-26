<div class="topbar-prime" id="topbar-prime">

    <?php $link = get_field('link_prime', 'option'); ?>

    <?php if ($link) : ?>
        <a class="topbar-prime__link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
        <?php endif; ?>

        <h3 class="topbar-prime__title"><?= esc_html(get_field('title_prime', 'option')); ?></h3>
        <!-- <img class="topbar-prime__image" src="/wp-content/themes/baketivity/images/prime/buy-with-prime-white.svg" alt="buy with prime"> -->

        <?php if ($link) : ?>
        </a>
    <?php endif; ?>

    <!-- close icon -->
    <i class="fas fa-times topbar-prime__close" onclick="General.prototype.closeTopBar()"></i>

</div>