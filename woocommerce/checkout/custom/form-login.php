<div class="nm-login-form <?php echo (is_user_logged_in()) ? 'complete' : ''; ?>">

    <?php if (is_user_logged_in()) : ?>

        <!-- User Logged -->
        <div class="nm-login-form__inner">
            <h3 class="nm-login-form__title"><?php echo _e('1. Account', 'baketivity'); ?></h3>
            <div class="nm-login-form__content">
                <div class="nm-login-form__user-data">
                    <div class="nm-login-form__user-profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                    </div>
                    <?php esc_html_e('Hello', 'woocommerce'); ?> <?php echo wp_get_current_user()->user_firstname; ?>!
                </div>
                <p><?php esc_html_e('Your email', 'woocommerce'); ?> <?php echo wp_get_current_user()->user_email; ?></p>
                <a href="<?php echo wp_logout_url('/my-account'); ?>">logout</a>
            </div>
        </div>
        <!-- End User Logged -->

    <?php else : ?>

        <!-- Header CTA-->
        <div class="nm-login-form__cta">
            <h3 class="nm-login-form__title"><?php echo _e('1. Account', 'baketivity'); ?></h3>
        </div>
        <!-- End Header CTA-->

        <!-- Form login -->
        <div class="woocommerce-form woocommerce-form-login login animate__animated" id="js-login-form">

            <div class="woocommerce-form-login__title">Sign in</div>

            <div class="woocommerce-form-login__row">
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-login__label" for="username"><?php esc_html_e('Email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-form-login__input woocommerce-form-login__input--text" name="username" id="username" autocomplete="email" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                    <div id="js-text-validation"></div>
                </div>
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-login__label" for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-form-login__input woocommerce-form-login__input--pass" type="password" name="password" id="password" autocomplete="password" />
                    <div id="js-pass-validation"></div>
                </div>
            </div>

            <div class="woocommerce-form-login__row-2">
                <label class="woocommerce-form__label">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                </label>
                <div class="nm-login-form-forgot-password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot password?', 'woocommerce'); ?></a>
                </div>
            </div>

            <button type="button" class="woocommerce-form-login__input--submit" id="js-login" value="<?php esc_attr_e('Sign in', 'woocommerce'); ?>"><?php esc_html_e('Sign in', 'woocommerce'); ?></button>

            <div id="js-login-messageForm"></div>

            <div class="woocommerce-form-login__new-customer-change">

                <div class="woocommerce-form-login__new-customer-row">
                    <div class="woocommerce-form-login__new-customer">
                        <input type="hidden" name="redirect" value="<?php echo esc_url(wc_get_page_permalink('checkout')); ?>" />
                        <?php echo esc_html__('New customer? Get ready to bake the world a better place', 'baketivity'); ?>
                    </div>
                    <p class="woocommerce-form-login__join">
                        <?php echo esc_html__('Join Baketivity and get 10%off in your first purchase', 'baketivity'); ?>
                    </p>
                </div>

                <a class="woocommerce-form-login__cta-change" href="javascript:void(0);">
                    <span><?php esc_html_e('Sign up', 'woocommerce'); ?></span>
                </a>
            </div>

            <hr>

            <div class="woocommerce-form-login__new-customer-change woocommerce-form-login__new-customer-change--guest">

                <div class="woocommerce-form-login__new-customer-row">
                    <div class="woocommerce-form-login__new-customer">
                        <?php echo esc_html__('Don’t want to sign up?', 'baketivity'); ?>
                    </div>
                </div>

                <a class="woocommerce-form-login__cta-change" href="javascript:void(0);" onclick="Checkout.prototype.continueGuest()">
                    <span><?php esc_html_e('Guest checkout', 'woocommerce'); ?></span>
                </a>
            </div>

        </div>


        <!-- Form Register -->
        <div class="woocommerce-form woocommerce-form-register register d-none animate__animated" id="js-register" <?php do_action('woocommerce_register_form_tag'); ?>>

            <div class="woocommerce-form-register__title">Sign up</div>

            <div class="woocommerce-form-register__row">
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-register__label" for="username"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-form-register__input woocommerce-form-register__input--text" type="text" name="firstname" id="firstname" autocomplete="firstname" />
                    <div id="js-text-validation"></div>
                </div>
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-register__label" for="password"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-form-register__input woocommerce-form-register__input--text" type="text" name="lastname" id="lastname" autocomplete="lastname" />
                    <div id="js-text-validation"></div>
                </div>
            </div>

            <div class="woocommerce-form-register__row">
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-register__label" for="email"><?php esc_html_e('Email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-form-register__input woocommerce-form-register__input--text" type="email" name="email" id="email" autocomplete="email" />
                    <div id="js-text-validation"></div>
                </div>
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label class="woocommerce-form-register__label" for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input class="woocommerce-form-register__input woocommerce-form-register__input--pass" type="password" name="password" id="reg_password" autocomplete="password" />
                    <div id="js-pass-validation"></div>
                </div>
            </div>

            <button type="button" class="woocommerce-form-register__input--submit" id="js-register-cta" value="<?php esc_attr_e('Create an account', 'woocommerce'); ?>"><?php esc_html_e('Create an account', 'woocommerce'); ?></button>

            <div id="js-register-messageForm"></div>

            <div class="woocommerce-form-login__new-customer-change woocommerce-form-login__new-customer-change--guest">

                <div class="woocommerce-form-login__new-customer-row">
                    <div class="woocommerce-form-login__new-customer">
                        <input type="hidden" name="redirect" value="<?php echo esc_url(wc_get_page_permalink('checkout')); ?>" />
                        <?php echo esc_html__('Already have an account?', 'baketivity'); ?>
                    </div>
                </div>

                <a class="woocommerce-form-login__cta-change woocommerce-form-register__cta-change-2" href="javascript:void(0);">
                    <span><?= esc_html__('Sign in', 'woocommerce'); ?></span>
                </a>
            </div>

            <hr>

            <div class="woocommerce-form-login__new-customer-change woocommerce-form-login__new-customer-change--guest">

                <div class="woocommerce-form-login__new-customer-row">
                    <div class="woocommerce-form-login__new-customer">
                        <?php echo esc_html__('Don’t want to sign up?', 'baketivity'); ?>
                    </div>
                </div>

                <a class="woocommerce-form-login__cta-change" href="javascript:void(0);" onclick="Checkout.prototype.continueGuest()">
                    <span><?php esc_html_e('Guest checkout', 'woocommerce'); ?></span>
                </a>
            </div>

            <div class="nm-login-form-register">
                <input type="hidden" name="redirect" value="<?php echo esc_url(wc_get_page_permalink('checkout')); ?>" />
            </div>

        </div>

    <?php endif; ?>
</div>