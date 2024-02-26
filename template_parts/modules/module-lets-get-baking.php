<div class="lets-get-baking">
    <div class="lets-get-baking__header">
        <h2 class="lets-get-baking__title"><?php echo get_sub_field('title'); ?></h2>
    </div>

    <?php 
        $count = 0;
        $tabs = get_sub_field('tabs');
        if (is_array($tabs)) $count = count($tabs);
    ?>

    <?php if (have_rows('tabs') && $count > 1) : ?>
        <div class="lets-get-baking__container">
            <div class="lets-get-baking__tabs">
                <?php while (have_rows('tabs')) : the_row(); ?>
                    <div class="lets-get-baking__tab <?php echo (get_row_index('tabs') == 1) ? 'active':''; ?>" id="<?php echo get_row_index('tabs');?>">
                        <span class="lets-get-baking__tab-title"><?php echo get_sub_field('tab_label'); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="lets-get-baking__body">
        <div class="lets-get-baking__container">
            <?php if (have_rows('tabs')) : ?>
            <?php while (have_rows('tabs')) : the_row(); ?>
                <div class="lets-get-baking__tabs-content <?php echo (get_row_index('tabs') == 1) ? 'active':''; ?>" data-tab="<?php echo get_row_index('tabs');?>">
                    <div class="lets-get-baking__principal">
                        <div class="lets-get-baking__principal-content">
                            <h3 class="lets-get-baking__principal-title"><?php echo get_sub_field('principal_title'); ?></h3>
                        </div>
                        <div class="lets-get-baking__principal-image">
                            <div class="lets-get-baking__principal-image-container">
                                <?php 
                                    // Get image ID from URL
                                    $image_id = attachment_url_to_postid( get_sub_field('principal_image') );
                                ?>
                                <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="principal image">
                            </div>
                            <div class="lets-get-baking__principal-time-container">
                                <div class="lets-get-baking__principal-time">
                                    <div class="lets-get-baking__principal-time-icon"></div>
                                    <span class="lets-get-baking__principal-time-copy"><?php echo get_sub_field('time'); ?></span>
                                </div>
                                <div class="lets-get-baking__principal-divisor"></div>
                                <div>
                                    <div class="lets-get-baking__principal-serving-icon"></div>
                                    <span class="lets-get-baking__principal-time-copy"><?php echo get_sub_field('servings'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (have_rows('shopping_list')) : ?>
                        <div class="lets-get-baking__shopping">
                            <h4 class="lets-get-baking__shopping-title">Shopping List:</h4>
                            <div class="lets-get-baking__shopping-content">
                                <?php while (have_rows('shopping_list')) : the_row(); ?>
                                    <div class="lets-get-baking__item">
                                        <div class="lets-get-baking__item-icon">
                                            <?php
                                                // Get image ID from URL
                                                $image_id = attachment_url_to_postid( get_sub_field('shopping_icon') );
                                            ?>
                                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="equipment icon">
                                        </div>
                                        <span class="lets-get-baking__item-title"><?php the_sub_field('shopping_title'); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('equipment')) : ?>
                        <div class="lets-get-baking__equipment">
                            <h4 class="lets-get-baking__equipment-title">Equipment:</h4>
                            <div class="lets-get-baking__equipment-content">
                                <?php while (have_rows('equipment')) : the_row(); ?>
                                    <div class="lets-get-baking__item">
                                        <?php 
                                            // Get image ID from URL
                                            $image_id = attachment_url_to_postid( get_sub_field('equipment_icon') );
                                        ?>
                                        <div class="lets-get-baking__item-icon">
                                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="equipment icon">
                                        </div>
                                        <span class="lets-get-baking__item-title"><?php the_sub_field('equipment_title'); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (have_rows('tabs')) : ?>
    <?php while (have_rows('tabs')) : the_row(); ?>
        <?php if (get_sub_field('image')) : ?>
            <div class="shopping-list <?php echo (get_row_index('tabs') == 1) ? 'active':'d-none'; ?>" data-tab="<?php echo get_row_index('tabs');?>">
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
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>