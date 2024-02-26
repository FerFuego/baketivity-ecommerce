<div class="home-share" style="background-color: <?php echo get_sub_field('share_background_color'); ?>">
    <div class="home-share__container">
        <h2 class="home-share__title"><?php echo get_sub_field('share_title'); ?></h2>
        <div class="home-share__content">
            <h5 class="home-share__subtitle">
                <?php echo get_sub_field('share_subtitle'); ?>
                <?php 
                    $share_instagram = get_sub_field('share_instagram');                    
                    if (!empty($share_instagram)) : ?>
                        <a class="home-share__link home-share__link--mobile" href="<?php echo $share_instagram['url']; ?>" <?php echo !empty($share_instagram['target']) && strlen($share_instagram['target']) > 0  ? "target='" . $share_instagram['target'] . "' " : ""; ?>><?php echo $share_instagram['title']; ?></a>
                <?php endif; ?>
            </h5>
            <?php if (!empty($share_instagram)) : ?>
                <a class="home-share__link" href="<?php echo $share_instagram['url']; ?>" <?php echo !empty($share_instagram['target']) && strlen($share_instagram['target']) > 0  ? "target='" . $share_instagram['target'] . "' " : ""; ?>><?php echo $share_instagram['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>