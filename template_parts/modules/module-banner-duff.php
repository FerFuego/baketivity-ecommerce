<div class="banner-duff" style="background-color: <?php echo get_sub_field('background_color') ? get_sub_field('background_color') : '#5353E2'; ?>">
    <div class="container">
        <div class="banner-duff__col-1">
            <div class="banner-duff__img-cont">
                <img class="banner-duff__logos" src="<?php echo get_sub_field('logos_image')['url']; ?>" alt="logos">
            </div>
            <h3 class="banner-duff__title"><?php echo get_sub_field('title'); ?></h3>
        </div>
        <div class="banner-duff__col-2">
            <div class="banner-duff__img-content">
                <?php $image_content_id = get_sub_field('center_image_1')['id'] ?>
                <img class="banner-duff__img-1" src="<?php echo wp_get_attachment_image_url($image_content_id, 'medium'); ?>" alt="duff_1">
            </div>
            <?php $image_two_content_id = get_sub_field('center_image_2')['id'] ?>
            <img class="banner-duff__img-2" src="<?php echo wp_get_attachment_image_url($image_two_content_id, 'medium'); ?>" alt="duff_2">
        </div>
        <div class="banner-duff__col-3">
            <a class="banner-duff__button" href="<?php echo get_sub_field('button')['url']; ?>"><?php echo get_sub_field('button')['title']; ?></a>
        </div>
    </div>
</div>