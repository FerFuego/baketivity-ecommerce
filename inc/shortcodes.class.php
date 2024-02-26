<?php
class Shortcodes
{

    public function __construct()
    {
        add_shortcode('pricingtable', [$this, 'pricingtable_func']);
        add_shortcode('testimonial', [$this, 'testimonial_loop_shortcode']);
        add_shortcode('categories_post', [$this, 'categories_post_func']);
        add_shortcode('popular-posts', [$this, 'st_popular_posts_shortcode']);
        add_shortcode('vc_case_study_title', [$this, 'vc_case_study_title_render']);
        add_shortcode('popular-category', [$this, 'st_popular_category_shortcode']);
        add_shortcode('baketivity_subscribe_form', [$this, 'subscribe_link_att']);
        add_shortcode('pricingtable_cooking_kits', [$this, 'pricingtable_cooking_kits']);
        add_shortcode('recipe', [$this, 'grid_recipes_video']);
    }

    public function subscribe_link_att($atts)
    {

        $default = array(
            'id' => '#',
        );

        $vars = shortcode_atts($default, $atts);

        $html = '<form id="kla_embed_klaviyo_emailsignup_widget--10" class="d-lg-flex align-items-center" action="//manage.kmail-lists.com/subscriptions/subscribe" method="GET" novalidate="novalidate" target="_blank" data-ajax-submit="//manage.kmail-lists.com/ajax/subscriptions/subscribe">
                    <input name="g" type="hidden" value="' . $vars['id'] . '" />
                    <div class="klaviyo_field_group d-flex align-items-center">
                        <label style="display: none;" for="kla_email_klaviyo_emailsignup_widget--3333">Email</label>
                        <input id="kla_email_klaviyo_emailsignup_widget--3333" class="" name="email" type="text" placeholder="Your email" required/>
                        <div class="klaviyo_form_actions">
                            <button class="klaviyo_submit_button" id="sign-up-message-button" type="submit">Submit</button>
                        </div>
                    </div>
                    <div class="klaviyo_messages">
                        <div class="success_message" style="display: none;">
                            <p>Thanks for signing up!</p>
                            <a class="thank_you thank_you holiday-season__item-link" href="https://www.baketivity.com/wp-content/themes/baketivity/pdf/Holiday-Guide-2022.pdf" target="_blank" download>Download the holiday guide</a>
                        </div>
                        <div class="error_message" style="display: none;"></div>
                    </div>
                </form>';

        return $html;
    }

    public function pricingtable_func($atts)
    {
        $atts = shortcode_atts(
            array(
                'title_tag' => 'h2',
            ),
            $atts,
            'pricingtable_func'
        );
        extract($atts);
        $args = array(
            'title_tag' => '$title_tag',
            'post_type' => 'product',
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'subscription',
                ),
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'variable-subscription',
                ),
            ),
        );
        $loop = new WP_Query($args);
        ob_start();
        if ($loop->have_posts()) : ?>


            <?php if (is_page_template('shop-page.php') || is_page_template('shop-page') || is_page_template('template_pages/shop-page.php') || is_product()) : ?>
                <div class="sub-product-list__header">
                    <h2 class="sub-product-list__header-title"><?php _e('Choose your monthly plan for play!', 'baketivity'); ?></h2>
                    <h5 class="sub-product-list__header-subtitle"><?php _e('Kid-friendly fun to bake up sweet moments with little ones every month!', 'baketivity'); ?></h5>
                </div>
            <?php endif; ?>

            <div class='sub-product-list subscription-product-list-desk'>
                <?php while ($loop->have_posts()) : $loop->the_post();
                    set_query_var('title_tag', $title_tag);
                    wc_get_template_part('content', 'product_sub');
                endwhile; ?>
            </div>

            <div class="subscription-product-list-mobile">
                <div class="tab action">
                    <?php $x = 1;
                    while ($loop->have_posts()) : $loop->the_post(); ?>
                        <button class="tablinks <?php echo (3 === $x) ? 'active' : ''; ?>" data-slide="<?php echo $x; ?>"><?php echo get_the_title($buttonLoop); ?></button>
                    <?php $x++;
                    endwhile; ?>
                </div>

                <div class="m-subscription__slider-content" id="js-m-subscription">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <div id="<?php echo 'subscription_tab_' . get_the_ID(); ?>" class="tabcontent sub-product-list">
                            <?php
                            set_query_var('title_tag', $title_tag);
                            wc_get_template_part('content', 'product_sub');
                            ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php
        else :
            echo __('No products found');
        endif;
        do_action('d_listen_add_to_cart_event');
        wp_reset_postdata();
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function pricingtable_cooking_kits($atts)
    {
        $atts = shortcode_atts(
            array(
                'title_tag' => 'h2',
            ),
            $atts,
            'pricingtable_cooking_kits'
        );
        extract($atts);
        $args = array(
            'title_tag' => '$title_tag',
            'post_type' => 'product',
            'posts_per_page' => 4,
            'status' => 'publish',
            'orderby' => 'date',

            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'cooking-kits',
                ),
            ),
        );
        $loop = new WP_Query($args);
        ob_start();
        if ($loop->have_posts()) {

            echo "<div class='sub-product-list subscription-product-list-desk'>";
            while ($loop->have_posts()) : $loop->the_post();
                set_query_var('title_tag', $title_tag);
                wc_get_template_part('content', 'product_sub');
            endwhile;
            echo "</div>"; ?>

            <div class="subscription-product-list-mobile">
                <div class="tab action">
                    <?php $x = 1;
                    while ($loop->have_posts()) : $loop->the_post();
                        switch (get_the_ID()) {
                            case '294137':
                                $hardcode_title = 'Monthly';
                                break;
                            case '300280':
                                $hardcode_title = '3 Months';
                                break;
                            case '300283':
                                $hardcode_title = '6 Months';
                                break;
                            case '300284':
                                $hardcode_title = 'Yearly';
                                break;
                            default:
                                $hardcode_title = null;
                                break;
                        } ?>
                        <button class="tablinks <?php echo (3 === $x) ? 'active' : ''; ?>" data-slide="<?php echo $x; ?>"><?php echo $hardcode_title; ?></button>
                    <?php $x++;
                    endwhile; ?>
                </div>

                <div class="m-subscription__slider-content" id="js-m-subscription">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <div id="<?php echo 'subscription_tab_' . get_the_ID(); ?>" class="tabcontent sub-product-list">
                            <?php
                            set_query_var('title_tag', $title_tag);
                            wc_get_template_part('content', 'product_sub');
                            ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php
        } else {
            echo __('No products found');
        }
        do_action('d_listen_add_to_cart_event');
        wp_reset_postdata();
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function testimonial_loop_shortcode($atts)
    {
        extract(shortcode_atts(array(
            'type' => 'testimonial',
            'perpage' => 4
        ), $atts));

        $args = array(
            'post_type' => $type,
            'posts_per_page' => $perpage,
        );
        $andrew_query = new  WP_Query($args);
        ob_start();

        echo '<div class="owl-carousel owl-theme testimonial">';
        while ($andrew_query->have_posts()) : $andrew_query->the_post(); ?>
            <div class="item">
                <img class="quote-photo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/np_quote_1615893_000000.svg" alt="">
                <div class="quote">
                    <?php the_content(); ?>
                </div>
                <div class="des">
                    <?php if (get_field('photo')) : ?>
                        <div class="photo">
                            <img src="<?php echo get_field('photo'); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="bio">
                        <h5><?php echo get_the_title(); ?><?php if (get_field('position')) : ?>,
                            <span><?php echo get_field('position'); ?></span>
                        <?php endif; ?>
                        </h5>
                        <p><?php echo get_field('bio') ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata();
        echo '</div>';
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function categories_post_func($atts)
    {
        extract(shortcode_atts(array(
            'type' => 'testimonial',
            'perpage' => 4
        ), $atts));

        $partners_obj = get_terms('category', array('hide_empty' => false));

        ob_start();

        echo '<div class="list-term-post">';

        foreach ($partners_obj as $term) {  ?>
            <div class="cat-item">
                <a href="<?php echo get_term_link($term->slug, 'category'); ?>" class="cat-item-link">
                    <div class="cat-item-in">
                        <?php
                        $image = get_field('icon', $term);
                        $color = get_field('background', $term);
                        ?>
                        <div class="cat-item-icon" style="background-color: <?php echo $color; ?> ">
                            <img src="<?php echo $image; ?>" alt="">
                        </div>
                        <h3 class="cat-item-title">
                            <?php echo $term->name; ?>
                        </h3>
                        <span class="cat-item-count">
                            BROWSE COLLECTION (<?php echo  $term->count; ?>)
                        </span>
                    </div>
                </a>

            </div>
        <?php  }

        echo '</div>';
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }

    public function st_popular_posts_shortcode($atts, $content)
    {
        $pop_posts = get_transient('st_popular_posts');
        if (false === $pop_posts) {
            $args = apply_filters('showcase_filter_popular_posts', array(
                'orderby'                    => 'comment_count',
                'posts_per_page'    => 5,
            ));
            $pop_posts = new WP_Query($args);
            set_transient('st_popular_posts', $pop_posts, WEEK_IN_SECONDS);
        }
        $current_post_id = get_the_ID();
        ob_start(); ?>
        <div class="showcase-popular-posts">
            <div class="row">
                <?php if ($pop_posts->have_posts()) {
                    $count = 1;
                    while ($pop_posts->have_posts()) : $pop_posts->the_post();
                        global $post;
                        if (get_the_ID() != $current_post_id) {
                            $class = array('blog-article', 'featured-article', 'col', 'col-xsmall-full', 'article-' . $count);
                            $class[] = 'col-large-one-third'; ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
                                <div class="article-inner-wrapper">
                                    <div class="featured-image">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                                            <?php the_post_thumbnail('thumb-post-sidebar'); ?>
                                        </a>
                                    </div>
                                    <div class="entry-wrapper">
                                        <div class="entry-header">
                                            <?php
                                            the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>'); ?>
                                        </div><!-- .entry-header -->
                                        <footer class="entry-footer">
                                            <span><?php echo get_the_date('M d, Y'); ?></span>
                                        </footer><!-- .entry-footer -->
                                    </div><!-- .entry-wrapper -->
                                </div><!-- .article-inner-wrapper -->
                            </article><!-- #post-## -->
                <?php $count++;
                        }
                    endwhile;
                } ?>
            </div><!-- .row -->
        </div><!-- .showcase-popular-posts -->
    <?php $return = ob_get_clean();
        wp_reset_query();
        return $return;
    }

    public function st_popular_category_shortcode($atts, $content)
    {
        $partners_obj = get_terms('category', array('hide_empty' => false, 'number' => 4));
        ob_start(); ?>
        <div class="showcase-popular-category">
            <?php foreach ($partners_obj as $term) {  ?>
                <div class="cat-item">
                    <a href="<?php echo get_term_link($term->slug, 'category'); ?>" class="cat-item-link">
                        <div class="showcase-cat-item-in">
                            <?php
                            $image = get_field('thumbnail', $term);

                            ?>

                            <div class="thumb-nail">
                                <span><img src="<?php echo $image; ?>" alt=""></span>
                            </div>

                            <h3 class="cat-item-title">
                                <?php echo $term->name; ?>
                                <span class="cat-item-count">
                                    BROWSE COLLECTION (<?php echo  $term->count; ?>)
                                </span>
                            </h3>

                        </div>
                    </a>

                </div>
            <?php } ?>
            <div class="btn-row" style="text-align: center;">
                <a href="<?php echo home_url('/blog/') ?>" class="btn">ALL COLLECTIONS</a>
            </div>

        </div><!-- .showcase-popular-posts -->
<?php $return = ob_get_clean();
        wp_reset_query();
        return $return;
    }

    public function vc_case_study_title_render($atts)
    {
        $atts = vc_map_get_attributes('vc_case_study_title', $atts);
        return '{{ case_study_title }}';
    }

    public function grid_recipes_video($atts)
    {
        extract(shortcode_atts(array(
            'type'    => 'recipe',
            'perpage' => 12
        ), $atts));

        if (!empty($atts['year'])) {
            $year = (int) $atts['year'];
        } else {
            $year = date('Y');
        }

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => $type,
            'posts_per_page' => $perpage,
            'order' => 'DESC',
            'post_status' =>  array('publish'),
            'paged' => $paged,
            'date_query' => array(
                array(
                    'year' => $year
                ),
            )
        );
        $d_query = new  WP_Query($args);
        ob_start();

        if ($d_query->have_posts()) {
            echo '<div class="d-section-rp"><div class="d-recipes">';
            while ($d_query->have_posts()) : $d_query->the_post();
                get_template_part('template_parts/content', 'recipe');
            endwhile;
            echo pagination($paged, $d_query->max_num_pages, $year);
            wp_reset_postdata();
            echo '</div>';
            get_template_part('template_parts/recipe-vote-modal');
        } else {
            echo '<div class="d-section-rp">';
            echo '<h2 class="bake-away-submit__no-found">No recipes found, be the first!</h2>';
            echo '</div>';
        }
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
}
