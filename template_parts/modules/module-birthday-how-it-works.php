<div class="birthday-how-it-works">
    <div class="birthday-how-it-works__container">
        <?php if (get_sub_field('title')) : ?>
            <div class="birthday-how-it-works__title"><?php _e(get_sub_field('title'), 'baketivity'); ?></div>
        <?php endif; ?>
        <?php if (have_rows('items')) : ?>
            <div class="birthday-how-it-works__items">
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="birthday-how-it-works__item" style="background-color: <?php echo get_sub_field('bg_color');?>;">
                        <div class="birthday-how-it-works__item-icon" style="background-image: url(<?php echo get_sub_field('icon')['sizes']['medium'];?>);"></div>
                        <div class="birthday-how-it-works__item-number"><?php echo get_row_index(); ?></div>
                        <div>
                            <div class="birthday-how-it-works__item-title"><?php _e(get_sub_field('title'), 'baketivity'); ?></div>
                            <?php if (get_sub_field('active_option')) : ?>
                                <!-- <div class="birthday-how-it-works__item-option">
                                    <div class="quick-cart__form quick-qty">
                                        <span class="quick-cart__minus">-</span>
                                        <div class="quantity">
                                            <input type="text" id="" class="input-text qty text in-cart" value="2" title="Qty" inputmode="numeric" autocomplete="off" readonly>
                                        </div>
                                        <span class="quick-cart__plus">+</span>
                                    </div>
                                    <div class="birthday-how-it-works__pricing">Unlock special pricing for 12+</div>
                                </div> -->
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>  
            </div>
        <?php endif; ?>
    </div>
</div>