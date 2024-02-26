<div class="hero-search" id="js-hero-search">
    <div class="hero-search__container">
		<form role="search" method="GET" class="search-form" action="<?php echo esc_url(home_url()); ?>/search/">
			<h2 class="hero-search__title">Find what you want here</h2>
			<label>
				<span class="screen-reader-text">Search for:</span>
				<input type="search" class="search-field__module" placeholder="Search products.." value="<?php echo get_query_var( 'search' ); ?>" name="search">
			</label>
			<input type="submit" class="search-submit" value="">
		</form>
    </div>
</div>