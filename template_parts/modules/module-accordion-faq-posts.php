<?php if (get_field('header')) : ?>
    <div class="faq-accordion__header"><?php echo get_field('header'); ?></div>
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

<?php if (get_field('title')) : ?>
    <div class="faq-accordion__footer">
        <div class="faq-accordion__footer-title"><?php echo get_field('title'); ?></div>
        <a class="faq-accordion__footer-cta" href="<?php echo get_field('cta')['url']; ?>" target="<?php echo get_field('cta')['target']; ?>"><?php echo get_field('cta')['title']; ?></a>
    </div>
<?php endif; ?>

<script>
    var acc_faq = document.getElementsByClassName("accordion-faq");
    var i;

    for (i = 0; i < acc_faq.length; i++) {
        acc_faq[i].addEventListener("click", function () {
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