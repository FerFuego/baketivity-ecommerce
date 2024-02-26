<div id="voteModal" class="bake-away-vote-modal recipeVoteModal">
    <div class="bake-away-vote-modal__container">
        <div class="bake-away-vote-modal__left"></div>
        <div class="bake-away-vote-modal__right">
            <h3 class="bake-away-vote-modal__title">Submit your vote</h3>
            <p class="bake-away-vote-modal__name">Avigail Berger, 11</p>
            <p class="bake-away-vote-modal__locality">Brooklyn, NY</p>
            <?php if ($gform_id = get_sub_field('gravity_vote_form_id')) : ?>
                <?php echo do_shortcode('[gravityform id="' . $gform_id . '" title="false" description="false" ajax="true"]'); ?>
            <?php endif ?>
        </div>
    </div>
</div><!-- End Vote Modal -->