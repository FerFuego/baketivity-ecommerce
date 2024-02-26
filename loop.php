<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package storefront
 */

do_action( 'storefront_loop_before' );

$row = 0;
$label = 'View more';
$array_color = ['#FD9A7E', '#FFD64F', '#6ECE86', '#AEAEFC', '#C0DD52'];
$cat_id = get_query_var('cat'); 

if (!$cat_id) {
    /* BLOG PAGE */
    global $wp_query;
    $original_query = $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $wp_query = new WP_Query( [ 
        'post_type' => 'post',
        'status'    => 'published',
        'paginated' => true,
        'posts_per_page' => 12,
        'paged' => $paged, 
    ] );
} else {
    /* CATEGORY PAGE */
    $category = get_term_by('term_id', $cat_id, 'category');
}

/* LABEL BUTTONS */
switch ($category->slug) {
    case 'activities':      $label = 'View more'; break;
    case 'baketivity-news': $label = 'Read news'; break;
    case 'kitchen-tips':    $label = 'View tip';  break;
    case 'parenting':       $label = 'View more'; break;
    case 'resources':       $label = 'Resource';  break;
    case 'recipes':         $label = 'Recipe';    break;
}

/* LOOP POSTS */
while ( have_posts() ) :
	the_post();
    $num = $row % count($array_color);
    set_query_var('color', $array_color[$num]);
	set_query_var('label', $label);
	get_template_part( 'template_parts/partials/post', 'card' );
    $row++;
endwhile;

?> 
</div> 
<?php

/* BLOG PAGE */
if ($original_query) {
    /* PAGINATOR BLOG */
    ?>
    
    <nav id="post-navigation" class="navigation pagination" role="navigation" aria-label="Post Navigation">
        <div class="page-nav-container">
            <?php echo paginate_links(array(
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('<i class="fas fa-chevron-left"></i>'),
                'next_text' => __('<i class="fas fa-chevron-right"></i>')
            )); ?>
        </div>
    </nav>

    <?php
    /* RESET QUERY */
    $wp_query = null;
    $wp_query = $original_query;
    wp_reset_postdata();
}

/**
 * Functions hooked in to storefront_paging_nav action
 *
 * @hooked storefront_paging_nav - 10
 */
do_action( 'storefront_loop_after' );