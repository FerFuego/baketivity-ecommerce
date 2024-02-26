<?php $link = get_sub_field('contact-link'); ?>
  <div class="faq-contact">
      <p class="faq-contact-copy filson-pro-medium">
        <?= get_sub_field('contact-text'); ?>
        <a class="faq-contact-link" href="<?= esc_url( $link['url'] ); ?>"><?= esc_html( $link['title'] ); ?></a>
      </p>
  </div>