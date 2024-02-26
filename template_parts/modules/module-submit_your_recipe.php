<div class="submit_your_recipe" style="background-color:<?= get_sub_field('bg_color'); ?>" id="submit-recipe">
    <div class="submit_your_recipe__container">
        <div class="submit_your_recipe__header">
            <h2 class="submit_your_recipe__title"><?= get_sub_field('title'); ?></h2>
        </div>
        <div class="submit_your_recipe__body">
            <div class="submit_your_recipe__left">
                <?php if ($icon = get_sub_field('image')) : ?>
                    <?php echo wp_get_attachment_image($icon['id'], 'full', false, ['loading' => 'false', 'class' => '']); ?>
                <?php endif ?>
            </div>
            <div class="submit_your_recipe__right">
                <?php if ($gform_id = get_sub_field('gravity_form_id')) : ?>
                    <?php echo do_shortcode('[gravityform id="' . $gform_id . '" title="false" description="false" ajax="true"]'); ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script>
    /* Call to action inputs */
    window.addEventListener('DOMContentLoaded', function() {
        let inputs_video = document.querySelectorAll('.ginput_container_fileupload');

        inputs_video.forEach(input_video => {
            input_video.querySelector('input').addEventListener('click', () => {
                input_video.querySelector('input').click();
            });
        });
    });

    /* Image preview */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                jQuery('.custom_image_input .ginput_container')
                    .css('background-image', 'url(' + e.target.result + ')')
                    .css('background-size', 'contain')
                    .css('background-repeat', 'no-repeat')
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    /* Listener for image */
    jQuery(document).on("change", ".custom_image_input input[type='file']", function(evt) {
        readURL(this);
    });

    /* Listener for video preview */
    jQuery(document).on("change", ".custom_video_input input[type='file']", function(evt) {
        jQuery('.custom_video_preview').removeClass('d-none');
        var $source = jQuery('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });
</script>