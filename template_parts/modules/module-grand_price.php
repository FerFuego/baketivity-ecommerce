<?php $bgColor = get_sub_field('bg_color') ?? ''; ?>

<div class="grand-price" style="background-color: <?= esc_attr($bgColor); ?>;">
    <div class="grand-price__container">

        <div class="grand-price__left">
            <?php if ($backgroundImage = get_sub_field('image')) : ?>
                <?php echo wp_get_attachment_image($backgroundImage, 'full', false, ['loading' => 'false', 'class' => 'grand-price__image']); ?>
            <?php endif; ?>
            <?php if ($copy_left = get_sub_field('copy_image')) : ?>
                <div class="grand-price__copy-image"><?= esc_html($copy_left); ?></div>
            <?php endif; ?>
        </div>

        <div class="grand-price__right">
            <?php if ($label = get_sub_field('label')) : ?>
                <div class="grand-price__label"><?= esc_html($label); ?></div>
            <?php endif; ?>

            <?php if ($highlight = get_sub_field('highlight')) : ?>
                <div class="grand-price__highlight"><?= esc_html($highlight); ?></div>
            <?php endif; ?>

            <?php if ($copy = get_sub_field('copy')) : ?>
                <div class="grand-price__copy"><?= $copy; ?></div>
            <?php endif; ?>

            <?php if ($disclamer = get_sub_field('disclamer')) : ?>
                <div class="grand-price__disclamer"><?= esc_html($disclamer); ?></div>
            <?php endif; ?>

            <div class="grand-price__bg-mobile">
                <?php if (have_rows('items')) : ?>
                    <div class="grand-price__items">
                        <?php while (have_rows('items')) : the_row(); ?>
                            <?php if ($backgroundImage = get_sub_field('image')) : ?>
                                <?php echo wp_get_attachment_image($backgroundImage, 'thumbnail', false, ['loading' => 'false', 'class' => 'grand-price__item-image']); ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ($bonus = get_sub_field('bonus')) : ?>
                    <div class="grand-price__bonus">
                        <span><?= _e('Bonus Rewards', 'baketivity'); ?></span>
                        <?= esc_html($bonus); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($backgroundImage = get_sub_field('image')) : ?>
                <?php echo wp_get_attachment_image($backgroundImage, 'medium', false, ['loading' => 'false', 'class' => 'grand-price__image-mobile']); ?>
            <?php endif; ?>
            <?php if ($copy_left = get_sub_field('copy_image')) : ?>
                <div class="grand-price__copy-image-mobile"><?= esc_html($copy_left); ?></div>
            <?php endif; ?>

            <div class="grand-price__ctas">
                <?php if ($button1 = get_sub_field('cta_1')) : ?>
                    <a href="<?= esc_url($button1['url']); ?>" target="<?= esc_url($button1['target']); ?>" class="grand-price__cta-1 button-hovered"><?= esc_html($button1['title']); ?></a>
                <?php endif; ?>

                <?php if ($button2 = get_sub_field('cta_2')) : ?>
                    <a href="<?= esc_url($button2['url']); ?>" target="<?= esc_url($button1['target']); ?>" class="grand-price__cta-2"><?= esc_html($button2['title']); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>