<?php
$bg_image = get_sub_field('bg_image');
$bg_color = get_sub_field('bg_color');
$form     = get_sub_field('form_id');
$title    = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
?>
<div class="baketivity-time-form" style="background-color: <?php echo $bg_color; ?>">
    <div class="baketivity-time-form__wrapper">
        <div class="baketivity-time-form__container">
            <div class="baketivity-time-form__left">
                <?php if ($bg_image) {
                    echo wp_get_attachment_image($bg_image['id'], 'full', false, array('class' => 'baketivity-time-form__image'));
                } ?>
            </div>
            <div class="baketivity-time-form__right" style="background-color: <?php echo $bg_color; ?>">
                <div class="baketivity-time-form__content">
                    <?php if ($title) : ?>
                        <div class="baketivity-time-form__title"><?= $title; ?></div>
                    <?php endif; ?>

                    <?php if ($subtitle) : ?>
                        <div class="baketivity-time-form__subtitle">
                            <?= $subtitle; ?>
                            <span><img src="/wp-content/themes/baketivity/images/baketivity-time/baketivity-time.svg" alt="baketivity time"></span>
                        </div>
                    <?php endif; ?>

                    <?php echo do_shortcode('[gravityform id="' . $form . '" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>