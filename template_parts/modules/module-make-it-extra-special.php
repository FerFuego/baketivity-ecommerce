<div class="make-it-extra-special"
    style="background-color: <?php echo get_sub_field('background_color') ? get_sub_field('background_color') : '#5353E2'; ?>">
    <div class="container">
        <div class="make-it-extra-special__col-1">
            <h3 class="make-it-extra-special__title filson-pro-bold">
                <?php echo get_sub_field('title'); ?>
                <strong class="filson-pro-heavy"><?php echo get_sub_field('title_highlighted'); ?></strong>
            </h3>
            <span class="make-it-extra-special__copy filson-pro-bold">
                <?php echo get_sub_field('copy'); ?>
            </span>
        </div>
        <div class="make-it-extra-special__col-2">
            <a class="make-it-extra-special__button filson-pro-medium" href="<?php echo get_sub_field('button')['url']; ?>" target="<?php echo get_sub_field('button')['target']; ?>">
                <?php echo get_sub_field('button')['title']; ?>
            </a>            
        </div>
        <div class="make-it-extra-special__col-3">
            <div class="make-it-extra-special__img-content">
                <img class="make-it-extra-special__img-1" src="<?php echo get_sub_field('image')['url']; ?>"
                    alt="ake-it-extra-special">
            </div>
        </div>
    </div>
</div>