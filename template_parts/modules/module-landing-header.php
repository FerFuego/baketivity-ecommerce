<section class="module module-header">
    <div class="wrapper">
        <?php 
            $logo = get_sub_field('logo');
            $button = get_sub_field('button');
        ?>

        <div class="header">
            <div class="header--logo">
                <a href="<?= get_home_url() ?>"><img src="<?= $logo['url'] ?>" alt="logo"></a>
            </div>
            <div class="header--button">
                <a href="<?= $button['url'] ?>" class="btn btn--primary"><?= $button['title'] ?></a>
            </div>
        </div>
    </div>
</section>