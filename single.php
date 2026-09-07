<?php
/**
 * The template for displaying single posts
 *
 * @package LMW_Theme
 */

get_header();
?>

<main id="main-content" class="lmw-main">
    <div class="lmw-container">

        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'lmw-single' ); ?>>
                <header class="lmw-single__header">
                    <h1 class="lmw-single__title"><?php the_title(); ?></h1>
                    <div class="lmw-single__meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="lmw-single__featured-image">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="lmw-single__content entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>

        <?php endwhile; ?>

    </div>
</main>

<?php
get_footer();
