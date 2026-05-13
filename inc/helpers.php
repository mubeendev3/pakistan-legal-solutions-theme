<?php
defined( 'ABSPATH' ) || exit;

/**
 * Load a template part with scoped variables (same scope as include — unlike get_template_part alone).
 *
 * Usage: pls_get_part( 'components/practice-area-card', [ 'pa_title' => '…' ] );
 */
function pls_get_part( string $part, array $data = [] ): void {
    $relative = 'template-parts/' . $part . '.php';
    $file      = locate_template( $relative, false, false );
    if ( ! $file || ! is_readable( $file ) ) {
        return;
    }
    if ( $data ) {
        extract( $data, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract
    }
    include $file;
}

/**
 * Get SVG icon from sprite.
 * Usage: pls_icon( 'phone' ) outputs: <svg><use href="...#phone"/></svg>
 */
function pls_icon( string $name, string $class = '' ): string {
    $sprite_url = PLS_ASSETS . '/icons/sprite.svg';
    $class_attr = $class ? ' class="icon icon--' . esc_attr( $class ) . '"' : ' class="icon"';
    return sprintf(
        '<svg%s aria-hidden="true" focusable="false"><use href="%s#%s"/></svg>',
        $class_attr,
        esc_url( $sprite_url ),
        esc_attr( $name )
    );
}

/**
 * Truncate text to a word count with ellipsis.
 */
function pls_excerpt( string $text, int $words = 20 ): string {
    return wp_trim_words( wp_strip_all_tags( $text ), $words, '&hellip;' );
}

/**
 * Get ACF field with fallback.
 * Usage: pls_field( 'attorney_title', $post->ID, 'Partner' )
 */
function pls_field( string $key, int $post_id = 0, string $fallback = '' ): string {
    if ( ! function_exists( 'get_field' ) ) return $fallback;
    $value = get_field( $key, $post_id ?: get_the_ID() );
    return $value ?: $fallback;
}

/**
 * Output page hero section (reused across many pages).
 */
function pls_page_hero( string $title, string $subtitle = '', string $bg_class = '' ): void {
    $bg = $bg_class ? ' ' . sanitize_html_class( $bg_class ) : '';
    ?>
    <section class="page-hero<?php echo esc_attr( $bg ); ?>">
        <div class="container">
            <?php pls_breadcrumb(); ?>
            <h1 class="page-hero__title"><?php echo esc_html( $title ); ?></h1>
            <?php if ( $subtitle ) : ?>
                <p class="page-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

/**
 * Simple breadcrumb navigation.
 */
function pls_breadcrumb(): void {
    if ( is_front_page() ) return;
    ?>
    <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'pakistan-legal-solutions' ); ?>">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php esc_html_e( 'Home', 'pakistan-legal-solutions' ); ?>
                </a>
            </li>
            <?php if ( is_singular( 'practice_area' ) ) : ?>
                <li class="breadcrumb__item">
                    <a href="<?php echo esc_url( pls_practice_areas_index_url() ); ?>">
                        <?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?>
                    </a>
                </li>
            <?php endif; ?>
            <li class="breadcrumb__item breadcrumb__item--current" aria-current="page">
                <?php the_title(); ?>
            </li>
        </ol>
    </nav>
    <?php
}