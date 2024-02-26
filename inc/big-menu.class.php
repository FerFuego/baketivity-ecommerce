<?php

/**
 * Menu filtering to add in our extra content to main navigation
 * mega menu for desktop
 * additional links for mobile
 * wrapping mega menu class
 */

class BaketivityMenu
{

	public function __construct()
	{
		add_filter('walker_nav_menu_start_el', [$this, 'mega_menu_content'], 20, 4);
	}

	/**
	 * Add content into menu after top level links for mega menu
	 */
	public function mega_menu_content($item_output, $item, $depth, $args)
	{

		if ('mega-menu' !== $args->menu_id || $depth !== 0) {
			return $item_output;
		}

		ob_start();

		if (in_array('has-mega-menu', $item->classes)) {
			set_query_var('item', $item);
			get_template_part('template_parts/base/menu');
		}

		$item_output .= ob_get_clean();

		return $item_output;
	}
}
