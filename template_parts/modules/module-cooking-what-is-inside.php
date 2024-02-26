<div class="<?php echo $page; ?>-what-is-inside">
    <div class="<?php echo $page; ?>-what-is-inside__container">
        <h2 class="<?php echo $page; ?>-what-is-inside__title"><?php echo get_sub_field('title'); ?></h2>
        <?php if (get_sub_field('subtitle')) : ?>
            <p class="<?php echo $page; ?>-what-is-inside__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
        <?php endif; ?>
        <div class="<?php echo $page; ?>-what-is-inside__body">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <?php if (get_sub_field('video')) : ?>
                        <?php $video_link = get_sub_field('link')['url']; // video popup ?>
                        <div class="<?php echo $page; ?>-what-is-inside__item">
                            <div class="<?php echo $page; ?>-what-is-inside__item-image">
                                <div class="support-video">
                                    <img class="support-video__placeholder" src="<?php echo get_sub_field('image'); ?>" alt="Video Placeholder">
                                    <button class="support-video__play js-btn-video-play-1"><svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"></rect><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"></path></svg></button>
                                </div>
                            </div>
                            <div class="<?php echo $page; ?>-what-is-inside__item-title"><?php echo get_sub_field('title'); ?></div>
                            <div class="<?php echo $page; ?>-what-is-inside__item-copy"><?php echo get_sub_field('copy'); ?></div>
                        </div>
                    <?php else: ?>
                        <div class="<?php echo $page; ?>-what-is-inside__item">
                            <div class="<?php echo $page; ?>-what-is-inside__item-image">
                                <?php
                                    // Get image ID from URL
                                    $image_id = attachment_url_to_postid( get_sub_field('image') );
                                ?>
                                <img class="<?php echo $page; ?>-what-is-inside__item-img" src="<?php echo wp_get_attachment_image_url( $image_id, 'large' ); ?>" alt="find-a-kit-<?php echo get_sub_field('title'); ?>">
                            </div>
                            <div class="<?php echo $page; ?>-what-is-inside__item-title"><?php echo get_sub_field('title'); ?></div>
                            <div class="<?php echo $page; ?>-what-is-inside__item-copy"><?php echo get_sub_field('copy'); ?></div>
                            <?php if (get_sub_field('link')) : ?>
                                <a class="<?php echo $page; ?>-what-is-inside__item-link" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>	
        </div>
    </div>
</div>

<?php if ($video_link) : ?>
    <!-- Video Popup -->
    <div class="<?php echo $page; ?>-what-is-inside__video-modal js-video-modal">
        <div class="<?php echo $page; ?>-what-is-inside__video-modal__container js-container">
            <button class="<?php echo $page; ?>-what-is-inside__video-modal-close js-close-modal"></button>
            <div class="video-info">
                <?php 
                    videoSupport([
                        'field' => 'link',
                        'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                        'placeholder_url' => get_sub_field('image'),
                        'video_url' => $video_link,
                    ]); 
                ?>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->
<?php endif; ?>