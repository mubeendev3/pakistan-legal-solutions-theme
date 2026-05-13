<?php
/**
 * Canonical list of practice areas (slugs align with CPT `practice_area` posts).
 *
 * @package PakistanLegalSolutions
 */

defined( 'ABSPATH' ) || exit;

require_once PLS_INC . '/practice-area-icons.php';

/**
 * URL for the Practice Areas index (prefers a published Page with slug `practice-areas`).
 */
function pls_practice_areas_index_url(): string {
    $page = get_page_by_path( 'practice-areas', OBJECT, 'page' );
    if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
        return get_permalink( $page );
    }
    return trailingslashit( home_url( 'practice-areas' ) );
}

/**
 * Permalink for a single practice area CPT, or a pretty URL until the post exists.
 */
function pls_practice_area_permalink( string $slug ): string {
    static $map = null;
    if ( null === $map ) {
        $map = [];
        $ids = get_posts(
            [
                'post_type'      => 'practice_area',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ]
        );
        foreach ( $ids as $id ) {
            $name = get_post_field( 'post_name', $id );
            if ( $name ) {
                $map[ $name ] = get_permalink( (int) $id );
            }
        }
    }
    if ( isset( $map[ $slug ] ) ) {
        return $map[ $slug ];
    }
    return trailingslashit( home_url( 'practice-areas/' . $slug ) );
}

/**
 * Ordered catalog: slug, icon key, title, two short lines (Pakistan / international context).
 *
 * @return array<int, array{slug:string, icon:string, title:string, lines:array{0:string,1:string}}>
 */
function pls_get_practice_areas_catalog(): array {
    return [
        [
            'slug'  => 'civil-law',
            'icon'  => 'civil-law',
            'title' => __( 'Civil Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Suits, specific performance, and damages under the Contract Act 1872 and the Code of Civil Procedure, 1908.', 'pakistan-legal-solutions' ),
                __( 'We align courtroom strategy with arbitration and cross-border enforcement where your counterparty or assets are abroad.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'constitutional-law',
            'icon'  => 'constitutional-law',
            'title' => __( 'Constitutional Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Fundamental rights, judicial review, and public-law remedies before superior courts under the Constitution of Pakistan.', 'pakistan-legal-solutions' ),
                __( 'Advice on legislative competence, service matters, and high-stakes questions touching federal–provincial relations.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'business-formation',
            'icon'  => 'business-formation',
            'title' => __( 'Business Formation', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'SECP incorporation, sole proprietorships, partnerships (including LLPs), and branch or liaison structures for foreign investors.', 'pakistan-legal-solutions' ),
                __( 'Cap tables, founder agreements, and governance that stay credible with banks, regulators, and future joint-venture partners.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'banking-finance',
            'icon'  => 'banking-finance',
            'title' => __( 'Banking & Finance', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Facility agreements, security perfection, and recovery forums—including banking courts and restructuring conversations.', 'pakistan-legal-solutions' ),
                __( 'Support on syndicated finance, Islamic banking structures, and documentation that satisfies SBP expectations and offshore lenders.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'taxation',
            'icon'  => 'taxation',
            'title' => __( 'Taxation', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Income tax, sales tax, and federal excise before the FBR, appellate tribunals, and high courts on substantial questions of law.', 'pakistan-legal-solutions' ),
                __( 'Cross-border withholding, treaty positions, and transfer-pricing documentation for groups with regional or global footprints.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'cyber-crime',
            'icon'  => 'cyber-crime',
            'title' => __( 'Cyber Crime', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Offences and investigations under the Prevention of Electronic Crimes Act, 2016, including data breaches and online fraud.', 'pakistan-legal-solutions' ),
                __( 'Incident response, preservation of digital evidence, and coordination with platforms and agencies across jurisdictions.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'family-law',
            'icon'  => 'family-law',
            'title' => __( 'Family Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Khula, dissolution, custody, maintenance, and succession matters under the Muslim Family Laws Ordinance and related statutes.', 'pakistan-legal-solutions' ),
                __( 'Sensitive negotiation first—measured litigation when needed—including Hague and foreign-element issues where they arise.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'sports-law',
            'icon'  => 'sports-law',
            'title' => __( 'Sports Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Player and coach contracts, federation rules, image rights, and disciplinary proceedings before domestic sports tribunals.', 'pakistan-legal-solutions' ),
                __( 'Sponsorship, broadcasting, and agency deals with wording that holds up against FIFA, ICC, or league regulations abroad.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'white-collar-crime',
            'icon'  => 'white-collar-crime',
            'title' => __( 'White Collar Crime', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'NAB, FIA, and anti-corruption investigations—defence and compliance steps that protect individuals and corporate reputations.', 'pakistan-legal-solutions' ),
                __( 'Parallel exposure to AML/CFT inquiries and cross-border mutual legal assistance requires disciplined, early legal strategy.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'contract-drafting',
            'icon'  => 'contract-drafting',
            'title' => __( 'Contract Drafting', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Supply, distribution, services, NDAs, and joint ventures drafted for enforceability in Pakistani courts and arbitration.', 'pakistan-legal-solutions' ),
                __( 'English and bilingual clauses, governing law choices, and dispute-resolution ladders that match how you actually do business.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'corporate-law',
            'icon'  => 'corporate-law',
            'title' => __( 'Corporate Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Board procedures, shareholder rights, dividends, and SECP filings for public and closely held companies.', 'pakistan-legal-solutions' ),
                __( 'M&A, joint ventures, and corporate reorganization with due diligence tuned to sector regulators and international counterparties.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'ip-law',
            'icon'  => 'ip-law',
            'title' => __( 'IP Law (Intellectual Property)', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Trademarks, copyrights, and designs before IPO Pakistan; licensing and franchising for domestic and export brands.', 'pakistan-legal-solutions' ),
                __( 'Enforcement against infringement online and offline, including border measures and coordination with foreign IP counsel.', 'pakistan-legal-solutions' ),
            ],
        ],
    ];
}

/**
 * Icon key for inline SVG (matches keys in pls_the_pa_icon()).
 */
function pls_practice_area_icon_key_for_slug( string $slug ): string {
    foreach ( pls_get_practice_areas_catalog() as $row ) {
        if ( $row['slug'] === $slug ) {
            return $row['icon'];
        }
    }
    return $slug;
}

/**
 * Intro paragraph for single template: ACF card excerpt, then post excerpt.
 */
function pls_practice_area_intro_source_text( int $post_id ): string {
    if ( function_exists( 'get_field' ) ) {
        $acf = trim( wp_strip_all_tags( (string) get_field( 'pa_card_excerpt', $post_id ) ) );
        if ( $acf !== '' ) {
            return $acf;
        }
    }
    $excerpt = get_the_excerpt( $post_id );
    if ( $excerpt ) {
        return trim( wp_strip_all_tags( $excerpt ) );
    }
    return '';
}

/**
 * Up to two lines for cards (homepage / listing).
 *
 * @return array{0:string,1:string}
 */
function pls_practice_area_card_body_lines( int $post_id ): array {
    $acf_raw = function_exists( 'get_field' ) ? (string) get_field( 'pa_card_excerpt', $post_id ) : '';
    $acf_txt = trim( wp_strip_all_tags( $acf_raw ) );
    if ( $acf_txt !== '' ) {
        $parts = preg_split( '/\r\n|\r|\n/', $acf_raw, -1, PREG_SPLIT_NO_EMPTY );
        $parts = array_values(
            array_filter(
                array_map(
                    static function ( $p ) {
                        return trim( wp_strip_all_tags( (string) $p ) );
                    },
                    is_array( $parts ) ? $parts : []
                )
            )
        );
        if ( count( $parts ) >= 2 ) {
            return [ $parts[0], $parts[1] ];
        }
        if ( count( $parts ) === 1 ) {
            $sentences = preg_split( '/(?<=[.!?])\s+/', $parts[0], 3, PREG_SPLIT_NO_EMPTY );
            if ( is_array( $sentences ) && count( $sentences ) >= 2 ) {
                return [ trim( $sentences[0] ), trim( $sentences[1] ) ];
            }
            return [ $parts[0], '' ];
        }
    }

    $excerpt = get_the_excerpt( $post_id );
    if ( ! $excerpt ) {
        $excerpt = (string) get_post_field( 'post_content', $post_id );
        $excerpt = wp_trim_words( wp_strip_all_tags( $excerpt ), 40, '' );
    } else {
        $excerpt = wp_strip_all_tags( $excerpt );
    }
    $excerpt = trim( $excerpt );

    if ( $excerpt !== '' ) {
        $sentences = preg_split( '/(?<=[.!?])\s+/', $excerpt, 3, PREG_SPLIT_NO_EMPTY );
        if ( is_array( $sentences ) && count( $sentences ) >= 2 ) {
            return [ trim( $sentences[0] ), trim( $sentences[1] ) ];
        }
        $words = preg_split( '/\s+/', $excerpt, -1, PREG_SPLIT_NO_EMPTY );
        if ( is_array( $words ) && count( $words ) > 12 ) {
            $half = (int) ceil( count( $words ) / 2 );
            return [
                implode( ' ', array_slice( $words, 0, $half ) ),
                implode( ' ', array_slice( $words, $half ) ),
            ];
        }
        return [ $excerpt, '' ];
    }

    $slug = (string) get_post_field( 'post_name', $post_id );
    foreach ( pls_get_practice_areas_catalog() as $row ) {
        if ( $row['slug'] === $slug ) {
            return $row['lines'];
        }
    }

    return [
        __( 'Strategic advice and representation tailored to your situation in Pakistan and across borders where your matter reaches.', 'pakistan-legal-solutions' ),
        '',
    ];
}

/**
 * Whether the block editor body has user-visible text.
 */
function pls_practice_area_has_editor_content( int $post_id ): bool {
    $raw = (string) get_post_field( 'post_content', $post_id );
    return strlen( trim( wp_strip_all_tags( $raw ) ) ) > 0;
}

/**
 * Rich default body HTML for a practice area single when post_content is empty.
 *
 * @param string $slug Post slug (`post_name`) for the `practice_area` CPT.
 */
function pls_practice_area_default_content( string $slug ): string {
    $blocks = [
        'banking-finance'     => <<<'HTML'
<p>Banking and finance work in Pakistan sits at the intersection of contract, security, and sector regulation. Banks and borrowers argue over facilities, collateral, and repayment in dedicated banking courts and in related civil proceedings. Non-bank finance companies and payment service providers also face licensing and conduct rules from the Securities and Exchange Commission of Pakistan.</p>
<p>Foreign exchange controls matter whenever funds move in or out of Pakistan. The State Bank of Pakistan issues prudential regulations and circulars that shape how transactions are booked, reported, and challenged. We read the facility documents against those rules and against the Banking Companies Ordinance and related instruments that still frame much of the institutional landscape.</p>
<p>Debt recovery is not only about filing a suit. Enforcement of mortgages, pledges, and guarantees requires a clear paper trail and a forum strategy that matches the lender’s security package. We work with that reality from day one.</p>
<h2>What We Handle</h2>
<ul>
<li>Loan and working capital facility agreements, rescheduling, and events of default</li>
<li>Security creation and enforcement, including mortgage, hypothecation, and guarantee disputes</li>
<li>Recovery suits and defence work under the Banking Courts Ordinance, 1984, and allied civil remedies</li>
<li>Letters of credit, bank guarantees, and inter-bank payment disputes</li>
<li>Regulatory correspondence with the State Bank of Pakistan on reporting, classification, and compliance</li>
<li>Non-bank finance company structuring, licensing support, and SECP-facing filings where relevant</li>
<li>Foreign exchange regulation advice and disputes tied to current account rules and SBP approvals</li>
<li>Debt restructuring negotiations and formal recovery steps where the client needs a documented position</li>
</ul>
<h2>Our Approach</h2>
<p>We start with the facility file and the security documents. Pakistani banking judges expect a disciplined chronology of disbursements, notices, and responses. The Banking Courts Ordinance, 1984 sets out jurisdiction and procedure for many money claims against banking companies, but related matters still land in district courts or high courts depending on parties and relief sought.</p>
<p>Where the State Bank of Pakistan or the SECP is in play, we separate regulatory risk from private law claims. A clean memo to the regulator can sometimes narrow the dispute. Where it cannot, we prepare court pleadings that cite the correct statutory framework and the specific circulars your institution relied on.</p>
<p>We do not promise outcomes. We do promise work that holds together under scrutiny from opposing counsel and from the bench.</p>
<h2>Frequently Asked Questions</h2>
<h3>Can I ignore a banking court summons if I dispute the debt?</h3>
<p>No. Failure to file a written statement or to appear on key dates can expose you to ex parte relief. You should get legal advice quickly, collect your account statements and correspondence, and file a structured defence if the facts support it.</p>
<h3>Does the State Bank of Pakistan decide my loan dispute?</h3>
<p>Not usually as a final adjudicator of private debt. SBP supervises banks and issues regulations. Private disputes still go to banking courts or other civil forums depending on the case. SBP processes may run parallel if a regulatory breach is alleged.</p>
<h3>What documents matter most in a facility fight?</h3>
<p>The facility letter, any security documents, drawdown notices, margin calls, and all written amendments. Email trails matter if they vary terms. Bring a complete set early so counsel can map representations, covenants, and default triggers.</p>
<h3>How long can banking court proceedings take?</h3>
<p>Timelines vary by court workload and whether interim relief is sought. We give a straight estimate after we read the file and know the forum. What we control is orderly preparation so the matter does not stall for lack of pleadings or evidence.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'business-formation' => <<<'HTML'
<p>Starting a business in Pakistan means choosing a vehicle that fits tax, liability, and future investment plans. A private limited company is the default for many founders because it limits liability and speaks clearly to banks and partners. A sole proprietorship or registered firm under the Partnership Act, 1932 can still suit smaller operations if the risk profile matches.</p>
<p>The Companies Act, 2017 and SECP online processes govern incorporation, name reservation, and post-incorporation filings. Foreign companies often need a branch or liaison permission, not only a local incorporation. Parallel registration with the Federal Board of Revenue for a National Tax Number is part of practical setup, not an afterthought.</p>
<p>We also coordinate trademark basics with formation where the brand is central to the business.</p>
<h2>What We Handle</h2>
<ul>
<li>Private limited company incorporation and statutory registers under the Companies Act, 2017</li>
<li>Single member company conversion and compliance with SECP form requirements</li>
<li>Partnership deed drafting and registration where clients choose a firm structure</li>
<li>Association of persons documentation and clarity on profit-sharing and authority</li>
<li>Branch and liaison office applications for foreign companies alongside local counsel instructions</li>
<li>Founder, shareholder, and investment agreements tied to the chosen vehicle</li>
<li>FBR NTN registration guidance and coordination with your accountant on withholding labels</li>
<li>Trademark search and filing with IPO Pakistan in parallel with entity setup when needed</li>
</ul>
<h2>Our Approach</h2>
<p>We map who will own shares, who will sit on the board, and how decisions will be recorded. SECP expects clean digital submissions and timely annual returns. Getting the memorandum and articles right avoids fights later when a new investor appears.</p>
<p>Where the Partnership Act, 1932 applies, we spell out capital contributions, profit ratios, retirement, and dissolution. Many disputes come from silent assumptions. We prefer explicit clauses and signed minutes.</p>
<p>For foreign parents, we align Pakistan setup with home-country governance and transfer-pricing documentation your group already uses.</p>
<h2>Frequently Asked Questions</h2>
<h3>How long does SECP incorporation take?</h3>
<p>Online name clearance and incorporation can move quickly when documents are complete. Delays usually come from name clashes or incomplete subscriber data. We tell you the checklist up front so you are not cycling rejections.</p>
<h3>Do I need a lawyer if SECP forms look simple?</h3>
<p>Forms are only part of the job. Shareholder agreements, director duties, and future funding rounds need language that matches your commercial plan. Cheap templates often miss Pakistan-specific points on stamp duty, filing timelines, and director authority.</p>
<h3>Can a foreign person own 100 percent of a local company?</h3>
<p>Often yes in permitted sectors, but sector policy and investment reporting still matter. We review your sector and shareholding plan before you lock subscription money.</p>
<h3>Should I register a trademark at the same time?</h3>
<p>If the brand has value, yes. IPO Pakistan works on a first-to-file basis in practice for many marks. Early filing reduces the risk that a competitor registers a similar mark.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'civil-law'           => <<<'HTML'
<p>Civil litigation in Pakistan covers private claims that do not depend on a criminal conviction. Property fights, contract breaches, damages, and injunctions move mainly through district courts and, on appeal, through high courts. The Code of Civil Procedure, 1908 sets procedure for summons, written statements, discovery, and recording of evidence.</p>
<p>The Contract Act, 1872 governs formation, breach, and remedies such as damages. The Specific Relief Act shapes suits for specific performance, rescission, and declaratory relief. Judges expect pleadings that tie facts to sections and to the relief sought.</p>
<p>We handle trials and appeals where the record needs careful framing and where interim orders can decide the practical outcome long before final judgment.</p>
<h2>What We Handle</h2>
<ul>
<li>Property ownership, possession, and partition suits</li>
<li>Contract enforcement, damages, and rescission claims under the Contract Act, 1872</li>
<li>Specific performance and injunction applications under the Specific Relief Act</li>
<li>Money recovery suits based on promissory notes, cheques, or settled accounts</li>
<li>Declaratory suits on title, easements, and legal character of transactions</li>
<li>Civil revision and appeal work before high courts on substantial questions</li>
<li>Execution of decrees and resistance proceedings where assets are located</li>
<li>Interim relief strategy including attachments and stay orders where the law permits</li>
</ul>
<h2>Our Approach</h2>
<p>We draft pleadings that state material facts, not speeches. Pakistani trial courts work through written statements, issues, and oral evidence where witnesses appear. The Code of Civil Procedure, 1908 gives timelines and powers that good counsel use with discipline.</p>
<p>For property matters, we verify revenue record extracts, mutation entries, and any development authority permissions that affect enforceability. For contract cases, we map performance, counter-performance, and repudiation with documentary proof.</p>
<p>On appeal, we read the full trial record. High courts correct errors of law and, in limited circumstances, findings of fact. We do not file appeals without a candid assessment of grounds.</p>
<h2>Frequently Asked Questions</h2>
<h3>How long does a civil suit take in a district court?</h3>
<p>It varies by court, complexity, and whether interim orders are contested. Some suits finish within months if facts are narrow. Others take years if expert evidence or multiple parties are involved. We give a range after we study the file.</p>
<h3>Can I get an injunction without filing the main suit?</h3>
<p>Usually the injunction application rides with a properly instituted suit or a proceeding the law allows. Judges look for a prima facie case, irreparable harm, and the balance of convenience. We advise honestly on whether those tests are met.</p>
<h3>What is specific performance?</h3>
<p>It is a court order requiring a party to perform a contract, such as transferring land, when damages are not an adequate remedy. The Specific Relief Act limits when this relief is available.</p>
<h3>Do I need a survey or commission in land cases?</h3>
<p>Often yes when boundaries are disputed. We discuss whether a commission report will help the court and how to frame the prayer for relief.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'constitutional-law' => <<<'HTML'
<p>Constitutional law in Pakistan is about the relationship between the citizen, the state, and public authorities. The Constitution of Pakistan, 1973 sets out fundamental rights and the structure of government. When a public body exceeds its power or violates a right, superior courts may intervene through writ jurisdiction.</p>
<p>Article 199 of the Constitution gives the high courts power to issue directions, orders, or writs including habeas corpus, mandamus, certiorari, prohibition, and quo warranto. The Supreme Court of Pakistan sits at the apex on appeal and in certain original jurisdiction matters. Service tribunals and departmental law also feed into constitutional questions when recruitment, promotion, or removal rules are challenged.</p>
<p>We represent petitioners and respondents where public law issues need clear framing and where delay would cause real harm.</p>
<h2>What We Handle</h2>
<ul>
<li>Writ petitions under Article 199 of the Constitution before the Lahore High Court and other high courts as appropriate</li>
<li>Fundamental rights claims involving illegal detention, speech, association, and property</li>
<li>Challenges to statutory notifications, policy circulars, and delegated legislation</li>
<li>Judicial review of administrative actions by boards, commissions, and local bodies</li>
<li>Service matters with a constitutional angle after tribunal routes are exhausted or where law permits direct access</li>
<li>Representation in suo motu proceedings where counsel must respond on short notice</li>
<li>Constitutional interpretation issues that affect ongoing civil or criminal proceedings</li>
<li>Appeals and review before the Supreme Court of Pakistan on constitutional questions</li>
</ul>
<h2>Our Approach</h2>
<p>Writ courts move quickly when urgency is real and documented. We prepare short petitions with precise prayers, verified facts, and annexures that judges can read in one sitting. We cite the Constitution of Pakistan, 1973 and the case law that binds the forum you are in.</p>
<p>Where government pleads policy, we separate valid policy from bare discretion. Where fundamental rights are asserted, we tie the record to concrete violations, not slogans.</p>
<p>For service matters, we check whether tribunal jurisdiction must be invoked first. Wasting a constitutional court’s time on premature filings hurts clients. We say so plainly if the route is wrong.</p>
<h2>Frequently Asked Questions</h2>
<h3>Is every government wrong a constitutional case?</h3>
<p>No. Some grievances belong before specialised tribunals or in civil suits. We assess whether Article 199 is the correct door before filing.</p>
<h3>Can the high court order money damages in a writ?</h3>
<p>Writ relief is usually declaratory or injunctive. Compensation may follow in limited contexts depending on facts and precedent. We explain what your case realistically supports.</p>
<h3>How urgent is “urgent” for interim relief?</h3>
<p>You need a credible timeline showing harm if the court waits. Vague allegations fail. We help you assemble affidavits and exhibits that meet that standard.</p>
<h3>What is the difference between the high court and the Supreme Court at first contact?</h3>
<p>Most original writ work starts at the high court under Article 199. The Supreme Court has its own jurisdictional thresholds. We advise which institution fits your papers.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'contract-drafting'   => <<<'HTML'
<p>Contracts fix expectations before money and risk move. In Pakistan, commercial parties still rely heavily on written English agreements, sometimes alongside Urdu understandings that should not contradict the signed text. Employment, supply, investment, and collaboration deals each carry different statutory overlays.</p>
<p>Drafting is not typing. It is matching clauses to how your business actually runs, including payment triggers, acceptance tests, confidentiality, and exit. Foreign templates often ignore stamp duties, notarisation habits, and local court practice on interpretation.</p>
<p>We also review agreements sent by counterparties so you know what you are signing before you bind the company.</p>
<h2>What We Handle</h2>
<ul>
<li>Commercial supply, distribution, and services agreements for domestic and cross-border trade</li>
<li>Employment contracts, incentive plans, and restrictive covenants that respect enforceability limits</li>
<li>Memoranda of understanding that either bind or clearly do not bind, as intended</li>
<li>Shareholder agreements, subscription letters, and simple share transfer instruments</li>
<li>Joint venture and collaboration agreements for projects with shared risk</li>
<li>Share purchase and asset purchase style schedules adapted to Pakistan law context</li>
<li>Confidentiality and non-disclosure agreements for vendors, consultants, and investors</li>
<li>Review of foreign-form contracts with a Pakistan risk memo for management</li>
</ul>
<h2>Our Approach</h2>
<p>We interview the commercial lead and read prior deals your team signed. Recycled definitions sometimes conflict with new obligations. We clean that up before the other side’s counsel sees it.</p>
<p>We align headings with the Contract Act, 1872 concepts your judge will use if there is a breach, formation fight, or frustration argument. We mark governing law and jurisdiction choices that fit your enforcement plan, without selling you clauses you do not need.</p>
<p>We turn drafts around with tracked changes and a short issues list so business teams can decide quickly.</p>
<h2>Frequently Asked Questions</h2>
<h3>Is a two-page contract safer than a long one?</h3>
<p>Length is not the point. Clarity is. A short agreement that omits material terms can create more litigation than a longer precise document.</p>
<h3>Can you draft in bilingual format?</h3>
<p>Yes when clients need Urdu summaries or side-by-side text. The English version usually remains controlling unless you choose otherwise explicitly.</p>
<h3>What if the other party refuses to change their template?</h3>
<p>We mark red flags, suggest fallbacks, and quantify risk so you can decide whether to walk away or insure the exposure.</p>
<h3>Do MOUs create legal obligations?</h3>
<p>They can if language shows intent to be bound. We draft MOUs to match your intent, whether binding or non-binding.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'corporate-law'       => <<<'HTML'
<p>Corporate law in Pakistan is dominated by the Companies Act, 2017 and SECP practice. Boards must meet, disclose related-party transactions, and file returns on time. Shareholders expect dividends, transfers, and meetings that follow the articles and the statute.</p>
<p>Mergers and acquisitions, joint ventures, and private equity style entries require due diligence on contracts, litigation, labour, and sector licences. The Competition Commission of Pakistan may need notice for certain concentrations. Getting that wrong can delay closing or create post-closing liability.</p>
<p>Directors owe duties of care and loyalty. We advise both companies and individual directors when decisions carry personal risk.</p>
<h2>What We Handle</h2>
<ul>
<li>Board governance, minutes, and delegation of powers under the Companies Act, 2017</li>
<li>Annual and event-based SECP filings, including changes in directors and share capital</li>
<li>Foreign investment entry structures, security filings, and shareholder arrangements</li>
<li>Share transfers, buybacks where permitted, and private placement documentation</li>
<li>Merger, amalgamation, and scheme of arrangement steps with SECP processes</li>
<li>Legal due diligence for acquisitions and joint ventures</li>
<li>Director and officer advice on conflicts, disclosures, and indemnities</li>
<li>Competition Commission of Pakistan filings and risk review for reportable transactions</li>
</ul>
<h2>Our Approach</h2>
<p>We read the company’s constitutional documents before we opine. Corporate answers depend on authorised share capital, classes of shares, and any shareholders’ agreement sitting alongside the articles.</p>
<p>For transactions, we issue a due diligence report that flags litigation, labour exposure, and missing regulatory approvals. We coordinate with tax counsel where valuations and withholding intersect.</p>
<p>Where the Competition Commission of Pakistan is engaged, we map turnover tests and exemptions honestly. False comfort helps no one.</p>
<h2>Frequently Asked Questions</h2>
<h3>What is the most common SECP compliance mistake?</h3>
<p>Late filing of returns and forms after a board change or allotment. Penalties accumulate. We set calendars tied to your board cycle.</p>
<h3>Can a minority shareholder block a sale?</h3>
<p>It depends on the articles, any shareholders’ agreement, and the Companies Act, 2017 provisions on class rights. We review the instruments and give a straight answer.</p>
<h3>Do directors face personal liability?</h3>
<p>In certain statutory breaches and in tort, yes. We explain exposure before you sign board minutes.</p>
<h3>When does competition filing arise?</h3>
<p>When thresholds in law and regulation are met for mergers or acquisitions. We assess early with your financials.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'cyber-crime'         => <<<'HTML'
<p>Cybercrime work in Pakistan now runs primarily through the Prevention of Electronic Crimes Act, 2016. The statute creates offences for unauthorised access, identity fraud, harassment, and speech-related crimes subject to constitutional limits. Investigations often involve the FIA Cybercrime Wing and digital forensics units.</p>
<p>Online fraud, fake investment portals, and romance scams produce voluminous bank trails. Hacking and data theft cases need preservation orders and chain-of-custody discipline. Defamation and blackmail on social media raise both criminal complaints and civil remedies depending on client goals.</p>
<p>We act for complainants who need a proper FIR and for accused persons who need a controlled response to coercive investigation.</p>
<h2>What We Handle</h2>
<ul>
<li>FIR drafting and follow-up with the FIA Cybercrime Wing on electronic fraud and impersonation</li>
<li>Defence in PECA investigations and charge sheets where facts are disputed</li>
<li>Harassment, blackmail, and stalking complaints involving digital evidence</li>
<li>Identity theft and payment app misuse with bank liaison where useful</li>
<li>Data access disputes involving employees and former employees</li>
<li>Social media defamation strategy, including takedown steps where platforms respond</li>
<li>Coordination with NR3C and provincial cyber units when jurisdiction overlaps</li>
<li>Bail and trial representation in courts that hear PECA offences</li>
</ul>
<h2>Our Approach</h2>
<p>We secure screenshots, metadata where available, and bank SMS logs in an organised index. The Prevention of Electronic Crimes Act, 2016 cases rise or fall on admissible digital proof and witness linking.</p>
<p>For complainants, we focus on a coherent FIR narrative and follow-through with investigation officers. For accused clients, we test the chronology, device control, and intent elements before advising on plea or trial.</p>
<p>We do not advise illegal surveillance or evidence tampering. We work within the Criminal Procedure Code framework that applies to police investigation and court trial.</p>
<h2>Frequently Asked Questions</h2>
<h3>Should I go to the police or FIA first?</h3>
<p>Most electronic offences under PECA are investigated by the FIA Cybercrime Wing. Local police may still register parallel FIRs in some facts. We choose the forum that matches the offence and jurisdiction rules.</p>
<h3>Can a WhatsApp chat be used in court?</h3>
<p>It can be evidence if properly exhibited and authenticated. We explain how to preserve chats and how opposing counsel may challenge them.</p>
<h3>What if someone forged my CNIC for a SIM or wallet?</h3>
<p>You need a documented trail to the operator and to law enforcement. We help frame the complaint and coordinate identity restoration steps.</p>
<h3>Is deleting posts after a dispute a good idea?</h3>
<p>Sometimes deletion helps mitigation. Sometimes it looks like spoliation. We advise case by case before you touch the record.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'family-law'          => <<<'HTML'
<p>Family law in Pakistan covers marriage, dissolution of marriage, maintenance, custody, guardianship, and inheritance. The Muslim Family Laws Ordinance, 1961 sets procedures for talaqnama, reconciliation certificates, and khula through courts. The Family Courts Act, 1964 establishes dedicated family judges and speedy trial goals for listed subjects.</p>
<p>Child custody and maintenance disputes require sensitivity and a clear parenting narrative supported by school records, medical notes, and housing facts. Inheritance fights often mix family pressure with revenue record claims. The Child Marriages Restraint Act remains relevant in prevention and allied proceedings.</p>
<p>Overseas Pakistanis often need remote instructions, powers of attorney, and video-link evidence where courts allow. We work with that reality.</p>
<h2>What We Handle</h2>
<ul>
<li>Khula and dissolution proceedings under the Muslim Family Laws Ordinance, 1961</li>
<li>Divorce documentation, reconciliation steps, and dower or mehr enforcement</li>
<li>Child custody, visitation, and guardianship under the Guardians and Wards Act where applicable</li>
<li>Maintenance for wife and children under family court statutes</li>
<li>Inheritance statements, blocked mutations, and family-driven property partition</li>
<li>Overseas Pakistani clients coordinating affidavits and embassy attestations</li>
<li>Nikahnama interpretation disputes and registration issues</li>
<li>Child marriage prevention complaints and allied relief under the Child Marriages Restraint Act</li>
</ul>
<h2>Our Approach</h2>
<p>We take a full family timeline in the first meeting. Pakistani family judges want a clear chronology of separation, financial support, and care of children. We avoid inflammatory pleadings that backfire in custody matters.</p>
<p>Where settlement is possible, we draft terms that a family court can record. Where it is not, we prepare evidence lists and witness summaries under the Family Courts Act, 1964 procedure.</p>
<p>For overseas clients, we explain which hearings require physical presence and which steps a local attorney-in-fact can handle with proper documentation.</p>
<h2>Frequently Asked Questions</h2>
<h3>How long does khula take?</h3>
<p>It varies by court backlog and whether the other side contests. Some courts move in months if service is clean. Contested cases take longer. We do not quote fantasy timelines.</p>
<h3>Can fathers get custody of young children?</h3>
<p>Pakistani courts look at the welfare of the minor. Gender alone is not supposed to decide, but practical caregiving history matters. We assess your facts candidly.</p>
<h3>What if my spouse refuses to pay maintenance?</h3>
<p>Family courts can fix maintenance and enforce through execution where assets exist. We discuss proof of income and reasonable needs early.</p>
<h3>Can I handle my case from abroad?</h3>
<p>Partially. Many steps need attested powers and sometimes personal appearance for evidence. We map what you can do remotely under current court practice.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'ip-law'              => <<<'HTML'
<p>Intellectual property in Pakistan is administered mainly through IPO Pakistan. Trademarks sit under the Trade Marks Ordinance, 2001. Copyright matters draw on the Copyright Ordinance, 1962. Patents follow the Patents Ordinance, 2000. Enforcement still requires civil suits, criminal complaints where applicable, and practical coordination with customs for border seizures in suitable cases.</p>
<p>Brand owners face copying in retail markets and online marketplaces. Software and media businesses worry about unlicensed use. Manufacturers need plant-level trade secret discipline, not only registration certificates.</p>
<p>Domain name disputes and passing off claims often overlap with trademark infringement. We plan registration and enforcement together.</p>
<h2>What We Handle</h2>
<ul>
<li>Trademark searches, applications, oppositions, and cancellations before IPO Pakistan</li>
<li>Copyright filings and advice on ownership chains for commissioned works</li>
<li>Patent drafting coordination with technical experts and filing strategy</li>
<li>Civil infringement suits, interim injunctions, and accounts of profits where viable</li>
<li>Passing off actions for unregistered but established marks</li>
<li>Trade secret protection through employment clauses and internal policy</li>
<li>Domain dispute complaints and platform takedown workflows</li>
<li>Criminal complaints under intellectual property statutes where facts support them</li>
</ul>
<h2>Our Approach</h2>
<p>We audit your existing registrations against actual use. Gaps invite squatters. We file in the correct classes and maintain renewal calendars under the Trade Marks Ordinance, 2001.</p>
<p>For enforcement, we compare your mark with the infringing device, gather specimen packaging, and assess whether ex parte interim relief is realistic in your forum. Judges expect a clear likelihood of confusion or passing off.</p>
<p>For patents, we work with inventors to draft claims that survive novelty and inventive step scrutiny under the Patents Ordinance, 2000.</p>
<h2>Frequently Asked Questions</h2>
<h3>Do I own copyright if I paid a freelancer?</h3>
<p>Not automatically unless the contract assigns rights in writing. We fix assignments before launch.</p>
<h3>How long does trademark registration take?</h3>
<p>Examination and publication stages vary. Oppositions add time. We give estimates based on current IPO Pakistan queues when we file.</p>
<h3>Can I stop imports of fake goods?</h3>
<p>Customs recordal and court orders can help when marks are registered and evidence is solid. We review feasibility.</p>
<h3>What is passing off?</h3>
<p>It is a common-law style claim that someone misrepresented goods or services as yours. It matters when you have reputation but no registration.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'sports-law'          => <<<'HTML'
<p>Sports law is an emerging practice area in Pakistan, but disputes are real. Athletes sign contracts with clubs, federations, and agents. Federations hold disciplinary hearings. Sponsors want exclusivity and clean termination clauses. Prize money rows erupt after tournaments.</p>
<p>Many athletes also compete abroad, so contracts may reference foreign league rules or international federation codes. Doping allegations need a defence strategy that respects testing protocols and appeal bodies.</p>
<p>We handle domestic work and international sports matters where Pakistani clients need counsel who reads English contracts and local law together.</p>
<h2>What We Handle</h2>
<ul>
<li>Player and coach employment contracts with clubs and academies</li>
<li>Federation eligibility, selection, and membership disputes</li>
<li>Doping defence work, provisional suspensions, and appeal panels</li>
<li>Prize money, appearance fees, and bonus disputes after events</li>
<li>Image rights and endorsement deals for athletes and teams</li>
<li>Sponsorship agreement drafting and breach claims</li>
<li>Disciplinary hearings before sports bodies and internal appeal committees</li>
<li>Agency agreements and termination fights between athletes and managers</li>
</ul>
<h2>Our Approach</h2>
<p>We read the sporting body’s constitution and disciplinary code alongside your contract. Many disputes turn on filing deadlines internal to the federation. Missing a notice window can end the case before it starts.</p>
<p>For sponsorship and brand deals, we align exclusivity clauses with real delivery obligations, social media metrics, and morals clauses that Pakistani courts will read sensibly.</p>
<p>Where foreign governing law appears, we explain which clauses a Pakistani judge will enforce and where parallel advice abroad is needed.</p>
<h2>Frequently Asked Questions</h2>
<h3>Can I challenge a federation ban?</h3>
<p>Often yes if natural justice was denied or the penalty is disproportionate. We review the hearing record and timelines.</p>
<h3>Do image rights contracts work in Pakistan?</h3>
<p>They work as contractual undertakings tied to personality and brand use. We draft clear scope, territory, and fee triggers.</p>
<h3>What if my club stopped paying salary?</h3>
<p>We assess contract termination rights, arrears claims, and sporting body complaints if registration is affected.</p>
<h3>Are doping cases only about science?</h3>
<p>They are about chain of custody, lab certificates, and procedural fairness as much as science. We coordinate with experts when needed.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'taxation'            => <<<'HTML'
<p>Tax disputes in Pakistan usually start with audit notices, show-cause letters, and orders from the Commissioner Inland Revenue or sales tax officers. The Income Tax Ordinance, 2001 governs income and withholding tax. The Sales Tax Act, 1990 covers goods and services tax administration at the federal level for registered persons.</p>
<p>Appeals move through appellate tribunals and, on questions of law, to high courts. Customs assessments have their own appellate track. Overseas Pakistanis face residency tests, foreign income reporting, and withholding on Pakistan-source payments.</p>
<p>We separate accounting disagreements from legal character questions so clients do not pay tax they do not owe.</p>
<h2>What We Handle</h2>
<ul>
<li>FBR audit defence, reconciliations, and written replies to show-cause notices</li>
<li>Income tax appeals before the Commissioner Appeals and tribunals under the Income Tax Ordinance, 2001</li>
<li>Sales tax and federal excise disputes, including input adjustment denials</li>
<li>Customs valuation and classification appeals where applicable</li>
<li>Advance tax and withholding disputes on salaries, dividends, and contracts</li>
<li>Penalty and default surcharge challenges on procedural and merits grounds</li>
<li>Overseas Pakistani residency and foreign income reporting issues</li>
<li>High court references on substantial questions of law after tribunal orders</li>
</ul>
<h2>Our Approach</h2>
<p>We read the audit order line by line and tie each addition to evidence the officer must produce. The Income Tax Ordinance, 2001 has specific burden rules and limitation periods we watch closely.</p>
<p>For sales tax under the Sales Tax Act, 1990, we trace invoices, digital returns, and stock records. Weak documentary trails need honest repair before we argue law.</p>
<p>We work with your chartered accountant on numbers but keep legal theory in counsel’s hands for appeals.</p>
<h2>Frequently Asked Questions</h2>
<h3>Can I ignore a tax notice?</h3>
<p>No. Silence can lead to ex parte assessment and harder recovery later. Reply within time or seek extension properly.</p>
<h3>What is the difference between a departmental appeal and high court?</h3>
<p>Tribunals handle facts and law within their statute. High courts mainly correct legal error on stated questions after you exhaust remedies.</p>
<h3>How do I reduce withholding disputes with clients?</h3>
<p>Clear contracts, correct NRN certificates where relevant, and documented exemption claims help. We review your paperwork.</p>
<h3>Do overseas Pakistanis pay tax on remittances?</h3>
<p>Not all remittances are taxable income. Facts decide. We review source, residency, and treaties if they apply.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
        'white-collar-crime'  => <<<'HTML'
<p>White collar work in Pakistan spans corruption inquiries, financial fraud, money laundering allegations, and regulatory offences. The National Accountability Bureau operates under the National Accountability Ordinance with a focus on holders of public office and certain private persons tied to public corruption. The Federal Investigation Agency handles many electronic and financial crime investigations.</p>
<p>The Anti-Money Laundering Act, 2010 and related rules create reporting duties for financial institutions and expose individuals to parallel proceedings. Cheque dishonour cases still flood sessions courts under the Negotiable Instruments regime. Sector regulators like NEPRA and OGRA can launch enforcement that feels criminal even when it is administrative.</p>
<p>Early legal strategy matters when agencies freeze accounts or seize travel documents.</p>
<h2>What We Handle</h2>
<ul>
<li>NAB inquiry and reference defence for individuals and private companies</li>
<li>FIA financial crime investigations, including bank fraud teams</li>
<li>Anti-money laundering inquiries, freezing orders, and related court challenges</li>
<li>Prevention of Corruption Act matters tied to public servants</li>
<li>Bank fraud complaints and defence where lending and security facts are disputed</li>
<li>Cheque dishonour complaints and defence under applicable criminal procedure</li>
<li>NEPRA and OGRA regulatory violations with criminal or quasi-criminal exposure</li>
<li>Bail applications and trial strategy in complex financial records cases</li>
</ul>
<h2>Our Approach</h2>
<p>We obtain the complete agency file permitted by law and map each allegation to evidence. The National Accountability Ordinance has its own procedures and judicial precedents on asset inquiry and plea bargaining where available.</p>
<p>For money laundering cases, we trace funds with bank records and separate lawful business receipts from suspicious timing claims. The Anti-Money Laundering Act, 2010 charges need a coherent narrative from the prosecution. We test gaps early.</p>
<p>We coordinate with forensic accountants when volumes exceed manual review. We do not coach false statements.</p>
<h2>Frequently Asked Questions</h2>
<h3>Should I attend a summons without a lawyer?</h3>
<p>You should not. You can waive rights or produce harmful informal statements. We attend with you or seek lawful postponement to prepare.</p>
<h3>Can NAB freeze property before a conviction?</h3>
<p>Agencies often seek provisional attachment within their statutory scheme. We challenge orders when grounds and procedure fail.</p>
<h3>What is the difference between FIA and NAB?</h3>
<p>Mandates and statutes differ. Some facts attract both. We analyse jurisdiction before responding.</p>
<h3>Are cheque cases only civil?</h3>
<p>Dishonour can trigger criminal complaints under the Negotiable Instruments framework alongside civil recovery. We advise on both tracks.</p>
<p>Call us or send a message. First consultation is free.</p>
HTML
        ,
    ];

    return $blocks[ $slug ] ?? '';
}

/**
 * Minimal fallback body HTML when post content is empty and no catalog default exists for the slug.
 */
function pls_practice_area_placeholder_body_html( string $title ): string {
    $p1 = sprintf(
        /* translators: %s: practice area title */
        __( 'Pakistan Legal Solutions advises on %s in Pakistan. We review your documents, map the legal issues, and set out practical next steps.', 'pakistan-legal-solutions' ),
        $title
    );
    $p2 = __(
        'Bring your file in order: contracts, notices, and a short chronology. That lets us give clear advice in the first meeting.',
        'pakistan-legal-solutions'
    );
    return '<p>' . esc_html( $p1 ) . '</p><p>' . esc_html( $p2 ) . '</p>';
}
