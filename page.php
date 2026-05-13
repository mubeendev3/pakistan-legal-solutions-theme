<?php
/**
 * Generic Page Template
 * Used for any page without a specific custom template.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php pls_page_hero( get_the_title() ); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>
            <div class="container">
                <div class="page-content__inner entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>