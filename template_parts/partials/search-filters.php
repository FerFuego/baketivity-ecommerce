<?php
$data = new Search_Baketivity();
$search = get_query_var( 'search' ) ? get_query_var( 'search' ) : null;
$list_categories = $data->get_all_count_categories($search);
?>
<div class="filters-shop">
    <div class="filters-shop__container">
        <div class="filters-shop__body">
            <form class="filters-shop__form">
                <!-- Filter by Category -->
                <div class="ms-parent filters-shop__input filter-category">
                    <button type="button" class="ms-choice">
                        <span class="placeholder">Shop by category</span>
                        <div class="icon-caret"></div>
                    </button>
                    <div class="ms-drop bottom">
                        <ul id="searchCategory">
                        <?php foreach ($data->get_shop_categories($search) as $key => $category) : ?>
                            <li>
                                <label>
                                    <input type="checkbox" value="<?php echo $category->slug; ?>" data-key="<?php echo $category->slug; ?>_<?php echo $key; ?>" name="selectItemsearchCategory">
                                    <span><?php echo $category->name; ?></span>
                                    <?php if ($list_categories && array_key_exists($category->slug, $list_categories)) : ?>
                                            <sup>(<?php echo $list_categories[$category->slug]; ?>)</sup>
                                    <?php else : ?>
                                        <sup>(0)</sup>
                                    <?php endif; ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="filters-shop__mobile">
                    <div class="filters-shop__logo">
                        <img src="<?php echo esc_url(home_url()) . '/wp-content/themes/baketivity/images/logo-red.png'; ?>" alt="log-red-mobile">
                    </div>
                    <a href="#" class="filters-shop__close">&times;</a>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-price">
                            <button type="button" class="ms-choice">
                                <span class="">Filter by price</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom">
                                <ul id="searchPrice" style="max-height: 250px;">
                                    <li>
                                        <label>
                                            <input type="radio" value="5-10" data-key="option_1" name="selectItemsearchPrice">
                                            <span>$5 to $10</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="10-50" data-key="option_2" name="selectItemsearchPrice">
                                            <span>$10 to $50</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="50-100" data-key="option_3" name="selectItemsearchPrice">
                                            <span>$50 to $100</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="100-150" data-key="option_4" name="selectItemsearchPrice">
                                            <span>$100 to $150</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="150-200" data-key="option_5" name="selectItemsearchPrice">
                                            <span>$150 to $200</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-order" title="">
                            <button type="button" class="ms-choice">
                                <span class="">Sort by</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom">
                                <ul id="sortBy" style="max-height: 250px;">
                                    <li>
                                        <label>
                                            <input type="radio" value="higher_price" data-key="option_1" name="selectItemsortBy">
                                            <span>Higher price first</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="lower_price" data-key="option_2" name="selectItemsortBy">
                                            <span>Lower price first</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="date" data-key="option_3" name="selectItemsortBy">
                                            <span>Newest first</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="popular" data-key="option_4" name="selectItemsortBy">
                                            <span>Most popular</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="name" data-key="option_5" name="selectItemsortBy">
                                            <span>Name</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="current_page" id="current_page" value="<?php echo get_query_var('paged') ? (int) get_query_var('paged') : 1; ?>">
            </form>
            
            <div class="grid-shop__loader-container" id="js-shop-filter-loader"></div>
            <button class="filters-shop__cta" id="js-filter-mobile"></button>
        </div>
    </div>
</div>

<div class="filters-shop__container">
    <div class="filters-shop__content">
        <div class="filters-shop__breadcrumb" id="js-shop-breadcrumbs"></div>
        <a href="javascript:void(0);" class="filters-shop__clear js-shop-clear">Clear all filters</a>
    </div>
</div>