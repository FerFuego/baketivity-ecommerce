
<!-- The Sweetest Gift: Their Choice -->
<!--  x3 -->
<section class="the-sweetest-gift-their-choice the-sweetest-gift-their-choice--3" style="background-color:<?php echo get_sub_field('background_color'); ?>;">

        <div class="the-sweetest-gift-their-choice__container container">
            <h2 class="the-sweetest-gift-their-choice__title filson-pro-bold"><?php echo get_sub_field('title'); ?>  <strong class="filson-pro-black"><?php echo get_sub_field('title_highlighted'); ?></strong></h2>
        </div>


        <div class="the-sweetest-gift-their-choice__container container">

            <!-- Media -->
            <div class="the-sweetest-gift-their-choice__media-container">
                <!-- Arrow (Desktop) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="104.949" height="45.365" viewBox="0 0 104.949 45.365">
                    <path id="Trazado_2487" data-name="Trazado 2487" d="M127.218,353.313c7.271.881,14.067,1.685,20.852,2.567.485.063.9.7,1.975,1.6-3.242.392-5.718.885-8.205.954-6.571.183-13.147.185-19.721.249a12.787,12.787,0,0,1-2.4-.082c-2.646-.483-3.45-2.2-2.052-4.5a15.966,15.966,0,0,1,2.371-3.02q5.123-5.079,10.372-10.028a15.863,15.863,0,0,1,2.683-1.589c.167,5.084-4.9,6.481-6.005,10.53.907-.176,1.672-.273,2.407-.475,26.968-7.409,53.881-6.608,80.733.593a80.8,80.8,0,0,1,8.167,2.835c1.418.549,2.624,1.557,1.849,3.3-.737,1.661-2.136,1.666-3.652.991-17.9-7.972-36.9-8.9-56.054-8.646a135.972,135.972,0,0,0-29.549,3.513C129.816,352.392,128.683,352.842,127.218,353.313Z" transform="matrix(-0.966, 0.259, -0.259, -0.966, 305.813, 316.201)" fill="#e52441"/>
                </svg>

                <!-- Arrow (Mobile) -->
                <img src="<?php echo get_sub_field('image')['url']; ?>" alt="Girl studying." class="the-sweetest-gift-their-choice__media-image">
            </div>

            <!-- Text -->
            <div class="the-sweetest-gift-their-choice__text-container">
                <div class="the-sweetest-gift-their-choice__copy-container">
                    <?php echo get_sub_field('text'); ?>
                </div>
                <?php if (get_sub_field('button_1_icon')) : ?>
                <div class="the-sweetest-gift-their-choice__copy-container">
                    <a href='<?php echo get_sub_field('button_1_link')['url']; ?>' target='<?php echo get_sub_field('button_1_link')['target']; ?>' class="the-sweetest-gift-their-choice__cta button button--primary">
                        <img src="<?php echo get_sub_field('button_1_icon')['url'] ?>"/>
                        <?php echo get_sub_field('button_1_link')['title']; ?>
                    </a>
                </div>                
                <?php endif; ?>
                
                <?php if (get_sub_field('button_2_icon')) : ?>
                <div class="the-sweetest-gift-their-choice__copy-container">
                    <a href='<?php echo get_sub_field('button_2_link')['url']; ?>' target='<?php echo get_sub_field('button_2_link')['target']; ?>' class="the-sweetest-gift-their-choice__cta button button--primary">
                        <img src="<?php echo get_sub_field('button_2_icon')['url'] ?>"/>
                        <?php echo get_sub_field('button_2_link')['title']; ?>
                    </a>
                </div>                
                <?php endif; ?>

            </div>

        </div>
    </section>
