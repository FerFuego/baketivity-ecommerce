<div class="fundraising-drive">
    <div class="fundraising-drive__container">
        <div class="fundraising-drive__header">
            <div class="fundraising-drive__title"><?php echo get_sub_field('title'); ?></div>
            <div class="fundraising-drive__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
        </div>
        <div class="fundraising-drive__body">
            <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
                <div class="fundraising-drive__item">
                    <img class="fundraising-drive__item-icon" src="<?php echo get_sub_field('icon'); ?>" alt="steps icon <?php echo get_row_index(); ?>">
                    <div class="fundraising-drive__item-num"><?php echo get_row_index(); ?></div>
                    <div class="fundraising-drive__item-title"><?php echo get_sub_field('title'); ?></div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php if (get_sub_field('cta')) : ?>
            <a class="fundraising-drive__cta" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        <?php endif; ?>
        <!-- Brochure -->
        <?php if (get_sub_field('brochure_pdf')) : ?>
            <div class="fundraising-drive__brochure">
                <div class="fundraising-drive__brochure-content">
                    <div class="fundraising-drive__brochure-title"><?php echo get_sub_field('brochure_title'); ?></div>
                    <a class="fundraising-drive__brochure-cta-mobile" href="<?php echo get_sub_field('brochure_pdf'); ?>" target="_new" download>Download Now</a>
                </div>
                <div class="fundraising-drive__brochure-img">
                    <img src="<?php echo get_sub_field('brochure_image'); ?>" alt="brochure image">
                </div>
                <a class="fundraising-drive__brochure-cta" href="<?php echo get_sub_field('brochure_pdf'); ?>" target="_new" download>Download Now</a>
            </div>
        <?php endif; ?>
    </div>
</div>
