<div class="capture_steps">
    <div class="capture_steps__container">
        <div class="capture_steps__header">
            <?php if (get_sub_field('title')) : ?>
                <h2 class="capture_steps__title"><?= get_sub_field('title'); ?></h2>
            <?php endif; ?>
            <?php if (get_sub_field('subtitle')) : ?>
                <h4 class="capture_steps__subtitle"><?= get_sub_field('subtitle'); ?></h4>
            <?php endif; ?>
        </div>

        <?php if (have_rows('items')) : ?>
            <div class="capture_steps__steps">
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="capture_steps__step">
                        <?php if ($img = get_sub_field('item_image')) : ?>
                            <div class="capture_steps__item-image">
                                <?php echo wp_get_attachment_image($img['id'], 'full', false, ['loading' => 'true', 'class' => 'capture_steps__image']); ?>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?php if (get_sub_field('item_title')) : ?>
                                <h3 class="capture_steps__item-title"><?= get_sub_field('item_title'); ?></h3>
                            <?php endif; ?>
                            <?php if (get_sub_field('item_text')) : ?>
                                <p class="capture_steps__item-text"><?= get_sub_field('item_text'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>