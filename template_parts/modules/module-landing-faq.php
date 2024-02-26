<?php
    $heading = get_sub_field('heading');
?>

<section class="module module-faq">
    <div class="wrapper">
        <h2 class="module--title"><?= $heading ?></h2>

        <div class="faqs">
            <?php if( have_rows('faqs') ): ?>
                <div class="faqs-item faqs--left">
                    <div class="faq">
                    <?php while( have_rows('faqs') ): the_row(); ?>
                        <div class="faq--item">
                            <?php 
                                $question   = get_sub_field('question');
                                $answer     = get_sub_field('answer');
                            ?>
                            <h3 class="faq--question"><span><?= $question ?></span><span class="faq--trigger"></span></h3>
                            <div class="faq--answer">
                                <?= $answer ?>
                            </div>
                        </div>
                    <?php endwhile ?>
                    </div>
                </div>
            <?php endif ?>

            <?php if( have_rows('faqs_2') ): ?>
                <div class="faqs-item faqs--right">
                    <div class="faq">
                        <?php while( have_rows('faqs_2') ): the_row(); ?>
                            <div class="faq--item">
                                <?php 
                                    $question   = get_sub_field('question');
                                    $answer   = get_sub_field('answer');
                                ?>
                                <h3 class="faq--question"><span><?= $question ?></span><span class="faq--trigger"></span></h3>
                                <div class="faq--answer">
                                    <?= $answer ?>
                                </div>
                            </div>
                        <?php endwhile ?>
                        </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>