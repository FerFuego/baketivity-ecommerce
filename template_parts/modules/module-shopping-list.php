<div class="shopping-list">
    <div class="shopping-list__body" style="background-color: <?php echo get_sub_field('background_color'); ?>">
        <div class="shopping-list__container">
            <div class="shopping-list__content">
                <h4 class="shopping-list__title"><?php echo get_sub_field('title'); ?></h4>
                <a class="shopping-list__cta" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
            </div>
            <img class="shopping-list__image" src="<?php echo get_sub_field('image'); ?>" alt="Download now">
        </div>
    </div>
</div>