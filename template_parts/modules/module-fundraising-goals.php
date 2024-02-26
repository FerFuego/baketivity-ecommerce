<div class="fundraising-goals">
    <div class="fundraising-goals__container">
        <div class="fundraising-goals__header">
            <h3 class="fundraising-goals__title"><?php echo get_sub_field('title'); ?></h3>
            <p class="fundraising-goals__subtitle"><?php echo get_sub_field('copy'); ?></p>
        </div>
        <?php if (get_sub_field('cta')) : ?>
            <div class="fundraising-goals__body" id="calculate-fundraising-brochure">
                <table class="fundraising-goals__table">
                    <col style="width:20%">
                    <col style="width:20%">
                    <col style="width:20%">
                    <col style="width:40%">
                    <thead class="fundraising-goals__table-head">
                        <tr>
                            <td></td>
                            <td># of Participants</td>
                            <td># of Sold Kits</td>
                            <td>Total Average Commission</td>
                        </tr>
                    </thead>
                    <body>
                        <tr class="fundraising-goals__table-row">
                            <td></td>
                            <td>1</td>
                            <td>10</td>
                            <td>$60.00</td>
                        </tr>
                        <tr class="fundraising-goals__table-row">
                            <td></td>
                            <td>2</td>
                            <td>10</td>
                            <td>$120.00</td>
                        </tr>
                        <tr class="fundraising-goals__table-row">
                            <td></td>
                            <td>3</td>
                            <td>15</td>
                            <td>$270.00</td>
                        </tr>
                        <tr class="fundraising-goals__table-row">
                            <td></td>
                            <td>5</td>
                            <td>15</td>
                            <td>$450.00</td>
                        </tr>
                        <tr class="fundraising-goals__table-form">
                            <td class="fundraising-goals__data" data-percentage="<?php echo get_sub_field('percentage'); ?>" data-comission="<?php echo get_sub_field('comission'); ?>">Custom Inputs</td>
                            <td><input class="fundraising-goals__table-input" type="text" name="one" id="one" pattern="[0-9]*" data-politespace></td>
                            <td><input class="fundraising-goals__table-input" type="text" name="two" id="two" pattern="[0-9]*" data-politespace></td>
                            <td><input class="fundraising-goals__table-input fundraising-goals__table-input--last" type="text" name="three" id="three" pattern="[0-9]*" data-politespace data-grouplength="3" data-delimiter="," data-reverse value="" readonly></td>
                        </tr>
                    </body>
                </table>
                <div class="fundraising-goals__table--mobile" id="calculate-fundraising-brochure-mobile">
                    <div class="fundraising-goals__data" data-percentage="<?php echo get_sub_field('percentage'); ?>" data-comission="<?php echo get_sub_field('comission'); ?>"></div>
                    <div class="fundraising-goals__row--mobile">
                        <label for="one_mobile"># of Participants</label>
                        <input class="fundraising-goals__table-input" type="text" name="one_mobile" id="one_mobile" pattern="[0-9]*" data-politespace>
                    </div>
                    <div class="fundraising-goals__row--mobile">
                        <label for="two_mobile"># of Sold Kits</label>
                        <input class="fundraising-goals__table-input" type="text" name="two_mobile" id="two_mobile" pattern="[0-9]*" data-politespace>
                    </div>
                    <hr>
                    <div class="fundraising-goals__row--mobile">
                        <label for="three_mobile">Total Average Commission</label>
                        <input class="fundraising-goals__table-input fundraising-goals__table-input--last" type="text" name="three_mobile" id="three_mobile" pattern="[0-9]*" data-politespace data-grouplength="3" data-delimiter="," data-reverse value="" readonly>
                    </div>
                </div>
            </div>
            <div class="fundraising-goals__footer">
                <a class="fundraising-goals__cta" href="javascript:void(0);" onclick="openTableFundraisingGoals(this);"><?php echo get_sub_field('cta')['title']; ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>