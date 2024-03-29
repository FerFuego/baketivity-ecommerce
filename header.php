<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<title>Best Kids Baking Kits - Kids Baking Subscription Box | Baketivity </title>
	<meta name="description" content="Baketivity kids baking kits is an innovative idea for parents and kids to bake together while learning something new. The Baketivity kids baking subscription box come with easy recipes, premeasured ingredients, and tools for easy baking and cooking." />
	<meta name="p:domain_verify" content="8ee47cf10a2d70a8d8c1a7279aa7e731" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<?php wp_head(); ?>
	<?php if (wp_get_environment_type() == "production") { ?>
		<script type="text/javascript">
			(function(c, l, a, r, i, t, y) {
				c[a] = c[a] || function() {
					(c[a].q = c[a].q || []).push(arguments)
				};
				t = l.createElement(r);
				t.async = 1;
				t.src = "https://www.clarity.ms/tag/" + i;
				y = l.getElementsByTagName(r)[0];
				y.parentNode.insertBefore(t, y);
			})(window, document, "clarity", "script", "ck0rnzyvkw");
		</script>

		<script type="text/javascript">
			! function(e, t, n) {
				function a() {
					var e = t.getElementsByTagName("script")[0],
						n = t.createElement("script");
					n.type = "text/javascript", n.async = !0, n.src = "https://beacon-v2.helpscout.net", e.parentNode
						.insertBefore(n, e)
				}
				if (e.Beacon = n = function(t, n, a) {
						e.Beacon.readyQueue.push({
							method: t,
							options: n,
							data: a
						})
					}, n.readyQueue = [], "complete" === t.readyState) return a();
				e.attachEvent ? e.attachEvent("onload", a) : e.addEventListener("load", a, !1)
			}(window, document, window.Beacon || function() {});
		</script>
		<script type="text/javascript">
			window.Beacon('init', '68878b8d-2c34-49da-ab9a-1d3f32063680')
		</script>
	<?php } ?>
</head>

<body <?php body_class(); ?>>
	<?php if (!is_account_page() && wp_get_environment_type() == "production") : ?>
		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9T5R8J" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
	<?php endif ?>

	<?php do_action('baketivity_before_site'); ?>

	<div id="page" class="hfeed site header-2022">

		<?php do_action('baketivity_insert_after_open_body'); ?>
		<?php do_action('storefront_before_site'); ?>

		<div id="page" class="hfeed site header-2022">
			<?php do_action('storefront_before_header'); ?>

			<?php if (get_field('topbar', 'option')) : ?>
				<?php get_template_part('template_parts/base/topbar-klaviyo'); ?>
			<?php endif; ?>

			<?php if (get_field('topbar-prime', 'option')) : ?>
				<?php get_template_part('template_parts/base/topbar-prime'); ?>
			<?php endif; ?>

			<header id="masthead" class="site-header">
				<?php get_template_part('template_parts/base/navbar'); ?>
				<?php get_template_part('template_parts/base/search'); ?>
			</header>

			<?php do_action('baketivity_before_content'); ?>

			<div id="content" class="site-content" tabindex="-1">