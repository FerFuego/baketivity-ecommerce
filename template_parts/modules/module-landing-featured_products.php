<?php 
    $heading = get_sub_field('heading');
?>
<section class="module module-products" id="module-subscribe">
    <div class="product--heading">
        <diw class="wrapper">
            <h2 class="module--title"><?= $heading ?></h2>
        </diw>
    </div>

    <div class="products">
        <?php while( have_rows('products') ): the_row(); ?>
            <?php 
                $gallery = get_sub_field('gallery');
                $name    = get_sub_field('product_name');
                $desc    = get_sub_field('description');
                $cta     = get_sub_field('cta');
                $link    = get_sub_field('link');
            ?>
            <div class="products--item">
                <div class="products--wrapper">
                    <div class="products--thumb">
                        <ul>
                            <?php foreach( $gallery as $img ): ?>
                                <li>
                                    <img src="<?= $img['url'] ?>" alt="">
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <div class="thumbnails">
                            <?php foreach( $gallery as $img ): ?>
                                <div>
                                    <img src="<?= $img['url'] ?>" alt="">
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="products--content">
                        <div class="product--header">
                            <div class="product--header__title">
                                <div class="rating">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="75.64" height="13.766" viewBox="0 0 75.64 13.766">
                                        <path id="Union_1" data-name="Union 1" d="M-120.006-529.415l-3.2-2.436-3.2,2.427a.866.866,0,0,1-1.352-.945l1.239-4-3.155-2.254a.865.865,0,0,1,.5-1.569h3.856l1.283-4.195a.863.863,0,0,1,1.655,0l1.274,4.195v.009h3.857a.865.865,0,0,1,.5,1.569l-3.154,2.254,1.239,4a.869.869,0,0,1-.832,1.126A.847.847,0,0,1-120.006-529.415Zm-15.5,0-3.2-2.436-3.2,2.427a.866.866,0,0,1-1.352-.945l1.239-4-3.155-2.254a.865.865,0,0,1,.5-1.569h3.857l1.283-4.195a.863.863,0,0,1,1.655,0l1.274,4.195v.009h3.857a.865.865,0,0,1,.5,1.569l-3.155,2.254,1.239,4a.869.869,0,0,1-.832,1.126A.847.847,0,0,1-135.5-529.415Zm-15.5,0-3.2-2.436-3.2,2.427a.866.866,0,0,1-1.352-.945l1.239-4-3.155-2.254a.865.865,0,0,1,.5-1.569h3.857l1.283-4.195a.864.864,0,0,1,1.656,0l1.273,4.195v.009h3.857a.865.865,0,0,1,.5,1.569l-3.155,2.254,1.239,4a.869.869,0,0,1-.832,1.126A.847.847,0,0,1-151-529.415Zm-15.5,0-3.2-2.436-3.2,2.427a.866.866,0,0,1-1.352-.945l1.239-4-3.155-2.254a.865.865,0,0,1,.5-1.569h3.857l1.283-4.195a.864.864,0,0,1,1.656,0l1.273,4.195v.009h3.857a.865.865,0,0,1,.5,1.569l-3.155,2.254,1.239,4a.868.868,0,0,1-.831,1.126A.847.847,0,0,1-166.492-529.415Zm-15.5,0-3.2-2.436-3.2,2.427a.866.866,0,0,1-1.352-.945l1.239-4-3.155-2.254a.865.865,0,0,1,.5-1.569h3.857l1.283-4.195a.864.864,0,0,1,1.656,0l1.273,4.195v.009h3.857a.865.865,0,0,1,.5,1.569l-3.155,2.254,1.239,4a.868.868,0,0,1-.831,1.126A.847.847,0,0,1-181.987-529.415Z" transform="translate(192.016 543)" fill="#ffe693"/>
                                    </svg>
                                    <a href="#testimonials">5.0 Ratings</a>
                                </div>
                                <h3 class="products--name"><?= $name ?></h3>
                            </div>

                            <div class="product--header__price">
                                <div class="price">
                                    <div class="price--value">$30.00</div>
                                    <div class="price--ribbon">Monthly</div>
                                </div>
                            </div>
                        </div>

                        <?= $desc ?>

                        <div class="subscriptions">
                            <?php 
                                $display = get_sub_field('subscription')[0]; 
                                $title = $display['display_title'];
                                $savings = $display['savings'];
                                $price = $display['display_price'];
                                $prod = $display['product'];
                                $prod_id = $prod->ID;
                                $product = wc_get_product( $prod_id );
                            ?>
                            <div class="subscriptions--item" id="display-item" data-price="<?= $price ?>">
                                <div class="subscription--name"><?= $title ?></div>
                                <div class="subscription--savings"><?= $savings ?></div>
                                <div class="subscription--price"><?= $price ?></div>
                                <div class="subscription--total" style="opacity: 0;">Total <?= get_woocommerce_currency_symbol() . $product->get_price(); ?></div>
                            </div>
                            
                            <?php $i = 1; ?>
                            <?php while( have_rows('subscription') ): the_row(); ?>
                                <?php 
                                    $savings = get_sub_field('savings');
                                    $price = get_sub_field('display_price');
                                    $title = get_sub_field('display_title');
                                    $prod = get_sub_field('product');
                                    $prod_id = $prod->ID;
                                    $product = wc_get_product( $prod_id );


                                ?>
                                <div class="subscriptions--item hidden-item <?= $i == 1 ? 'active first' : '' ?>" id="item-<?= $i ?>" data-id="<?= $i ?>" data-price="<?= $price ?>">
                                    <div class="subscription--name"><?= $title ?></div>
                                    <div class="subscription--savings"><?= $savings ?></div>
                                    <div class="subscription--price"><?= $price ?></div>
                                    <div class="subscription--total">Total <?= get_woocommerce_currency_symbol() . $product->get_price(); ?></div>
                                </div>
                                <?php $i++ ?>
                            <?php endwhile; ?>
                        </div>

                        <div class="subscription-atc">
                            <?php $i = 1; ?>
                            <?php while( have_rows('subscription') ): the_row(); ?>
                                <?php 
                                    $prod = get_sub_field('product');
                                    $prod_id = $prod->ID;
                                ?>
                                <div class="atcs atc-item <?= $i == 1 ? 'active' : '' ?>" id="atc-<?= $i ?>" data-id="<?= $i ?>">
                                <?php 
                                    $checkout_url = WC()->cart->get_checkout_url();
                                ?>
                                <a 
                                    href="<?= $checkout_url ?>?add-to-cart=<?= $prod_id ?>" 
                                    data-quantity="1" 
                                    class="button product_type_subscription" 
                                    data-product_id="<?= $prod_id ?>" 
                                    data-product_sku="3M-HOME" 
                                    rel="nofollow" 
                                    product_type="subscription"><span>Join the <?= strtok($name, " ") ?> Club</span></a>
                                </div>
                                <?php $i++ ?>
                            <?php endwhile; ?>
                        </div>

                        <?php if( $link ): ?>
                            <a href="<?= $link['url'] ?>" class="link link--primary"><?= $link['title'] ?></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endwhile ?> 
    </div>
</section>