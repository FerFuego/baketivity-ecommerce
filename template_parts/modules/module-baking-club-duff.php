<style scoped>
    .club-duff-background {
        background-image: url(<?php echo get_sub_field('background_desktop'); ?>);
        background-color: <?php echo get_sub_field('bg_color'); ?>;
    }

    .club-duff-behavior {
        background-image: url(<?php echo get_sub_field('image_desktop'); ?>);
    }

    .club-duff__copy,
    .club-duff__copy p {
        color: <?php echo get_sub_field('color_copy'); ?>;
    }

    @media (max-width: 768px) {
        .club-duff-background {
            background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
            background-color: <?php echo get_sub_field('bg_color'); ?>;
        }

        .club-duff-behavior {
            background-image: url(<?php echo get_sub_field('image_mobile'); ?>);
        }
    }
</style>

<script>
    // Fix CTA video play
    var initIntervalVideo = window.setInterval(activeCTAvideoMobile, 100);

    function activeCTAvideoMobile() {
        var video_cta = document.querySelector('.baking-club-duff__watch-video-cta-mobile');
        if (video_cta) {
            if (jQuery('.baking-club-duff__watch-video-cta-mobile').is(':visible')) {
                clearInterval(initIntervalVideo);
                if (window.innerWidth < 767) {
                    video_cta.classList.add('js-btn-video-play-0');
                } else {
                    video_cta.classList.remove('js-btn-video-play-0');
                }
            } else {
                video_cta.classList.remove('js-btn-video-play-0');
                clearInterval(initIntervalVideo);
            }
        }
    }
</script>

<?php $watch_it_unbox = get_sub_field('watch_it_unbox'); // video popup 
?>

<div class="<?php echo $page; ?>-duff club-duff-background" id="<?php echo $page; ?>-duff">
    <div class="<?php echo $page; ?>-duff__container">
        <div class="<?php echo $page; ?>-duff__left">
            <div class="<?php echo $page; ?>-duff__content">
                <h3 class="<?php echo $page; ?>-duff__date-title"><?php echo get_sub_field('date_title'); ?></h3>
                <h2 class="<?php echo $page; ?>-duff__title" style="color: <?php echo get_sub_field('color_title'); ?>"><?php echo get_sub_field('title'); ?></h2>
                <?php if (get_sub_field('style') == 1) : ?>
                    <div class="<?php echo $page; ?>-duff__image-row-mobile">
                        <?php if (get_sub_field('image_1')) : ?>
                            <div class="<?php echo $page; ?>-duff__image-row-mobile-1" style="background-image: url(<?php echo get_sub_field('image_1'); ?>);"></div>
                        <?php endif; ?>
                        <?php if (get_sub_field('image_2')) : ?>
                            <div class="<?php echo $page; ?>-duff__image-row-mobile-2" style="background-image: url(<?php echo get_sub_field('image_2'); ?>);"></div>
                        <?php endif; ?>
                        <?php if (get_sub_field('image_3')) : ?>
                            <div class="<?php echo $page; ?>-duff__image-row-mobile-3" style="background-image: url(<?php echo get_sub_field('image_3'); ?>);"></div>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="<?php echo $page; ?>-duff__image-mobile club-duff-behavior"></div>
                <?php endif; ?>
                <div class="<?php echo $page; ?>-duff__watch-video-cta-mobile"></div>
                <div class="<?php echo $page; ?>-duff__copy club-duff__copy"><?php echo get_sub_field('copy'); ?></div>
                <?php if (get_sub_field('cta')) : ?>
                    <a class="<?php echo $page; ?>-duff__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="<?php echo $page; ?>-duff__right">
            <div class="<?php echo $page; ?>-duff__watch-video-cta js-btn-video-play-0"></div>
            <?php if (get_sub_field('style') == 1) : ?>
                <div class="<?php echo $page; ?>-duff__image-row">
                    <?php if (get_sub_field('image_1')) : ?>
                        <div class="<?php echo $page; ?>-duff__image-row-1" style="background-image: url(<?php echo get_sub_field('image_1'); ?>);"></div>
                    <?php endif; ?>
                    <?php if (get_sub_field('image_2')) : ?>
                        <div class="<?php echo $page; ?>-duff__image-row-2" style="background-image: url(<?php echo get_sub_field('image_2'); ?>);"></div>
                    <?php endif; ?>
                    <?php if (get_sub_field('image_3')) : ?>
                        <div class="<?php echo $page; ?>-duff__image-row-3" style="background-image: url(<?php echo get_sub_field('image_3'); ?>);"></div>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class="<?php echo $page; ?>-duff__image club-duff-behavior"></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($watch_it_unbox) : ?>
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
                    'video_url' => $watch_it_unbox,
                ]);
                ?>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->
<?php endif; ?>