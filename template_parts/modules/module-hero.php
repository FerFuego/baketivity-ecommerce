<style scoped>
    .home-bg-behavior {
        background-image: url(<?php echo get_sub_field('background')['url']; ?>);
    }

    @media (max-width: 768px) {
        .home-bg-behavior {
            background-image: url(<?php echo get_sub_field('background_mobile')['url']; ?>);
        }
    }
</style>
<div class="hero home-bg-behavior">
    <div class="hero__container-fluid">
        <div class="hero__container">
            <div class="hero__left">
                <div class="hero__content">
                    <?php if (get_sub_field('logo')) : ?>
                        <div class="hero__logo-mobile">
                            <img src="<?php echo get_sub_field('logo')['url']; ?>" alt="<?php echo get_sub_field('logo')['alt']; ?>">
                        </div>
                    <?php endif; ?>
                    <div class="hero__label"><?php echo get_sub_field('label'); ?></div>
                    <h1 class="hero__title">
                        <?php echo get_sub_field('title'); ?>
                        <?php if (get_sub_field('highlight')) : ?>
                            <span class="hero__highlight"><?php echo get_sub_field('highlight'); ?></span>
                        <?php endif; ?>
                    </h1>
                    <p class="hero__subtitle"><?php echo get_sub_field('copy'); ?></p>
                    <div class="hero__ctas">
                        <?php if (get_sub_field('cta')) : ?>
                            <a class="hero__button button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                        <?php endif; ?>
                        <?php if (get_sub_field('cta_2')) : ?>
                            <a class="hero__button" href="<?php echo get_sub_field('cta_2')['url']; ?>" target="<?php echo get_sub_field('cta_2')['target']; ?>"><?php echo get_sub_field('cta_2')['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hero__right">
                <?php if (get_sub_field('logo')) : ?>
                    <div class="hero__logo">
                        <img src="<?php echo get_sub_field('logo')['url']; ?>" alt="<?php echo get_sub_field('logo')['alt']; ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>