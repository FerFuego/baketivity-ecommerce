<div class="footer-ready-to-become" style="background-image: url(<?php echo get_sub_field('background_image')['url']; ?>);">
    <div class="footer-ready-to-become__shadow">
        <div class="footer-ready-to-become__container">
            <img class="footer-ready-to-become__icon" src="<?php echo get_sub_field('icon')['url']; ?>" alt="icon box">
            <h3 class="footer-ready-to-become__title"><?php echo get_sub_field('title'); ?></h3>
            <p class="footer-ready-to-become__copy"><?php echo get_sub_field('copy'); ?></p>
            <div class="footer-ready-to-become__division"></div>
            <h4 class="footer-ready-to-become__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
            <div class="footer-ready-to-become__cta">
                <?php if (get_sub_field('cta_1')) : ?>
                    <a class="footer-ready-to-become__cta-btn button-hovered" href="<?php echo get_sub_field('cta_1')['url']; ?>" target="<?php echo get_sub_field('cta_1')['target']; ?>"><?php echo get_sub_field('cta_1')['title']; ?></a>
                <?php endif; ?>
                <?php if (get_sub_field('cta_2')) : ?>
                    <a class="footer-ready-to-become__cta-btn button-hovered" href="<?php echo get_sub_field('cta_2')['url']; ?>" target="<?php echo get_sub_field('cta_2')['target']; ?>"><?php echo get_sub_field('cta_2')['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>