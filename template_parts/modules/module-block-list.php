<div class="block-list">
    <div class="block-list__container">
        <div class="block-list__content">
            <div class="block-list__block" style="background-image: url(<?php echo get_sub_field('current_image')['url']; ?>);"></div>
            <?php if (get_sub_field('current_link_pdf')) : ?>
                <a class="block-list__link button-hovered" href="<?php echo get_sub_field('current_link_pdf')['url']; ?>" target="<?php echo get_sub_field('current_link_pdf')['target']; ?>"><?php echo get_sub_field('current_link_pdf')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>