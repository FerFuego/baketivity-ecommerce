<?php if (get_sub_field('header')) : ?>
    <div class="faq-accordion__header"><?php echo get_sub_field('header'); ?></div>
<?php endif; ?>

<?php if (have_rows('questions')) : ?>
    <div class="faq-accordion">
        <?php while (have_rows('questions')) : the_row(); ?>
            <button class="accordion-faq faq-menu-title filson-pro-bold"><?php echo get_sub_field('question'); ?></button>
            <div class="panel filson-pro-regular">
                <?php echo get_sub_field('answer'); ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php if (get_sub_field('title') || get_sub_field('cta') || get_sub_field('cta_2')) : ?>
    <div class="faq-accordion__footer">
        <div class="faq-accordion__footer-title"><?php echo get_sub_field('title'); ?></div>
        <div class="faq-accordion__footer-cta-container">
            <a class="faq-accordion__footer-cta button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
            <a class="faq-accordion__footer-cta-2" href="<?php echo get_sub_field('cta_2')['url']; ?>" target="<?php echo get_sub_field('cta_2')['target']; ?>"><?php echo get_sub_field('cta_2')['title']; ?></a>
        </div>
    </div>
<?php endif; ?>

<script>
    var acc_faq = document.getElementsByClassName("accordion-faq");
    var i;

    for (i = 0; i < acc_faq.length; i++) {
        acc_faq[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>