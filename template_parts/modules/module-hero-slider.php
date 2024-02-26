<div class="hero-slider ">
    <?php if (have_rows('items')) : ?>
        <div class="hero-slider__container-fluid" id="js-hero-slider">
            <?php while (have_rows('items')) : the_row(); ?>
                <div>
                    <style scoped>
                        <?= ".hero-bg-behavior-" . get_row_index(); ?> {
                            background-image: url(<?php echo get_sub_field('bg_desktop')['url']; ?>);
                        }

                        @media (max-width: 768px) {
                            <?= ".hero-bg-behavior-" . get_row_index(); ?> {
                                background-image: url(<?php echo get_sub_field('bg_mobile')['url']; ?>);
                            }
                        }
                    </style>
                    <div class="hero-slider__items hero-bg-behavior-<?= get_row_index(); ?>">
                        <div class="hero-slider__container">
                            <div class="hero-slider__left">
                                <div class="hero-slider__content">
                                    <?php if (get_sub_field('title')) : ?>
                                        <h1 class="hero-slider__title"><?php echo get_sub_field('title'); ?></h1>
                                    <?php endif; ?>
                                    <?php if (get_sub_field('copy')) : ?>
                                        <p class="hero-slider__subtitle"><?php echo get_sub_field('copy'); ?></p>
                                    <?php endif; ?>
                                    <?php if (get_sub_field('reviews')) : ?>
                                        <a href="https://www.shopperapproved.com/reviews/baketivity.com" class="shopperlink new-sa-seals placement-default">
                                            <img src="//www.shopperapproved.com/seal/36641/default-sa-seal.gif" style="border-radius:4px;" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" />
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
                                    <?php endif; ?>
                                    <?php if (get_sub_field('coupon_or_other_text')) : ?>
                                        <p class="hero-slider__coupon-or-other-text"><?php echo get_sub_field('coupon_or_other_text'); ?></p>
                                    <?php endif; ?>
                                    <?php if (get_sub_field('cta')) : ?>
                                        <a class="hero-slider__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hero-slider__right"></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>