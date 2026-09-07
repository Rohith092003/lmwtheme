<?php
/**
 * Template Part: Customer Testimonials
 *
 * Static testimonials section. Can be made dynamic via customizer or custom post type later.
 *
 * @package LMW_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$testimonials = array(
    array(
        'name'   => 'Rahul S.',
        'city'   => 'Mumbai',
        'text'   => 'The fabric quality is amazing. I ordered 3 shirts and each one fits perfectly. Will definitely order more.',
        'rating' => 5,
    ),
    array(
        'name'   => 'Priya M.',
        'city'   => 'Bangalore',
        'text'   => 'Bought a formal shirt for my husband. He loves the fit and the subtle detailing. Great value for the price.',
        'rating' => 5,
    ),
    array(
        'name'   => 'Amit K.',
        'city'   => 'Delhi',
        'text'   => 'Fast delivery and the packaging was excellent. The linen shirt is now my go-to for weekends.',
        'rating' => 4,
    ),
);
?>

<section class="lmw-section lmw-testimonials" id="testimonials">
    <div class="lmw-container">
        <div class="lmw-section__header">
            <span class="lmw-section__label"><?php esc_html_e( 'Hear From Our Customers', 'lmw-theme' ); ?></span>
            <h2 class="lmw-section__title"><?php esc_html_e( 'What They Say', 'lmw-theme' ); ?></h2>
        </div>

        <div class="lmw-testimonials__grid">
            <?php foreach ( $testimonials as $t ) : ?>
                <div class="lmw-testimonials__card">
                    <div class="lmw-testimonials__stars">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="<?php echo $i <= $t['rating'] ? '#F39C12' : '#E9ECEF'; ?>" stroke="none">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="lmw-testimonials__text">&ldquo;<?php echo esc_html( $t['text'] ); ?>&rdquo;</p>
                    <div class="lmw-testimonials__author">
                        <span class="lmw-testimonials__name"><?php echo esc_html( $t['name'] ); ?></span>
                        <span class="lmw-testimonials__city"><?php echo esc_html( $t['city'] ); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
