<?php
/**
 * Login & Registration Form Template
 *
 * Designed exclusively for LMW Fashion with luxury brand styling,
 * tabbed authentication experience, member benefits, and responsive design.
 *
 * @package LMW_Theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$registration_enabled = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );

// Determine if user requested register tab via URL or if registration errors occurred
$active_tab = 'login';
if ( isset( $_GET['action'] ) && 'register' === $_GET['action'] ) {
    $active_tab = 'register';
} elseif ( isset( $_POST['register'] ) ) {
    $active_tab = 'register';
}
?>

<div class="lmw-auth-wrapper">

    <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

    <div class="lmw-auth-container <?php echo $registration_enabled ? 'has-registration' : 'single-form'; ?>" id="customer_login">

        <!-- Left Column: Authentication Forms Card -->
        <div class="lmw-auth-card">
            
            <div class="lmw-auth-header">
                <span class="lmw-auth-tag"><?php esc_html_e( 'LMW Account Access', 'lmw-theme' ); ?></span>
                <h1 class="lmw-auth-title" id="lmw-auth-dynamic-title">
                    <?php echo ( 'register' === $active_tab && $registration_enabled ) ? esc_html__( 'Create Your Account', 'lmw-theme' ) : esc_html__( 'Sign In to Your Account', 'lmw-theme' ); ?>
                </h1>
                <p class="lmw-auth-subtitle" id="lmw-auth-dynamic-subtitle">
                    <?php echo ( 'register' === $active_tab && $registration_enabled ) ? esc_html__( 'Join the LMW Sartorial Club for exclusive access & member privileges.', 'lmw-theme' ) : esc_html__( 'Welcome back. Manage your bespoke orders and saved wardrobe.', 'lmw-theme' ); ?>
                </p>
            </div>

            <?php if ( $registration_enabled ) : ?>
                <!-- Interactive Tabs Switcher -->
                <div class="lmw-auth-tabs" role="tablist">
                    <button type="button" 
                            class="lmw-auth-tab <?php echo ( 'login' === $active_tab ) ? 'is-active' : ''; ?>" 
                            id="tab-btn-login"
                            role="tab" 
                            aria-selected="<?php echo ( 'login' === $active_tab ) ? 'true' : 'false'; ?>"
                            aria-controls="auth-pane-login">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        <span><?php esc_html_e( 'Sign In', 'lmw-theme' ); ?></span>
                    </button>
                    <button type="button" 
                            class="lmw-auth-tab <?php echo ( 'register' === $active_tab ) ? 'is-active' : ''; ?>" 
                            id="tab-btn-register"
                            role="tab" 
                            aria-selected="<?php echo ( 'register' === $active_tab ) ? 'true' : 'false'; ?>"
                            aria-controls="auth-pane-register">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                        <span><?php esc_html_e( 'Create Account', 'lmw-theme' ); ?></span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- LOGIN FORM PANE -->
            <div class="lmw-auth-pane <?php echo ( 'login' === $active_tab ) ? 'is-active' : ''; ?>" 
                 id="auth-pane-login" 
                 role="tabpanel" 
                 aria-labelledby="tab-btn-login">
                
                <form class="woocommerce-form woocommerce-form-login login lmw-form-styled" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="lmw-form-group">
                        <label for="username" class="lmw-form-label">
                            <?php esc_html_e( 'Username or Email Address', 'lmw-theme' ); ?>
                            <span class="required">*</span>
                        </label>
                        <div class="lmw-input-icon-wrapper">
                            <span class="lmw-field-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" 
                                   class="woocommerce-Input woocommerce-Input--text input-text lmw-form-input" 
                                   name="username" 
                                   id="username" 
                                   autocomplete="username" 
                                   placeholder="<?php esc_attr_e( 'e.g. name@example.com', 'lmw-theme' ); ?>"
                                   value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" 
                                   required />
                        </div>
                    </div>

                    <div class="lmw-form-group">
                        <div class="lmw-form-label-row">
                            <label for="password" class="lmw-form-label">
                                <?php esc_html_e( 'Password', 'lmw-theme' ); ?>
                                <span class="required">*</span>
                            </label>
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lmw-lost-password-link">
                                <?php esc_html_e( 'Forgot password?', 'lmw-theme' ); ?>
                            </a>
                        </div>
                        <div class="lmw-input-icon-wrapper">
                            <span class="lmw-field-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" 
                                   class="woocommerce-Input woocommerce-Input--text input-text lmw-form-input js-password-field" 
                                   name="password" 
                                   id="password" 
                                   autocomplete="current-password" 
                                   placeholder="<?php esc_attr_e( 'Enter your password', 'lmw-theme' ); ?>"
                                   required />
                            <button type="button" class="lmw-toggle-pwd-btn js-toggle-pwd" aria-label="<?php esc_attr_e( 'Toggle password visibility', 'lmw-theme' ); ?>">
                                <svg class="lmw-eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="lmw-eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="lmw-form-utility-row">
                        <label class="lmw-custom-checkbox">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span class="lmw-checkbox-indicator"></span>
                            <span class="lmw-checkbox-text"><?php esc_html_e( 'Remember me on this device', 'lmw-theme' ); ?></span>
                        </label>
                    </div>

                    <div class="lmw-form-action-group">
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <button type="submit" 
                                class="woocommerce-button button lmw-auth-submit-btn" 
                                name="login" 
                                value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                            <span><?php esc_html_e( 'Sign In to Your Account', 'lmw-theme' ); ?></span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                    </div>

                    <?php if ( $registration_enabled ) : ?>
                        <div class="lmw-auth-switch-prompt">
                            <?php esc_html_e( "Don't have an account?", 'lmw-theme' ); ?>
                            <button type="button" class="lmw-link-btn js-switch-tab" data-target="register">
                                <?php esc_html_e( 'Create an Account', 'lmw-theme' ); ?>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>

            </div>

            <?php if ( $registration_enabled ) : ?>
                <!-- REGISTRATION FORM PANE -->
                <div class="lmw-auth-pane <?php echo ( 'register' === $active_tab ) ? 'is-active' : ''; ?>" 
                     id="auth-pane-register" 
                     role="tabpanel" 
                     aria-labelledby="tab-btn-register">
                    
                    <form method="post" class="woocommerce-form woocommerce-form-register register lmw-form-styled" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                        <?php do_action( 'woocommerce_register_form_start' ); ?>

                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                            <div class="lmw-form-group">
                                <label for="reg_username" class="lmw-form-label">
                                    <?php esc_html_e( 'Username', 'lmw-theme' ); ?>
                                    <span class="required">*</span>
                                </label>
                                <div class="lmw-input-icon-wrapper">
                                    <span class="lmw-field-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </span>
                                    <input type="text" 
                                           class="woocommerce-Input woocommerce-Input--text input-text lmw-form-input" 
                                           name="username" 
                                           id="reg_username" 
                                           autocomplete="username" 
                                           placeholder="<?php esc_attr_e( 'Choose a unique username', 'lmw-theme' ); ?>"
                                           value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" 
                                           required />
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="lmw-form-group">
                            <label for="reg_email" class="lmw-form-label">
                                <?php esc_html_e( 'Email Address', 'lmw-theme' ); ?>
                                <span class="required">*</span>
                            </label>
                            <div class="lmw-input-icon-wrapper">
                                <span class="lmw-field-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <input type="email" 
                                       class="woocommerce-Input woocommerce-Input--text input-text lmw-form-input" 
                                       name="email" 
                                       id="reg_email" 
                                       autocomplete="email" 
                                       placeholder="<?php esc_attr_e( 'Enter your email address', 'lmw-theme' ); ?>"
                                       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" 
                                       required />
                            </div>
                        </div>

                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                            <div class="lmw-form-group">
                                <label for="reg_password" class="lmw-form-label">
                                    <?php esc_html_e( 'Create Password', 'lmw-theme' ); ?>
                                    <span class="required">*</span>
                                </label>
                                <div class="lmw-input-icon-wrapper">
                                    <span class="lmw-field-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </span>
                                    <input type="password" 
                                           class="woocommerce-Input woocommerce-Input--text input-text lmw-form-input js-password-field" 
                                           name="password" 
                                           id="reg_password" 
                                           autocomplete="new-password" 
                                           placeholder="<?php esc_attr_e( 'Min 8 characters with letters & numbers', 'lmw-theme' ); ?>"
                                           required />
                                    <button type="button" class="lmw-toggle-pwd-btn js-toggle-pwd" aria-label="<?php esc_attr_e( 'Toggle password visibility', 'lmw-theme' ); ?>">
                                        <svg class="lmw-eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <svg class="lmw-eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                                    </button>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="lmw-auth-info-note">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                <span><?php esc_html_e( 'A secure one-click link to set your password will be sent to your email address.', 'lmw-theme' ); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php do_action( 'woocommerce_register_form' ); ?>

                        <div class="lmw-auth-disclaimer">
                            <?php esc_html_e( 'By creating an account, you agree to our', 'lmw-theme' ); ?>
                            <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'lmw-theme' ); ?></a>
                            <?php esc_html_e( 'and', 'lmw-theme' ); ?>
                            <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'lmw-theme' ); ?></a>.
                        </div>

                        <div class="lmw-form-action-group">
                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                            <button type="submit" 
                                    class="woocommerce-Button woocommerce-button button lmw-auth-submit-btn lmw-auth-submit-btn--register" 
                                    name="register" 
                                    value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                                <span><?php esc_html_e( 'Create Your Account', 'lmw-theme' ); ?></span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>

                        <div class="lmw-auth-switch-prompt">
                            <?php esc_html_e( 'Already have an account?', 'lmw-theme' ); ?>
                            <button type="button" class="lmw-link-btn js-switch-tab" data-target="login">
                                <?php esc_html_e( 'Sign In Here', 'lmw-theme' ); ?>
                            </button>
                        </div>

                        <?php do_action( 'woocommerce_register_form_end' ); ?>

                    </form>

                </div>
            <?php endif; ?>

        </div>

        <!-- Right Column: Luxury Member Benefits Showcase -->
        <div class="lmw-auth-perks-card">
            
            <div class="lmw-auth-perks-header">
                <span class="lmw-perks-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <?php esc_html_e( 'The Sartorial Club', 'lmw-theme' ); ?>
                </span>
                <h2 class="lmw-perks-title"><?php esc_html_e( 'Elevate Your Wardrobe Experience', 'lmw-theme' ); ?></h2>
                <p class="lmw-perks-desc"><?php esc_html_e( 'Become an LMW member to unlock bespoke services, effortless re-orders, and curated privileges.', 'lmw-theme' ); ?></p>
            </div>

            <div class="lmw-perks-list">
                <div class="lmw-perk-item">
                    <div class="lmw-perk-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div class="lmw-perk-info">
                        <strong><?php esc_html_e( 'Complimentary Express Shipping', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Dispatched within 24 hours with real-time tracking across all locations in India.', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-perk-item">
                    <div class="lmw-perk-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                    </div>
                    <div class="lmw-perk-info">
                        <strong><?php esc_html_e( 'Hassle-Free 7-Day Exchange', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Complimentary doorstep size exchange service with zero questions asked.', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-perk-item">
                    <div class="lmw-perk-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                    <div class="lmw-perk-info">
                        <strong><?php esc_html_e( 'Persistent Wardrobe & Wishlist', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Save your bespoke measurements, favorite fits, and reorder in just 1 click.', 'lmw-theme' ); ?></p>
                    </div>
                </div>

                <div class="lmw-perk-item">
                    <div class="lmw-perk-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div class="lmw-perk-info">
                        <strong><?php esc_html_e( 'Early Access to New Drops', 'lmw-theme' ); ?></strong>
                        <p><?php esc_html_e( 'Private previews of 100% Egyptian Giza cotton seasonal collections.', 'lmw-theme' ); ?></p>
                    </div>
                </div>
            </div>

            <div class="lmw-perks-footer">
                <div class="lmw-perks-stars">
                    <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                        <svg class="lmw-perk-star" width="16" height="16" viewBox="0 0 20 20" fill="#37A8F1"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <?php endfor; ?>
                </div>
                <span class="lmw-perks-social-proof">
                    <?php esc_html_e( 'Rated 4.9/5 by over 15,000 discerning gentlemen across India', 'lmw-theme' ); ?>
                </span>
            </div>

        </div>

    </div>

    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>

</div>
