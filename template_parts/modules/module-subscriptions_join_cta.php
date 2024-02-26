<div class="subscriptions-join-cta">
    <div class="container">
        <div class="subscriptions-join-cta__content">
            <?php $link = get_sub_field('subscriptions-cta__cta-text'); ?>
            <?php if ($link) : ?>
                <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>" class="subscriptions-join-cta__button"><?= $link['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>