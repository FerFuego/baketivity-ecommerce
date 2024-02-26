</div><!-- .col-full -->
</div><!-- #content -->

<footer class="footer-checkout">
	<div class="footer-checkout__col-full">
		<div class="footer-checkout__logo">
			<?php echo get_custom_logo(); ?>
		</div>
		<div class="footer-checkout__legal">
			<?php echo wp_nav_menu([
				'menu' => 'Footer Legal',
				'echo' => false,
				'menu_class' => 'footer-menu-ul'
			]); ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>