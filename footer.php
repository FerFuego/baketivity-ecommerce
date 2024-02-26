<?php
$navLogo = get_field('c-navbar__logo', 'option');
$footer_gptw = get_field('footer_great_place_to_work', 'option');
$footer_social_icons = get_field('footer_social_icons', 'option');
$footer_flags = get_field('footer_flags', 'option');
$footer_copyright = get_field('footer_copyright', 'option');

$footer_products = wp_nav_menu([
	'menu' => 'Footer Products',
	'echo' => false,
	'menu_class' => 'footer-2023__menu-ul'
]);

$footer_baketivity = wp_nav_menu([
	'menu' => 'Footer Baketivity',
	'echo' => false,
	'menu_class' => 'footer-2023__menu-ul'
]);

$footer_quick_links = wp_nav_menu([
	'menu' => 'Footer Quick Links',
	'echo' => false,
	'menu_class' => 'footer-2023__menu-ul'
]);

$footer_legal = wp_nav_menu([
	'menu' => 'Footer Legal',
	'echo' => false,
	'menu_class' => 'footer-2023__menu-ul-legal'
]);
?>

<footer class="footer-2023" style="<?php echo (get_field('floating_footer_enable', 'option') == true) ? 'padding: 35px 0 55px;' : ''; ?>" id="footer">
	<div class="footer-2023__container footer-2023--form">
		<div class="footer-2023__logo">
			<?php if ($navLogo) : ?>
				<img width="215" height="33.38" src="<?php echo $navLogo['url']; ?>" alt="<?php echo $navLogo['url']; ?>">
			<?php endif; ?>
		</div>
		<form class="footer-2023__form" id="kla_embed_klaviyo_emailsignup_widget--footer" action="//manage.kmail-lists.com/subscriptions/subscribe" method="GET" novalidate="novalidate" target="_blank" data-ajax-submit="//manage.kmail-lists.com/ajax/subscriptions/subscribe">
			<input name="g" type="hidden" value="Kirj9b" />
			<label class="footer-2023__label" for="sign-up-message-input"><?php _e('Sign up our newsletter and Take 10% OFF in your first order', 'baketivity'); ?></label>
			<div class="footer-2023__cont-inputs">
				<input class="footer-2023__input" id="kla_email_klaviyo_emailsignup_widget--footer" type="text" name="email" placeholder="Your email" required>
				<input class="footer-2023__button" type="submit" id="sign-up-message-button" value="<?php _e('Sign up', 'baketivity'); ?>">
				<div class="klaviyo_messages">
					<div class="success_message" style="display: none;"></div>
					<div class="error_message" style="display: none;"></div>
				</div>
			</div>
		</form>
	</div>
	<div class="footer-2023__container">
		<div class="col-lg-3 col-xs-12">
			<div class="footer-2023__container-gptw footer-2023__container-gptw--mobile">
				<img class="footer-2023__gptw-logo" src="<?php echo $footer_gptw['footer_gptw_logo']; ?>" alt="baketivity footer">
				<div class="footer-2023__gptw-text"><?php echo $footer_gptw['footer_gptw_text']; ?></div>
			</div>
			<div class="footer-2023__container-shopper-desktop">
				<a href="https://www.shopperapproved.com/reviews/baketivity.com" class="shopperlink new-sa-seals placement-default">
					<img src="//www.shopperapproved.com/seal/36641/default-sa-seal.gif" style="border-radius: 4px;" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" />
				</a>
				<script type="text/javascript">
					(function() {
						var js = window.document.createElement("script");
						js.innerHTML = 'function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();';
						js.type = "text/javascript";
						document.getElementsByTagName("head")[0].appendChild(js);
						var link = document.createElement('link');
						link.rel = 'stylesheet';
						link.type = 'text/css';
						link.href = "//www.shopperapproved.com/seal/default.css";
						document.getElementsByTagName('head')[0].appendChild(link);
					})();
				</script>
				<div class="footer-2023__container-award">
					<img src="<?= get_stylesheet_directory_uri(); ?>/images/footer/parent-award.svg" alt="Parent Award">
				</div>
			</div>
			<div class="footer-2023__social-icon">
				<?php foreach ($footer_social_icons as $key => $val) : ?>
					<div class="footer-2023__icons">
						<a target="_blank" href="<?php echo $val['footer_si_link']; ?>">
							<img src="<?php echo $val['footer_si_icon']; ?>" alt="social-icon-<?php echo $key; ?>">
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="footer-2023__flags footer-2023__container-gptw--mobile">
				<div class="footer-2023__flags-wrapper">
					<?php foreach ($footer_flags['footer_flags_items'] as $key => $val) : ?>
						<div class="footer-2023__flag-item">
							<img src="<?php echo $val['ff_item_image']; ?>" alt="language-flag-<?php echo $key; ?>">
						</div>
					<?php endforeach; ?>
				</div>
				<div class="footer-2023__shipping-text"><?php echo $footer_flags['footer_flags_text']; ?></div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-12">
			<div class="footer-2023__menu-title">
				<?php _e('Products', 'baketivty'); ?>
				<span class="footer-2023__arrow"></span>
			</div>
			<?php echo $footer_products; ?>
		</div>
		<div class="col-lg-3 col-xs-12">
			<div class="footer-2023__menu-title">
				<?php _e('Baketivity', 'baketivty'); ?>
				<span class="footer-2023__arrow"></span>
			</div>
			<?php echo $footer_baketivity; ?>
		</div>
		<div class="col-lg-3 col-xs-12">
			<div class="footer-2023__menu-title">
				<?php _e('Quick Links', 'baketivty'); ?>
				<span class="footer-2023__arrow"></span>
			</div>
			<?php echo $footer_quick_links; ?>
		</div>
		<div class="col-lg-3 col-xs-12 footer-2023__mobile">
			<div class="footer-2023__container-mobile-gptw">
				<div class="footer-2023__container-gptw">
					<img class="footer-2023__gptw-logo" src="<?php echo $footer_gptw['footer_gptw_logo']; ?>" alt="baketivity footer">
					<div class="footer-2023__gptw-text"><?php echo $footer_gptw['footer_gptw_text']; ?></div>
				</div>
				<div class="footer-2023__container-award">
					<img src="<?= get_stylesheet_directory_uri(); ?>/images/footer/parent-award.svg" alt="Parent Award">
				</div>
				<div>
					<a href="https://www.shopperapproved.com/reviews/baketivity.com" class="shopperlink new-sa-seals placement-default">
						<img src="//www.shopperapproved.com/seal/36641/default-sa-seal.gif" style="border-radius: 4px;" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" />
					</a>
					<script type="text/javascript">
						(function() {
							var js = window.document.createElement("script");
							js.innerHTML = 'function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();';
							js.type = "text/javascript";
							document.getElementsByTagName("head")[0].appendChild(js);
							var link = document.createElement('link');
							link.rel = 'stylesheet';
							link.type = 'text/css';
							link.href = "//www.shopperapproved.com/seal/default.css";
							document.getElementsByTagName('head')[0].appendChild(link);
						})();
					</script>
				</div>
			</div>
			<div class="footer-2023__copyright">
				<div class="footer-2023__copyright-legal"><?php echo $footer_legal; ?></div>
			</div>
			<div class="footer-2023__flags">
				<div class="footer-2023__flags-mobile-container">
					<div class="footer-2023__shipping-text"><?php echo $footer_flags['footer_flags_text']; ?></div>
					<div class="footer-2023__flags-wrapper">
						<?php foreach ($footer_flags['footer_flags_items'] as $key => $val) : ?>
							<div class="footer-2023__flag-item">
								<img src="<?php echo $val['ff_item_image']; ?>" alt="language-flag-<?php echo $key; ?>">
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="footer-2023__copyright-label">&copy; <?php echo date("Y"); ?> All rights reserved Baketivity.</div>
			</div>
		</div>
	</div>
	<div class="footer-2023__container footer-2023__mobile-footer">
		<div class="footer-2023__copyright">
			<div class="footer-2023__copyright-label">&copy; <?php echo date("Y"); ?> All rights reserved Baketivity.</div>
			<div class="footer-2023__copyright-legal"><?php echo $footer_legal; ?></div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>