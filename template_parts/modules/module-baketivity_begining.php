<section class="baketivity-begining">
    <div class="baketivity-begining__container container">

        <!-- Image -->
        <div class="baketivity-begining__img-container">
            <?php $img = get_sub_field('baketivity-begining__image'); ?>
            <?php if ($img) : ?>
                <?php echo wp_get_attachment_image( $img, 'full', false, [ 'loading' => 'true', 'class' => 'baketivity-begining__img'] ); ?>
            <?php endif ?>
        </div>

        <!-- Content -->
        <div class="baketivity-begining__content-container">
            <!-- Title -->
            <?php if(get_sub_field('baketivity-begining__title')): ?>
                <h2 class="baketivity-begining__title">
                    <?php echo get_sub_field('baketivity-begining__title'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="284.359" height="19.089" viewBox="0 0 284.359 19.089">
                        <path d="M339.668,646.136c-6.208-.374-12.424-.641-18.637-.963-2.049-.1-4.106-.112-6.156-.166l-13.348-.351c-2.478-.066-4.957-.147-7.436-.2q-1.077-.021-2.154-.02c-1.613,0-3.228.025-4.841.027q-11.012.013-22.021.026c-1.747,0-3.494.045-5.24.07q-6.49.085-12.978.174c-4.881.067-9.763.093-14.642.218l-23.69.605c-4.572.116-9.147.182-13.717.37q-11.813.484-23.624.963c-4.3.174-8.609.32-12.909.567q-12.214.7-24.428,1.4c-4.351.251-8.707.436-13.048.819q-12.16,1.066-24.321,2.135-2.628.23-5.257.462c-3.5.306-6.989.785-10.479,1.19l-.657.093a2.436,2.436,0,0,0-1.089.654,2.6,2.6,0,0,0,0,3.6,2.334,2.334,0,0,0,1.747.745c4.212-.488,8.417-1.008,12.64-1.377q5.869-.516,11.738-1.027l12.81-1.12c1.719-.15,3.443-.349,5.167-.448q9.986-.571,19.974-1.133l12.45-.708c1.715-.1,3.43-.219,5.144-.29q9.9-.407,19.795-.781,6-.238,12-.473c1.343-.052,2.687-.12,4.033-.153q10.687-.256,21.373-.5l11.935-.282c1.417-.033,2.833-.082,4.248-.1l22.041-.233c4.585-.049,9.165-.094,13.749-.082l23.407.058c1.539,0,3.077.069,4.617.115l12.919.391q4.845.15,9.692.293c2.29.07,4.582.246,6.871.373q10.112.563,20.219,1.2c1.712.112,3.421.244,5.133.373,1.834.137,3.672.27,5.5.484.286.048.568.1.853.166a2.712,2.712,0,0,0,2.06-.277,2.765,2.765,0,0,0,1.228-1.648,2.8,2.8,0,0,0-1.867-3.39,21.943,21.943,0,0,0-3.769-.622q-1.3-.136-2.6-.27c-1.667-.173-3.346-.261-5.016-.391C345.948,646.465,342.806,646.324,339.668,646.136Z" transform="matrix(1, -0.017, 0.017, 1, -89.507, -638.016)" fill="#09989a"/>
                    </svg>
                </h2>
            <?php endif; ?>
            <!-- Text -->
            <?php if(get_sub_field('baketivity-begining__text')): ?>
                <div class="baketivity-begining__copy" id="js-baketivity-begining-copy"><?php echo esc_wysiwyg(get_sub_field('baketivity-begining__text')); ?></div>
            <?php endif; ?>
        </div>

    </div>
</section>