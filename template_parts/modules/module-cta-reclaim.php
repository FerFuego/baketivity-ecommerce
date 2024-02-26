<div class="cta-reclaim" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="cta-reclaim__container">
        <div class="cta-reclaim__content">
            <div>
                <h2 class="cta-reclaim__title"><?php echo get_sub_field( 'title' ); ?></h2>
                <p class="cta-reclaim__text"><?php echo get_sub_field( 'copy' ); ?></p>
            </div>
            <div>
                <a class="cta-reclaim__link" href="<?php echo get_sub_field( 'link' )['url']; ?>" class="cta-reclaim__link" target="<?php echo get_sub_field( 'link' )['target']; ?>">
                    Subscribe to HOME today!
                    <!-- <img src="<?php //echo get_template_directory_uri() .'/../baketivity/images/modules/logo.svg'; ?>" alt="logo"> -->
                </a>
            </div>
        </div>
    </div>
</div>