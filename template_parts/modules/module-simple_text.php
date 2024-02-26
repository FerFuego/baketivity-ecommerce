<div class="simple-text">
    <div class="simple-text__container">
        <?php if (get_sub_field('title')) : ?>
            <h2 class="simple-text__title"><?= get_sub_field('title'); ?></h2>
        <?php endif; ?>
        <?php if (get_sub_field('text')) : ?>
            <div class="simple-text__text">
                <?= get_sub_field('text'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>