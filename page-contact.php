<?php
/**
 * Template Name: Contact Us
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">

    <section class="lmw-page-banner">
        <div class="lmw-container">
            <h1 class="lmw-page-banner__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <section class="lmw-section">
        <div class="lmw-container">
            <div class="lmw-contact-grid">

                <div class="lmw-contact__info">
                    <span class="lmw-section__label"><?php esc_html_e( 'Get in Touch', 'lmw-theme' ); ?></span>
                    <h2 class="lmw-section__title" style="text-align:left;"><?php esc_html_e( 'We\'d love to hear from you', 'lmw-theme' ); ?></h2>
                    <p style="color:var(--lmw-mid-grey);margin:1rem 0 2rem;">
                        <?php esc_html_e( 'Have a question about an order, a product, or just want to say hello? Reach out and we\'ll get back to you within 24 hours.', 'lmw-theme' ); ?>
                    </p>

                    <div class="lmw-contact__details">
                        <?php
                        $phone   = get_theme_mod( 'lmw_store_phone', '' );
                        $email   = get_theme_mod( 'lmw_store_email', '' );
                        $address = get_theme_mod( 'lmw_store_address', '' );
                        ?>

                        <?php if ( $phone ) : ?>
                            <div class="lmw-contact__detail">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <span><?php echo esc_html( $phone ); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ( $email ) : ?>
                            <div class="lmw-contact__detail">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ( $address ) : ?>
                            <div class="lmw-contact__detail">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span><?php echo nl2br( esc_html( $address ) ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php lmw_theme_social_links(); ?>
                </div>

                <div class="lmw-contact__form">
                    <div class="lmw-contact__form-inner">
                        <?php
                        // Render page content (for Contact Form 7 or similar)
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                        ?>

                        <?php if ( ! has_blocks() && ! has_shortcode( get_the_content(), 'contact-form-7' ) ) : ?>
                            <form class="lmw-contact-form" method="post">
                                <div class="lmw-form-row">
                                    <label for="lmw-name"><?php esc_html_e( 'Full Name', 'lmw-theme' ); ?></label>
                                    <input type="text" id="lmw-name" name="name" required>
                                </div>
                                <div class="lmw-form-row">
                                    <label for="lmw-email"><?php esc_html_e( 'Email Address', 'lmw-theme' ); ?></label>
                                    <input type="email" id="lmw-email" name="email" required>
                                </div>
                                <div class="lmw-form-row">
                                    <label for="lmw-subject"><?php esc_html_e( 'Subject', 'lmw-theme' ); ?></label>
                                    <input type="text" id="lmw-subject" name="subject">
                                </div>
                                <div class="lmw-form-row">
                                    <label for="lmw-message"><?php esc_html_e( 'Message', 'lmw-theme' ); ?></label>
                                    <textarea id="lmw-message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="lmw-btn lmw-btn--primary" style="width:100%;">
                                    <?php esc_html_e( 'Send Message', 'lmw-theme' ); ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
