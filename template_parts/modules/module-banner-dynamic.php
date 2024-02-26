<?php
$custom_height = get_sub_field('custom_height') ? get_sub_field('custom_height') : '105px';
$custom_width = get_sub_field('custom_width') ? get_sub_field('custom_width') : '100%';
$custom_height_mobile = get_sub_field('custom_height_mobile') ? get_sub_field('custom_height_mobile') : '105px';
$custom_width_mobile = get_sub_field('custom_width_mobile') ? get_sub_field('custom_width_mobile') : '100%';
$custom_size = get_sub_field('custom_size') ? get_sub_field('custom_size') : '100%';
$custom_size_mobile = get_sub_field('custom_size_mobile') ? get_sub_field('custom_size_mobile') : '100%';
$link_banner = get_sub_field('link_banner');
$cta_text_color = get_sub_field('cta_text_color');
$cta_bg_color = get_sub_field('cta_bg_color');
$title_color = get_sub_field('title_color');
$subtitle_color = get_sub_field('subtitle_color');
?>

<style scoped>
    .banner-dynamic-behavior {
        background-image: url(<?php echo get_sub_field('bg_image')['url']; ?>);
        background-size: <?= $custom_size; ?>;
        height: <?= $custom_height; ?>;
        width: <?= $custom_width; ?>;
    }

    @media (max-width: 768px) {
        .banner-dynamic-behavior {
            background-image: url(<?php echo get_sub_field('bg_image_mobile')['url']; ?>);
            background-size: <?= $custom_size_mobile; ?>;
            height: <?= $custom_height_mobile; ?>;
            width: <?= $custom_width_mobile; ?>;
        }
    }
</style>

<div class="banner-dynamic">
    <div class="banner-dynamic__container">
        <?php if ($link_banner) :
            printf('<a href="%s" target="%s"', $link_banner['url'], $link_banner['target']);
        else :
            printf('<div ');
        endif;
        printf('class="banner-dynamic__content banner-dynamic-behavior" style="background-color: %s;">', get_sub_field('bg_color'));
        ?>
        <div class="banner-dynamic__logo"></div>
        <div class="banner-dynamic__text">
            <?php if (get_sub_field('title')) : ?>
                <h2 class="banner-dynamic__title" style="<?= ($title_color) ? 'color: ' . $title_color . ';' : ''; ?>">
                    <?= get_sub_field('title'); ?>
                </h2>
            <?php endif; ?>
            <?php if (get_sub_field('subtitle')) : ?>
                <h4 class="banner-dynamic__subtitle" style="<?= ($subtitle_color) ? 'color: ' . $subtitle_color . ';' : ''; ?>">
                    <?= get_sub_field('subtitle'); ?>
                </h4>
            <?php endif; ?>
        </div>
        <?php if (get_sub_field('cta')) : ?>
            <a class="banner-dynamic__cta-link" href="<?= get_sub_field('cta')['url']; ?>" target="<?= get_sub_field('cta')['target']; ?>" style="<?= ($cta_bg_color) ? 'background-color: ' . $cta_bg_color . ';' : ''; ?>
                            <?= ($cta_text_color) ? 'color: ' . $cta_text_color . ';' : ''; ?>">
                <?= get_sub_field('cta')['title']; ?>
            </a>
        <?php endif; ?>
        <?php if ($link_banner) : ?>
            </a>
        <?php else : ?>
    </div>
<?php endif; ?>
</div>
</div>