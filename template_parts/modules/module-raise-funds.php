<div class="raise-funds">
    <div class="raise-funds__header">
        <h2 class="raise-funds__header-title"><?php echo get_sub_field('title'); ?></h2>
        <h2 class="raise-funds__header-subtitle"><?php echo get_sub_field('subtitle'); ?></h2>
    </div>
    <div class="raise-funds__container">
        <div class="raise-funds__left">
           <div class="raise-funds__image-desktop">
                <img class="raise-funds__image" src="<?php echo get_sub_field('image_desktop'); ?>" alt="raise-funds image">
           </div>
           <div class="raise-funds__image-mobile">
                <img class="raise-funds__image" src="<?php echo get_sub_field('image_mobile'); ?>" alt="raise-funds image">
           </div>
        </div>
        <div class="raise-funds__right">
            <div class="raise-funds__content">
                <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="raise-funds__item">
                        <img class="raise-funds__item-image" src="<?php echo get_sub_field('icon'); ?>" alt="raise-funds icon <?php echo get_row_index(); ?>">
                        <div class="raise-funds__item-content"><?php echo get_sub_field('title'); ?></div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>