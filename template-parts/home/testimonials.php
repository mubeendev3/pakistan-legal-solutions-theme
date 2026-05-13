<?php
/**
 * Homepage — testimonials.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$query = new WP_Query(
    [
        'post_type'      => 'testimonial',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]
);

$static = [
    [
        'quote'  => __( 'Exceptionally clear guidance during a difficult property dispute. We always knew the next step—and why it mattered.', 'pakistan-legal-solutions' ),
        'author' => __( 'Corporate client', 'pakistan-legal-solutions' ),
        'meta'   => __( 'Lahore', 'pakistan-legal-solutions' ),
    ],
    [
        'quote'  => __( 'Professional, responsive, and strategic. They protected our interests without escalating unnecessarily.', 'pakistan-legal-solutions' ),
        'author' => __( 'Family law client', 'pakistan-legal-solutions' ),
        'meta'   => __( 'Karachi', 'pakistan-legal-solutions' ),
    ],
    [
        'quote'  => __( 'Strong written work and calm courtroom presence. I would recommend them for high-stakes litigation.', 'pakistan-legal-solutions' ),
        'author' => __( 'Business owner', 'pakistan-legal-solutions' ),
        'meta'   => __( 'Islamabad', 'pakistan-legal-solutions' ),
    ],
];
?>

<section class="home-testimonials section" aria-labelledby="home-testimonials-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'Client voices', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="home-testimonials-heading"><?php esc_html_e( 'Trusted by clients who expect excellence', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'A snapshot of the experience clients describe after working with our team.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <div class="home-testimonials__grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/components/testimonial-card' );
                endwhile;
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php foreach ( $static as $row ) : ?>
                    <article class="testimonial-card">
                        <blockquote class="testimonial-card__quote"><?php echo esc_html( $row['quote'] ); ?></blockquote>
                        <p class="testimonial-card__author"><?php echo esc_html( $row['author'] ); ?></p>
                        <p class="testimonial-card__meta"><?php echo esc_html( $row['meta'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
