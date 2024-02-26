<?php $left_right = get_sub_field('left_right'); ?>

<div class="left-right_bake_away">
    <div class="left-right_bake_away__container <?= ($left_right) ? 'row-left' : 'row-right' ?>">
        <div class="left-right_bake_away__left">
            <?php if (!get_sub_field('video_switch')) : ?>
                <?php if ($image = get_sub_field('image')) : ?>
                    <?php echo wp_get_attachment_image($image, 'full', false, ['loading' => 'false', 'class' => 'left-right_bake_away__image']); ?>
                <?php endif; ?>
            <?php else : ?>
                <?php if (get_sub_field('video_url')) : ?>
                    <div class="left-right_bake_away__video">
                        <?php videoSupport([
                            'field' => 'video_url',
                            'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><g id="Grupo_77725" data-name="Grupo 77725" transform="translate(-438 -678)">
                              <rect id="Rectángulo_6412" data-name="Rectángulo 6412" width="118.369" height="75.225" rx="15" transform="translate(438 678)" fill="#c0dd52"/>
                              <path id="Polígono_6" data-name="Polígono 6" d="M23.231,0,46.463,39.825H0Z" transform="translate(520.969 692.381) rotate(90)" fill="#fff"/></g>
                              </svg>',
                            'placeholder_url' => get_sub_field('video_placeholder')['url'],
                        ]); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (get_sub_field('red_arrow')) : ?>
                <img class="left-right_bake_away__red-arrow" src="/wp-content/themes/baketivity/images/modules/red-arrow-right.svg" alt="red arrow">
            <?php endif; ?>
        </div>
        <div class="left-right_bake_away__right">
            <?php if ($title = get_sub_field('title')) : ?>
                <h2 class="left-right_bake_away__title"><?= $title; ?></h2>
            <?php endif; ?>
            <?php if ($copy = get_sub_field('copy')) : ?>
                <div class="left-right_bake_away__copy"><?= $copy; ?></div>
            <?php endif; ?>
            <?php if ($deadline = get_sub_field('deadline')) : ?>
                <p class="left-right_bake_away__deadline"><?= $deadline; ?></p>
            <?php endif; ?>
            <?php if ($cta = get_sub_field('cta')) : ?>
                <a class="left-right_bake_away__cta button-hovered" href="<?= $cta['url']; ?>" target="<?= $cta['target']; ?>"><?= $cta['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>