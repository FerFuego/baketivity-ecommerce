<?php $data = new Shop_Baketivity(); ?>

<div class="filters-shop">
    <div class="filters-shop__container">
        <div class="filters-shop__body">
            <form class="filters-shop__form">
                <!-- Filter Sort by -->
                <div class="ms-parent filters-shop__input display_mobile filter-order-mobile">
                    <button type="button" class="ms-choice filters-shop__outside-button">
                        <div class="filters-shop__icon-sort"></div>
                        <span class="">Sort by</span>
                    </button>
                    <div class="ms-drop bottom filters-shop__outside-dropdown">
                        <ul id="sortByOutside" style="max-height: 250px;">
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
                <div class="filters-shop__mobile">
                    <div class="filters-shop__logo display_mobile">
                       Filters
                       <a href="#" class="filters-shop__close">&times;</a>
                    </div>
                    <div class="filters-shop__filters display_mobile">
                        <div class="filters-shop__filters-title">
                            <span>Filtered by:</span>
                            <a href="javascript:void(0);" class="filters-shop__filter-clear-mobile js-shop-clear active">Clear all</a>
                        </div>
                        <div class="filters-shop__breadcrumb active" id="js-shop-breadcrumbs-mobile"></div>
                    </div>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-category">
                            <button type="button" class="ms-choice">
                                <span class="placeholder">Shop by Category</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom" style="max-height: 405px;">
                                <ul id="searchCategory">
                                <?php foreach ($data->get_shop_categories() as $key => $category) : ?>
                                    <li>
                                        <label>
                                            <input type="checkbox" value="<?php echo $category->slug; ?>" data-key="<?php echo $category->slug; ?>_<?php echo $key; ?>" name="selectItemsearchCategory">
                                            <span><?php echo $category->name; ?></span>
                                            <sup>(<?php echo $category->count; ?>)</sup>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-type">
                            <button type="button" class="ms-choice">
                                <span class="">Product Type</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom">
                                <ul id="searchType" style="max-height: 250px;">
                                    <?php 
                                        $i = 1;
                                        $categories = Shop_Baketivity::get_child_categories('type');
                                        foreach($categories as $category) : ?>
                                            <li>
                                                <label>
                                                    <input type="radio" value="<?php echo $category->slug; ?>" data-key="option_<?php echo $i; ?>" name="selectItemsearchType">
                                                    <span><?php _e($category->name, 'baketivity'); ?></span>
                                                </label>
                                            </li>
                                        <?php 
                                        $i++; 
                                        endforeach; 
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-age">
                            <button type="button" class="ms-choice">
                                <span class="placeholder">Filter by Age</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom" style="max-height: 250px;">
                                <ul id="searchAge">
                                    <li>
                                        <label>
                                            <input type="radio" value="3-to-5" data-key="option_1" name="selectItemsearchAge">
                                            <span>3 +</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="6-to-8" data-key="option_2" name="selectItemsearchAge">
                                            <span>6 +</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="9-to-12" data-key="option_3" name="selectItemsearchAge">
                                            <span>9 +</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="more-of-12" data-key="option_4" name="selectItemsearchAge">
                                            <span>12 +</span>
                                        </label>
                                    </li>
                                    <?php 
                                        // not in use
                                        /* $i = 1;
                                        $categories = Shop_Baketivity::get_child_categories('age');
                                        foreach($categories as $category) : ?>
                                            <li>
                                                <label>
                                                    <input type="radio" value="<?php echo $category->slug; ?>" data-key="option_<?php echo $i; ?>" name="selectItemsearchAge">
                                                    <span><?php _e($category->name, 'baketivity'); ?></span>
                                                </label>
                                            </li>
                                        <?php 
                                        $i++; 
                                        endforeach; */
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filters-shop__block">
                        <div class="ms-parent filters-shop__input filter-price">
                            <button type="button" class="ms-choice">
                                <span class="placeholder">Filter by Price</span>
                                <div class="icon-caret"></div>
                            </button>
                            <div class="ms-drop bottom">
                                <ul id="searchPrice" style="max-height: 250px;">
                                    <li>
                                        <label>
                                            <input type="radio" value="5-20" data-key="option_1" name="selectItemsearchPrice">
                                            <span>$5 to $20</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="20-30" data-key="option_2" name="selectItemsearchPrice">
                                            <span>$20 to $30</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="30-50" data-key="option_3" name="selectItemsearchPrice">
                                            <span>$30 to $50</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="50-100" data-key="option_4" name="selectItemsearchPrice">
                                            <span>$50 to $100</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" value="100-1000" data-key="option_5" name="selectItemsearchPrice">
                                            <span>$100 +</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filters-shop__block display_desktop">
                        <div class="ms-parent filters-shop__input filter-order">
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
                    <div class="filters-shop__block-mobile display_mobile_flex">
                        <button class="filters-shop__reset js-shop-clear" type="reset">Clear</button>
                        <button class="filters-shop__submit" type="button">Apply</button>
                    </div>
                </div>
                <input type="hidden" name="current_page" id="current_page" value="<?php echo get_query_var('paged') ? (int) get_query_var('paged') : 1; ?>">
            </form>
            
            <div class="filters-shop__loader-container-mobile" id="js-shop-filter-loader"></div>
            <button class="filters-shop__cta" id="js-filter-mobile">
                <div class="filters-shop__icon-filter"></div>
                <span>Filters</span>
                <span class="filters-shop__count-filters"></span>
            </button>
        </div>
    </div>
</div>

<div class="filters-shop__container display_desktop">
    <div class="filters-shop__content">
    <div class="filters-shop__breadcrumb" id="js-shop-breadcrumbs"></div>
        <a href="javascript:void(0);" class="filters-shop__clear js-shop-clear">Clear all filters</a>
    </div>
</div>