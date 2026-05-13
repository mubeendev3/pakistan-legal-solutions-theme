<?php defined( 'ABSPATH' ) || exit; ?>

<section class="hero" aria-labelledby="hero-heading">

    <div class="hero__bg">
        <?php
        // If you set a featured image on the homepage, use it as hero bg
        if ( has_post_thumbnail() ) {
            $bg_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-full' );
        } else {
            $bg_url = PLS_ASSETS . '/images/hero-bg.jpg';
        }
        ?>
        <div class="hero__bg-image" style="background-image: url('<?php echo esc_url( $bg_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Courthouse columns', 'pakistan-legal-solutions' ); ?>"></div>
        <div class="hero__overlay" aria-hidden="true"></div>
    </div>

    <div class="hero__content container">
        <div class="hero__grid">

            <div class="hero__text">

                <p class="hero__eyebrow">
                    <?php esc_html_e( 'Advocates & legal consultants', 'pakistan-legal-solutions' ); ?>
                </p>

                <h1 class="hero__heading" id="hero-heading">
                    <?php esc_html_e( 'Trusted Legal Representation', 'pakistan-legal-solutions' ); ?>
                    <span><?php esc_html_e( 'Across Pakistan', 'pakistan-legal-solutions' ); ?></span>
                </h1>

                <p class="hero__subheading">
                    <?php esc_html_e( 'From family and corporate matters to tax, property, and constitutional questions clear advice and strong representation. Client-first, every time.', 'pakistan-legal-solutions' ); ?>
                </p>

                <div class="hero__actions">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                       class="btn btn--gold btn--lg">
                        <?php esc_html_e( 'Book Free Consultation', 'pakistan-legal-solutions' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>"
                       class="btn btn--outline-white btn--lg">
                        <?php esc_html_e( 'Our Practice Areas', 'pakistan-legal-solutions' ); ?>
                    </a>
                </div>

                <div class="hero__stats" aria-label="<?php esc_attr_e( 'Firm statistics', 'pakistan-legal-solutions' ); ?>">
                    <div class="hero__stat">
                        <span class="hero__stat-number" data-pls-counter data-target="15" data-suffix="+">15+</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Years Experience', 'pakistan-legal-solutions' ); ?></span>
                    </div>
                    <div class="hero__stat">
                        <span class="hero__stat-number" data-pls-counter data-target="500" data-suffix="+">500+</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Cases Won', 'pakistan-legal-solutions' ); ?></span>
                    </div>
                    <div class="hero__stat">
                        <span class="hero__stat-number" data-pls-counter data-target="6" data-suffix="">6</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?></span>
                    </div>
                    <div class="hero__stat">
                        <span class="hero__stat-number" data-pls-counter data-target="100" data-suffix="%">100%</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Client First', 'pakistan-legal-solutions' ); ?></span>
                    </div>
                </div>

            </div><!-- .hero__text -->

            <aside class="hero__consult" aria-label="<?php esc_attr_e( 'Request a consultation', 'pakistan-legal-solutions' ); ?>">
                <div class="hero-consult-card">
                    <div class="hero-consult-card__badge"><?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?></div>
                    <h2 class="hero-consult-card__title"><?php esc_html_e( 'Get Legal Help Today', 'pakistan-legal-solutions' ); ?></h2>
                    <p class="hero-consult-card__lead"><?php esc_html_e( 'Speak with an expert attorney within 24 hours', 'pakistan-legal-solutions' ); ?></p>

                    <form
                        class="hero-consult-card__form"
                        id="hero-consult-form"
                        action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
                        method="post"
                        novalidate>
                        <input type="hidden" name="action" value="pls_contact_form">
                        <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'pls_contact_form' ) ); ?>">
                        <input type="hidden" name="pls_hero_quick" value="1">
                        <input type="hidden" name="email" value="">

                        <div class="form-honeypot" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;">
                            <label for="hero-consult-website"><?php esc_html_e( 'Leave this empty', 'pakistan-legal-solutions' ); ?></label>
                            <input type="text" id="hero-consult-website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="hero-consult-card__form-fields">
                            <input type="text"
                                   id="hero-consult-name"
                                   name="name"
                                   class="hero-consult-card__input"
                                   autocomplete="name"
                                   required
                                   placeholder="<?php esc_attr_e( 'Your Full Name', 'pakistan-legal-solutions' ); ?>">

                            <input type="tel"
                                   id="hero-consult-phone"
                                   name="phone"
                                   class="hero-consult-card__input"
                                   autocomplete="tel"
                                   required
                                   placeholder="<?php esc_attr_e( '03XX-XXXXXXX', 'pakistan-legal-solutions' ); ?>">

                            <select id="hero-consult-practice" name="practice_area" class="hero-consult-card__select" required>
                                <option value="" disabled selected><?php esc_html_e( 'Select Practice Area', 'pakistan-legal-solutions' ); ?></option>
                                <option value="civil-law"><?php esc_html_e( 'Civil Law', 'pakistan-legal-solutions' ); ?></option>
                                <option value="constitutional-law"><?php esc_html_e( 'Constitutional Law', 'pakistan-legal-solutions' ); ?></option>
                                <option value="business-formation"><?php esc_html_e( 'Business Formation', 'pakistan-legal-solutions' ); ?></option>
                                <option value="banking-finance"><?php esc_html_e( 'Banking & Finance', 'pakistan-legal-solutions' ); ?></option>
                                <option value="taxation"><?php esc_html_e( 'Taxation', 'pakistan-legal-solutions' ); ?></option>
                                <option value="cyber-crime"><?php esc_html_e( 'Cyber Crime', 'pakistan-legal-solutions' ); ?></option>
                                <option value="family-law"><?php esc_html_e( 'Family Law', 'pakistan-legal-solutions' ); ?></option>
                                <option value="sports-law"><?php esc_html_e( 'Sports Law', 'pakistan-legal-solutions' ); ?></option>
                                <option value="white-collar-crime"><?php esc_html_e( 'White Collar Crime', 'pakistan-legal-solutions' ); ?></option>
                                <option value="contract-drafting"><?php esc_html_e( 'Contract Drafting', 'pakistan-legal-solutions' ); ?></option>
                                <option value="corporate-law"><?php esc_html_e( 'Corporate Law', 'pakistan-legal-solutions' ); ?></option>
                                <option value="ip-law"><?php esc_html_e( 'IP Law', 'pakistan-legal-solutions' ); ?></option>
                            </select>

                            <textarea id="hero-consult-message"
                                      name="message"
                                      class="hero-consult-card__textarea"
                                      rows="3"
                                      required
                                      placeholder="<?php esc_attr_e( 'Briefly describe your matter...', 'pakistan-legal-solutions' ); ?>"></textarea>

                            <button type="submit" class="hero-consult-card__submit" id="hero-consult-submit">
                                <span class="hero-consult-card__submit-text"><?php esc_html_e( 'Book Free Consultation', 'pakistan-legal-solutions' ); ?> &rarr;</span>
                                <span class="hero-consult-card__submit-loading" aria-hidden="true" hidden><?php esc_html_e( 'Sending...', 'pakistan-legal-solutions' ); ?></span>
                            </button>

                            <p class="hero-consult-card__trust">
                                <span class="hero-consult-card__trust-icon" aria-hidden="true">&#128274;</span>
                                <?php esc_html_e( 'Confidential & No Obligation', 'pakistan-legal-solutions' ); ?>
                            </p>
                        </div>

                        <div class="hero-consult-card__success" id="hero-consult-success" role="status" aria-live="polite" hidden>
                            <?php esc_html_e( 'Thank you! We will call you within 24 hours.', 'pakistan-legal-solutions' ); ?>
                        </div>

                        <p class="hero-consult-card__error" id="hero-consult-error" role="alert" aria-live="assertive" hidden></p>
                    </form>
                </div>
            </aside>

        </div><!-- .hero__grid -->
    </div><!-- .hero__content -->

</section><!-- .hero -->
