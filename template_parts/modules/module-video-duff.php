<div class="duff-video">
    <div class="duff-video__container">
        <div class="duff-video__header">
            <h2 class="duff-video__title">
                <?php echo get_sub_field('title_1'); ?>
                <?php echo get_sub_field('title_2'); ?>
            </h2>
            <p class="duff-video__content"> <?php echo get_sub_field('content'); ?></p>
        </div>
        <div class="duff-video__player">
            <iframe class="duff-video__iframe" width="100%" height="auto"
                src="<?php echo get_sub_field('video_url'); ?>" frameborder="0"
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

        </div>
    </div>
</div>