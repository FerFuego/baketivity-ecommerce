<section class="blog-body" id="<?php echo get_query_var('cat') ? get_category(get_query_var('cat'))->slug : 'blog'; ?>">
    <div class="blog-body__container">
        <div class="blog-body__title">
            <?php echo get_query_var('cat') ? get_category(get_query_var('cat'))->name : 'Blog'; ?>
        </div>
        <div class="blog-body__subtitle">
            <?php echo get_query_var('cat') ? get_category(get_query_var('cat'))->description : 'Read the latest news, recipes, and special content'; ?>
        </div>
        <div class="blog-body__grid">
            <?php get_template_part('loop'); ?>
        </div>
    </div>
</section>
<script>
    // Scroll into view blog category
    document.addEventListener("DOMContentLoaded", function(event) {
        var category = jQuery("#<?php echo get_query_var('cat') ? get_category(get_query_var('cat'))->slug : ''; ?>");
        if (category.length == 0) return;
        var offset = category.offset().top;
        jQuery('html, body').animate({
            scrollTop: offset - 100
        }, 1000);
    });
</script>