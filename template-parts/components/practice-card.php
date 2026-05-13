<?php
/**
 * Practice area card (expects The Loop).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'pa-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <a class="pa-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
        </a>
    <?php else : ?>
        <div class="pa-card__media" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="pa-card__body">
        <h3 class="pa-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="pa-card__excerpt"><?php
            $excerpt = get_the_excerpt();
            if ( ! $excerpt ) {
                $excerpt = wp_trim_words( wp_strip_all_tags( (string) get_post_field( 'post_content', get_the_ID() ) ), 26, '…' );
            }
            echo esc_html( $excerpt );
        ?></p>
        <a class="pa-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn more', 'pakistan-legal-solutions' ); ?></a>
    </div>
</article>
