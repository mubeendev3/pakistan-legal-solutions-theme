<?php
/**
 * Blog Archive Template
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero( __( 'Legal Insights & News', 'pakistan-legal-solutions' ), __( 'Articles from our attorneys', 'pakistan-legal-solutions' ) ); ?>

    <div class="container">
        <div class="archive-layout">

            <?php if ( have_posts() ) : ?>

                <div class="post-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-card__image" tabindex="-1" aria-hidden="true">
                                    <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-card__body">
                                <p class="post-card__date"><?php echo get_the_date(); ?></p>
                                <h2 class="post-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="post-card__link">
                                    <?php esc_html_e( 'Read More', 'pakistan-legal-solutions' ); ?> &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div><!-- .post-grid -->

                <?php the_posts_pagination( [
                    'mid_size'  => 2,
                    'prev_text' => '&larr; ' . __( 'Previous', 'pakistan-legal-solutions' ),
                    'next_text' => __( 'Next', 'pakistan-legal-solutions' ) . ' &rarr;',
                ] ); ?>

            <?php else : ?>
                <p><?php esc_html_e( 'No posts found.', 'pakistan-legal-solutions' ); ?></p>
            <?php endif; ?>

        </div><!-- .archive-layout -->
    </div><!-- .container -->

</main>

<?php get_footer(); ?>