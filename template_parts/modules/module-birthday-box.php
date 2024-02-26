<div class="birthday-box" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="birthday-box__header">
        <h2 class="birthday-box__header-title"><?php _e(get_sub_field('title'), 'baketivity'); ?></h2>
    </div>
    <div class="birthday-box__container">
        <div class="birthday-box__left">
            <!-- Video -->
            <?php $video_link = get_sub_field('video'); ?>
            <div class="birthday-box__video-container">
                <div class="birthday-box__video-container">
                    <div class="support-video">
                        <img class="support-video__placeholder" src="<?php echo get_sub_field('image')['url']; ?>" alt="Video Placeholder">
                        <button class="support-video__play js-btn-video-play-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#C0DD52"></rect><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="birthday-box__right">
            <div class="birthday-box__content">
                <p class="birthday-box__text"><?php _e(get_sub_field('description'),'baketivity'); ?></p>
                <?php if (get_sub_field('product')) : 
                    $product = wc_get_product(get_sub_field('product'));
                    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="1" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                            esc_url( $product->add_to_cart_url() ),
                            esc_attr( $product->get_id() ),
                            esc_attr( $product->get_sku() ),
                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                            esc_attr( $product->get_type() ),
                            'Add to cart'
                        ),
                    $product );
                endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($video_link) : ?>
    <!-- Video Popup -->
    <div class="baking-club-what-is-inside__video-modal js-video-modal">
        <div class="baking-club-what-is-inside__video-modal__container js-container">
            <button class="baking-club-what-is-inside__video-modal-close js-close-modal"></button>
            <div class="video-info">
                <?php 
                    videoSupport([
                        'field' => 'video', // ACF field name
                        'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                        'placeholder_url' => get_sub_field('image')['url'],
                    ]); 
                ?>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->
<?php endif; ?>