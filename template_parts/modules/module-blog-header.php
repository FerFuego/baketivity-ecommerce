<style scoped>
.hero-blog-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .hero-blog-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
    .zoom-in-out-box:hover {
        animation: none;
        opacity: .9;
    }
}
</style>
<section class="blog-header hero-blog-bg-behavior">
    <div class="blog-header__container">
        <div class="blog-header__title"><?php echo get_sub_field('title'); ?></div>
        <div class="blog-header__list">
            <?php if (have_rows('Items')) : ?>
                <?php while (have_rows('Items')) : the_row(); 
                    $cat = get_category( get_sub_field('category') ); 
                    $page_cat = get_query_var( 'cat' ) ? get_category( get_query_var( 'cat' ) )->slug : ''; ?>
                    <a class="blog-header__item <?php echo ($cat->slug == $page_cat) ? 'active': ''; ?>" href="<?php echo get_category_link($cat->term_id ); ?>">
                        <img class="blog-header__item-img" src="<?php echo get_sub_field('icon'); ?>" alt="<?php echo $cat->name; ?>">
                        <h4 class="blog-header__item-title"><?php echo $cat->name; ?></h4>
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>