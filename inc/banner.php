<?php
///////////////////////////// default settings
$page_on_front = get_option('page_on_front');
if(!$page_on_front) return;

$main = get_field('main', $page_on_front);
if(!$main || !isset($main['banner']) || !isset($main['link'])) return;

$image_src = get_acf_image_url($main['banner']);

//if(!$image_src) return;
$link = $main['link'];

/////////////////////////////
$custom_page = get_field('custom_page', $page_on_front);

if($custom_page){
    if( is_single()){
        $post_id = get_the_ID();
        foreach($custom_page AS $custom_page_settings){
            if(isset($custom_page_settings['product']) && count($custom_page_settings['product'])>0 && isset($custom_page_settings['banner'])){
                foreach($custom_page_settings['product'] AS $page_settings){
                    if($page_settings->ID == $post_id){
                        $image_src = get_acf_image_url($custom_page_settings['banner']);
                        $link = $custom_page_settings['link'];
                    }
                }
            }
        }

} else if(is_tax('product_cat')){
        $product_cat = get_queried_object()->term_id;
        if($product_cat){
            foreach($custom_page AS $custom_page_settings){
                if(isset($custom_page_settings['category']) && is_array($custom_page_settings['category']) &&  in_array($product_cat, $custom_page_settings['category'])){
                    $image_src = get_acf_image_url($custom_page_settings['banner']);
                    $link = $custom_page_settings['link'];
                }
            }
        }
    }else if(is_page()){
        foreach($custom_page AS $custom_page_settings){
            if(isset($custom_page_settings['page'])){
                $page_id = get_the_ID();
                foreach ($custom_page_settings['page'] AS $page_settings){
                    if($page_settings->ID == $page_id){
                        $image_src = get_acf_image_url($custom_page_settings['banner']);
                        $link = $custom_page_settings['link'];
                    }
                }
            }
        }
    }

}
if(!$image_src) return;
?>


<div class="d-bar" style="background: #f83e5d;padding: 0;font-family: 'FilsonPro';">
    <p style="text-align: center">
        <?php if($link):?><a href="<?php echo $link; ?>" title="baketivity"><?php endif;?>
            <img src="<?php echo $image_src;?>" style="display: block; margin: 0 auto;" alt="baketivity_banner">
        <?php if($link):?></a><?php endif;?>
    </p>
</div>