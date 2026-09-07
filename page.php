<?php
/**
 * The template for displaying pages
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">
    <div class="lmw-container">

        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'lmw-page' ); ?>>
                <header class="lmw-page__header">
                    <h1 class="lmw-page__title"><?php the_title(); ?></h1>
                </header>
                <div class="lmw-page__content entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>

    </div>
</main>

<?php
get_footer();
