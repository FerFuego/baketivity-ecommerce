<div class="ba-form-login" id="ba-form-login">
    <a class="ba-form-login__close" href="#">&times;</a>
    <div class="ba-form-login__form" id="js-register">
        <div class="ba-form-login__row">
            <div class="ba-form-login__wide form-row form-row-wide">
                <label class="ba-form-login__label" for="username"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" class="ba-form-login__input" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                <div id="js-text-validation"></div>
            </div>
            <div class="ba-form-login__wide form-row form-row-wide">
                <label class="ba-form-login__label" for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input class="ba-form-login__input" type="password" name="password" id="password" autocomplete="current-password" />
                <div id="js-pass-validation"></div>
            </div>
            <button type="button" class="ba-form-login__submit" id="js-login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
        </div>
        <div class="ba-form-login__row-2">
            <label class="ba-form-login__label ba-form-login__label--remember">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
                <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
            </label>
            <div class="ba-form-login__forgot">
                <a class="ba-form-login__forgot" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
            </div>
        </div>
        <div id="js-register-messageForm"></div>
        <hr class="ba-form-login__hr">
        <div class="ba-form-login__register">
            <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( wc_get_page_permalink( 'checkout' ) ); ?>" />
            <a href="<?php echo esc_url( home_url() ) . '/my-account'; ?>">
                <?php esc_html_e( 'Create an account', 'woocommerce' ); ?> <img src="/wp-content/themes/baketivity/images/arrow-circle.svg" alt="register">
            </a>
        </div>
    </div>
</div>