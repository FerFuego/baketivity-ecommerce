<?php
$menues = get_field('pages_list', $item);
$parts = array(1); //sarray_chunk($menues, 5, true); //separate by 5 items to create 2 or more columns
?>

<div class="big-menu" id="js-dropdown-menu">
    <div class="big-menu__content <?php echo count($parts) > 1 ? 'big-menu__multi' : ''; ?>">
        <?php if ($menues) : ?>
            <?php //foreach ($parts as $sub) : 
            ?>
            <ul class="big-menu__list">
                <?php foreach ($menues as $item) : ?>
                    <li class="big-menu__item menu-item menu-item-type-taxonomy menu-item-object-categories-category current-menu-item">
                        <a class="big-menu__item-link js-site-link" href="<?php echo $item['page']['url']; ?>" target="<?php echo $item['page']['target']; ?>" aria-current="page">
                            <img class="big-menu__img <?php echo str_replace(' ', '-', strtolower($item['page']['title'])); ?>" src="<?php echo $item['icon']; ?>" width="14" alt="<?php echo $item['page']['title'] ?>">
                            <?php echo $item['page']['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php //endforeach; 
            ?>
        <?php endif; ?>
    </div>
</div>