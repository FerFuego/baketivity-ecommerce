<div class="ready-to-vote" style="background-color:<?= get_sub_field('bg_color'); ?>">
    <div class="ready-to-vote__container">
        <!-- Images Collage (Mobile) -->
        <?php $icon = get_sub_field('icon'); ?>
        <?php if ($icon) : ?>
            <?php echo wp_get_attachment_image($icon['id'], 'large', false, ['loading' => 'false', 'class' => 'ready-to-vote__icon']); ?>
        <?php endif ?>
        <?php if (get_sub_field('title')) : ?>
            <h2 class="ready-to-vote__title"><?= get_sub_field('title'); ?></h2>
        <?php endif; ?>
        <?php if (get_sub_field('subtitle')) : ?>
            <p class="ready-to-vote__subtitle"><?= get_sub_field('subtitle'); ?></p>
        <?php endif; ?>
        <?php if (get_sub_field('copy')) : ?>
            <p class="ready-to-vote__copy"><?= get_sub_field('copy'); ?></p>
        <?php endif; ?>
        <?php if (get_sub_field('cta')) : ?>
            <a class="ready-to-vote__cta button-hovered" href="<?= get_sub_field('cta')['url']; ?>" target="<?= get_sub_field('cta')['target']; ?>"><?= get_sub_field('cta')['title']; ?></a>
        <?php endif; ?>
    </div>
</div>