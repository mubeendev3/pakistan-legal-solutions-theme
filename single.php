<?php
/**
 * Single Blog Post Template
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php pls_page_hero( get_the_title(), get_the_date() ); ?>

        <div class="container">
            <div class="single-post-layout">

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="single-post__thumbnail">
                            <?php the_post_thumbnail( 'card-landscape', [
                                'loading' => 'eager',
                                'alt'     => get_the_title(),
                            ] ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="single-post__content entry-content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="single-post__footer">
                        <div class="single-post__tags">
                            <?php the_tags( '<span class="tag">', '</span><span class="tag">', '</span>' ); ?>
                        </div>
                        <nav class="single-post__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'pakistan-legal-solutions' ); ?>">
                            <?php the_post_navigation( [
                                'prev_text' => '&larr; %title',
                                'next_text' => '%title &rarr;',
                            ] ); ?>
                        </nav>
                    </footer>

                </article>

                <?php // Inline CTA — encourage consultation ?>
                <?php get_template_part( 'template-parts/components/cta-inline' ); ?>

            </div><!-- .single-post-layout -->
        </div><!-- .container -->

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>