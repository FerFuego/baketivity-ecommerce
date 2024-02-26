<div class="search-bar" id="js-module-search">
    <div class="search-bar__container">
        <div class="search-bar__body">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url()); ?>/search">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" id="search-field" placeholder="Search products.." value="" name="search">
				</label>
				<input type="submit" class="search-submit" value="">
			</form>
            <div class="search-bar__close" id="js-close-search">&times;</div>
        </div>
    </div>
</div>