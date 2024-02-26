<?php
$bg_color = get_sub_field('bg_color');
$what_inside_video = get_sub_field('what_inside_video');
?>

<div class="baking-club-what-is-inside new-what-is-inside" style="<?php echo ($bg_color) ? 'background-color:' . $bg_color : ''; ?>">
    <div class="baking-club-what-is-inside__container">
        <div class="baking-club-what-is-inside__header">
            <h2 class="baking-club-what-is-inside__title"><?php echo get_sub_field('title'); ?></h2>
            <?php if (get_sub_field('subtitle')) : ?>
                <p class="baking-club-what-is-inside__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
            <?php endif; ?>
            <?php if ($what_inside_video) : ?>
                <img class="baking-club-what-is-inside__watch-video-cta js-btn-video-play-0" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cooking-kits/unbox-btn.webp" alt="unbox btn">
            <?php endif; ?>
        </div>
        <div class="baking-club-what-is-inside__body" id="js-what-is-inside">
            <?php if (have_rows('items')) : $i = 0; ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <?php if (get_sub_field('video')) : $i += 1; ?>
                        <div class="baking-club-what-is-inside__item">
                            <div class="baking-club-what-is-inside__item-image">
                                <div class="support-video">
                                    <img class="support-video__placeholder" src="<?php echo get_sub_field('image'); ?>" alt="Video Placeholder">
                                    <button class="support-video__play js-btn-video-play-<?php echo $i; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225">
                                            <rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"></rect>
                                            <path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="baking-club-what-is-inside__item-title"><?php echo get_sub_field('title'); ?></div>
                            <div class="baking-club-what-is-inside__item-copy"><?php echo get_sub_field('copy'); ?></div>
                        </div>
                    <?php else : ?>
                        <div class="baking-club-what-is-inside__item">
                            <div class="baking-club-what-is-inside__item-image">
                                <?php
                                // Get image ID from URL
                                $image_id = attachment_url_to_postid(get_sub_field('image'));
                                ?>
                                <img class="baking-club-what-is-inside__item-img" src="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>" alt="find-a-kit-<?php echo get_sub_field('title'); ?>">
                            </div>
                            <div class="baking-club-what-is-inside__item-title"><?php echo get_sub_field('title'); ?></div>
                            <div class="baking-club-what-is-inside__item-copy"><?php echo get_sub_field('copy'); ?></div>
                            <?php if (get_sub_field('link')) : ?>
                                <a class="baking-club-what-is-inside__item-link" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($what_inside_video) : ?>
    <!-- Video Popup -->
    <div class="baking-club-what-is-inside__video-modal js-video-modal">
        <div class="baking-club-what-is-inside__video-modal__container js-container">
            <button class="baking-club-what-is-inside__video-modal-close js-close-modal"></button>
            <div class="video-info">
                <?php
                videoSupport([
                    'field' => 'link',
                    'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                    'placeholder_url' => '',
                    'video_url' => $what_inside_video,
                ]);
                ?>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->
<?php endif; ?>


<?php if (have_rows('items')) : ?>
    <?php while (have_rows('items')) : the_row(); ?>
        <?php if (get_sub_field('video')) :
            $video_link = get_sub_field('link')['url']; ?>
            <!-- Video Popup Slider -->
            <div class="baking-club-what-is-inside__video-modal js-video-modal">
                <div class="baking-club-what-is-inside__video-modal__container js-container">
                    <button class="baking-club-what-is-inside__video-modal-close js-close-modal"></button>
                    <div class="video-info">
                        <?php
                        videoSupport([
                            'field' => 'link',
                            'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                            'placeholder_url' => '',
                            'video_url' => $video_link,
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <!-- End Video Popup Slider -->
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>