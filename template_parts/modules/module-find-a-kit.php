<div class="fak-wrapper">
    <div class="col-full">
        <div class="fak-title filson-pro-heavy"><?php echo get_sub_field('fak_title'); ?></div>
        <div class="fak-underline display-flex justify-content-center">
            <img src="<?php echo get_template_directory_uri() .'/../baketivity/images/home/underline-title-find.svg'; ?>" alt="find-a-kit">
        </div>
        <div class="fak-text"><?php echo get_sub_field('fak_text'); ?></div>
    </div>
    <div class="col-full slider-fak" id="slider-fak">
        <?php if (have_rows('fak_items')) : ?>
            <?php while (have_rows('fak_items')) : the_row(); ?>
                <div class="slider-fak-item" style="background-color:<?php echo get_sub_field('fak_item_color'); ?>;">
                    <?php
                        // Get image ID from URL
                        $image_id = attachment_url_to_postid( get_sub_field('fak_item_image') ); ?>
                    <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" class="fak-main-image" alt="find-a-kit-<?php echo get_sub_field('fak_item_text'); ?>">
                    <div class="fak-item-title filson-pro-bold"><?php echo get_sub_field('fak_item_title'); ?></div>
                    <div class="fak-item-text filson-pro-medium"><?php echo get_sub_field('fak_item_text'); ?></div>
                    <div class="fak-item-button">
                        <a href="<?php echo get_sub_field('fak_item_button')['url']; ?>" class="fak-learn-more slider-home-button filson-pro-bold">
                            <?php echo get_sub_field('fak_item_button')['title']; ?>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>	
    </div>	
</div>