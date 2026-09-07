<?php
/**
 * The main template file (fallback)
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">
    <div class="lmw-container">

        <?php if ( have_posts() ) : ?>

            <div class="lmw-posts">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'lmw-post-card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="lmw-post-card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="lmw-post-card__content">
                            <h2 class="lmw-post-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="lmw-post-card__excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&laquo; Previous', 'lmw-theme' ),
                'next_text' => __( 'Next &raquo;', 'lmw-theme' ),
            ) ); ?>

        <?php else : ?>

            <div class="lmw-no-results">
                <h1><?php esc_html_e( 'Nothing Found', 'lmw-theme' ); ?></h1>
                <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'lmw-theme' ); ?></p>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
