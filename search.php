<?php
/**
 * Search results template
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">
    <div class="lmw-container">

        <header class="lmw-page__header">
            <h1 class="lmw-page__title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__( 'Search Results for: %s', 'lmw-theme' ),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="lmw-posts">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'lmw-post-card' ); ?>>
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
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="lmw-no-results">
                <p><?php esc_html_e( 'Sorry, no results matched your search. Try different keywords.', 'lmw-theme' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
