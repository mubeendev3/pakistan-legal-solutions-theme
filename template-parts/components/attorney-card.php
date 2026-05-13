<?php
/**
 * Team member card (expects The Loop).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$role = has_excerpt() ? get_the_excerpt() : __( 'Advocate', 'pakistan-legal-solutions' );
?>

<article <?php post_class( 'attorney-card' ); ?>>
    <div class="attorney-card__photo">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                <?php the_post_thumbnail( 'attorney-portrait', [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
            </a>
        <?php endif; ?>
    </div>
    <h3 class="attorney-card__name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    <p class="attorney-card__role"><?php echo esc_html( wp_strip_all_tags( $role ) ); ?></p>
</article>
