<div class="cake-video">
    <div class="cake-video__container">
        <div class="cake-video__header">
            <h2 class="cake-video__title">
                <?php echo get_sub_field('title_1'); ?><br>
                <?php echo get_sub_field('title_2'); ?><br>
                <?php echo get_sub_field('title_3'); ?>
            </h2>
        </div>
        <div class="cake-video__player">
            <iframe class="cake-video__iframe" src="<?php echo get_sub_field('video_url'); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>