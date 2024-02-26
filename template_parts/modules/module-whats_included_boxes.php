<?php if(have_rows('items', 'option')): ?>
<div class="whats-included-boxes">
    <div class="container">
        <div class="whats-included-boxes__header">
            <h2 class="whats-included-boxes__title"><?php echo get_field('title_header', 'option'); ?></h2>
        </div>
        <div class="whats-included-boxes__content" id="js-whats-included-boxes">            
                <?php while(have_rows('items', 'option')): the_row(); ?>
                    <div class="whats-included-boxes__item">
                        <div class="whats-included-boxes__item-image" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
                        <div class="whats-included-boxes__item-content">
                            <h3 class="whats-included-boxes__item-title"><?php echo get_sub_field('title'); ?></h3>
                            <p class="whats-included-boxes__item-description"><?php echo get_sub_field('description'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif; ?>