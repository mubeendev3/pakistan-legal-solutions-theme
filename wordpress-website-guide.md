# Pakistan Legal Solutions — WordPress Theme Development Guide
### Complete Developer Reference | Built by Mubeen Mehmood

> **Brand / site title:** Pakistan Legal Solutions  
> **Public domain:** [pakistanlegalsolution.com](https://pakistanlegalsolution.com) (note: singular *solution* in the domain; plural *Solutions* in the business name — common and fine, but keep DNS and email consistent with the registered domain)  
> **Developer:** Mubeen Mehmood  
> **Stack:** WordPress + Custom PHP Theme (no page builder)  
> **Hosting:** Hostinger Premium (already active)  
> **Approach:** 100% coded from scratch — Cursor Pro + Claude Pro + GitHub  
> **Deploy:** GitHub → FTP to Hostinger → WordPress activate  

**Before launch:** Replace every placeholder in this guide (address, phone, stats, map embed, social URLs, years of experience, bar references) with data the client approves. Theme slug, text domain, and PHP prefix in the snippets are aligned to this project: `pakistan-legal-solutions` / `PLS_` / `pls_`.

---

## Table of Contents

1. [Mental Model — What You're Actually Building](#1-mental-model)
2. [Tech Stack & Tools](#2-tech-stack--tools)
3. [Local Development Setup](#3-local-development-setup)
4. [GitHub Repository Setup](#4-github-repository-setup)
5. [Complete Folder Structure](#5-complete-folder-structure)
6. [WordPress Configuration on Hostinger](#6-wordpress-configuration-on-hostinger)
7. [Theme File-by-File Reference](#7-theme-file-by-file-reference)
   - [style.css](#71-stylecss--theme-registration)
   - [functions.php](#72-functionsphp--theme-brain)
   - [header.php](#73-headerphp)
   - [footer.php](#74-footerphp)
   - [front-page.php](#75-front-pagephp--homepage)
   - [page.php](#76-pagephp--static-pages)
   - [single.php](#77-singlephp--blog-posts)
   - [archive.php](#78-archivephp)
   - [404.php](#79-404php)
   - [template-contact.php](#710-template-contactphp)
   - [template-about.php](#711-template-aboutphp)
   - [single-practice_area.php](#712-single-practice_areaphp)
   - [archive-practice_area.php](#713-archive-practice_areaphp)
8. [CSS Architecture](#8-css-architecture)
9. [JavaScript Architecture](#9-javascript-architecture)
10. [Custom Post Types Reference](#10-custom-post-types-reference)
11. [ACF Fields Setup](#11-acf-fields-setup)
12. [Contact Form — PHP Handler](#12-contact-form--php-handler)
13. [Performance Best Practices](#13-performance-best-practices)
14. [Security Hardening](#14-security-hardening)
15. [SEO Implementation](#15-seo-implementation)
16. [GitHub Workflow](#16-github-workflow)
17. [Deploy to Hostinger](#17-deploy-to-hostinger)
18. [Post-Launch Checklist](#18-post-launch-checklist)
19. [Cursor + Claude Prompts](#19-cursor--claude-prompts)
20. [Troubleshooting](#20-troubleshooting)

---

## 1. Mental Model

Before writing a single line of code, burn this into your head:

```
WordPress = CMS engine (handles database, users, routing, admin panel)
Your theme = The entire visual website (every pixel you see is your code)
```

WordPress looks for files in this order when serving a page. This is called the **Template Hierarchy**:

```
Homepage    → front-page.php → home.php → index.php
Static page → page-{slug}.php → page-{id}.php → page.php → index.php
Blog post   → single-{post-type}.php → single.php → index.php
CPT single  → single-practice_area.php → single.php → index.php
CPT archive → archive-practice_area.php → archive.php → index.php
Search      → search.php → index.php
404         → 404.php → index.php
```

Knowing this means you always know which file controls which page. You never guess.

**The WordPress Loop** — every template that shows content uses this pattern:

```php
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- your HTML with template tags like the_title(), the_content() -->
<?php endwhile; endif; ?>
```

WordPress populates `have_posts()` based on the current URL. You just render what it gives you.

---

## 2. Tech Stack & Tools

| Layer | Technology | Why |
|-------|-----------|-----|
| CMS | WordPress 6.5+ | Industry standard, free, Hostinger 1-click |
| Language | PHP 8.2 | Latest stable, required by WP 6.5 |
| Templating | WordPress template hierarchy | Native, no framework needed |
| CSS | Custom Properties + BEM + modern CSS | No framework, full control, fast |
| JavaScript | Vanilla ES6+ | No jQuery, no build step needed |
| Custom Fields | ACF Free | Client-editable content without code |
| Forms | Native PHP + wp_mail() | No plugin dependency |
| Icons | SVG sprite (self-hosted) | Zero HTTP requests, scalable |
| Fonts | Google Fonts (self-hosted via fontsource) | GDPR compliant, fast |
| Version Control | Git + GitHub | Professional standard |
| Local Dev | Local by WP Engine | Best free WordPress local env |
| Editor | Cursor Pro | AI-assisted coding |
| Deploy | FileZilla FTP / GitHub Actions | Free, reliable |
| SEO Plugin | Yoast SEO (free) | Industry standard |
| Security | Wordfence (free) | Firewall + malware scan |
| Caching | WP Super Cache (free) | Page speed |

**What we deliberately do NOT use:**
- Elementor / any page builder (adds 2–5MB of bloat per page)
- Bootstrap / Tailwind (unnecessary for a custom theme with modern CSS)
- jQuery (vanilla JS handles everything we need)
- Contact Form 7 / WPForms (we write our own — cleaner, no plugin update risk)

---

## 3. Local Development Setup

### 3.1 Install Local by WP Engine

Download from **localwp.com** (free). Install it. Open it.

Click `+` → Create new site:
```
Site name:    pakistan-legal-solutions
PHP version:  8.2
Web server:   Nginx (faster than Apache)
MySQL:        8.0
WP username:  admin
WP password:  admin  (local only, doesn't matter)
WP email:     mubeen@dev.local
```

Click "Add Site." Your local WordPress is now running at:
- Site: `http://pakistan-legal-solutions.local`
- Admin: `http://pakistan-legal-solutions.local/wp-admin`

### 3.2 Open Theme Folder in Cursor

In Local, right-click your site → "Open Site Folder." Navigate to:
```
app/public/wp-content/themes/
```

Create a new folder here called `pakistan-legal-solutions`. Open this folder in Cursor.

Every file you create inside `pakistan-legal-solutions/` is live instantly at your local URL. No build step. No restart. Just save and refresh.

### 3.3 Install WordPress Plugins Locally

Go to `http://pakistan-legal-solutions.local/wp-admin` → Plugins → Add New. Install these:

- **Advanced Custom Fields** (free) — for editable content fields
- **Yoast SEO** (free) — SEO management
- **WP Super Cache** (free) — caching
- **Wordfence Security** (free) — security
- **UpdraftPlus** (free) — backups

Do NOT install Elementor. You don't need it.

---

## 4. GitHub Repository Setup

### 4.1 Create the Repo

Go to github.com → New repository:
```
Repository name:  pakistan-legal-solutions-theme
Visibility:       Private (your client's code)
Initialize:       Yes (add README)
.gitignore:       None (we create our own)
```

### 4.2 Initialize Git in Cursor

Open Cursor terminal (`Ctrl+`` ` or `Cmd+`` `):

```bash
cd /path/to/your/pakistan-legal-solutions/theme/folder
git init
git remote add origin https://github.com/mubeenmehmood/pakistan-legal-solutions-theme.git
```

### 4.3 Create .gitignore

Create `.gitignore` in your theme root:

```gitignore
# OS files
.DS_Store
Thumbs.db
desktop.ini

# Editor files
.vscode/
.idea/
*.swp
*.swo

# Node (if you use any build tools later)
node_modules/
npm-debug.log*

# Build output
dist/
build/

# Environment files (NEVER commit these)
.env
.env.local
*.env

# WordPress specific (these live on the server, not in your theme)
wp-config.php

# Logs
*.log
error_log

# Cache
.cache/
```

### 4.4 Branch Strategy

```
main        ← production-ready code only
develop     ← active development
feature/*   ← individual features (feature/contact-form, feature/homepage)
```

Daily workflow:
```bash
# Start a new feature
git checkout develop
git checkout -b feature/homepage-hero

# Work on it, then commit
git add .
git commit -m "feat: add homepage hero section with stats bar"

# Push to GitHub
git push origin feature/homepage-hero

# When done, merge to develop
git checkout develop
git merge feature/homepage-hero

# When ready to deploy, merge develop to main
git checkout main
git merge develop
git push origin main
```

Commit message format (conventional commits):
```
feat: add new feature
fix: fix a bug
style: CSS/design changes
refactor: code restructure, no feature change
docs: documentation
chore: tooling, config changes
```

---

## 5. Complete Folder Structure

This is the complete, production-ready folder structure. Build it exactly like this.

```
pakistan-legal-solutions/                          ← WordPress theme root
│
├── style.css                          ← REQUIRED: Theme registration header
├── functions.php                      ← REQUIRED: Theme brain
├── index.php                          ← REQUIRED: Fallback template
│
├── header.php                         ← Site header (all pages)
├── footer.php                         ← Site footer (all pages)
├── sidebar.php                        ← Sidebar (optional, for blog)
│
├── front-page.php                     ← Homepage (static front page)
├── page.php                           ← Generic static page template
├── single.php                         ← Single blog post
├── archive.php                        ← Blog post listing
├── search.php                         ← Search results
├── 404.php                            ← Page not found
│
├── template-contact.php               ← Contact page (custom template)
├── template-about.php                 ← About page (custom template)
├── template-practice-areas.php        ← Practice areas overview
│
├── single-practice_area.php           ← Single practice area page
├── archive-practice_area.php          ← Practice areas listing
├── single-team_member.php             ← Single attorney profile
│
├── template-parts/                    ← Reusable partials
│   ├── header/
│   │   ├── navigation.php             ← Primary nav markup
│   │   └── mobile-menu.php           ← Mobile hamburger menu
│   ├── footer/
│   │   ├── footer-widgets.php         ← Footer columns
│   │   └── footer-bottom.php          ← Copyright bar
│   ├── home/
│   │   ├── hero.php                   ← Homepage hero section
│   │   ├── trust-bar.php              ← Logos / accreditations
│   │   ├── practice-areas.php         ← Practice areas grid
│   │   ├── why-choose-us.php          ← USP section
│   │   ├── attorneys.php              ← Attorney spotlight
│   │   ├── testimonials.php           ← Client testimonials
│   │   ├── cta-banner.php             ← Call to action
│   │   └── contact-strip.php          ← Address/phone strip
│   ├── practice-area/
│   │   ├── pa-hero.php                ← Practice area hero
│   │   ├── pa-overview.php            ← Overview content
│   │   ├── pa-process.php             ← Our process / steps
│   │   └── pa-related.php             ← Related practice areas
│   ├── components/
│   │   ├── breadcrumb.php             ← Breadcrumb navigation
│   │   ├── attorney-card.php          ← Reusable attorney card
│   │   ├── practice-card.php          ← Reusable practice area card
│   │   ├── testimonial-card.php       ← Reusable testimonial card
│   │   └── cta-inline.php             ← Inline CTA block
│   └── forms/
│       ├── contact-form.php           ← Contact form HTML
│       └── consultation-form.php      ← Simplified consultation form
│
├── assets/
│   ├── css/
│   │   ├── main.css                   ← Compiled/main stylesheet
│   │   ├── base/
│   │   │   ├── _reset.css             ← Modern CSS reset
│   │   │   ├── _variables.css         ← CSS custom properties
│   │   │   ├── _typography.css        ← Type system
│   │   │   └── _utilities.css         ← Helper classes
│   │   ├── layout/
│   │   │   ├── _grid.css              ← Layout system
│   │   │   ├── _header.css            ← Header styles
│   │   │   └── _footer.css            ← Footer styles
│   │   ├── components/
│   │   │   ├── _buttons.css           ← Button variants
│   │   │   ├── _cards.css             ← Card components
│   │   │   ├── _forms.css             ← Form styles
│   │   │   ├── _navigation.css        ← Nav styles
│   │   │   └── _breadcrumb.css        ← Breadcrumb
│   │   └── pages/
│   │       ├── _home.css              ← Homepage-specific
│   │       ├── _about.css             ← About page
│   │       ├── _practice-area.css     ← Practice area pages
│   │       └── _contact.css           ← Contact page
│   ├── js/
│   │   ├── main.js                    ← Entry point, imports modules
│   │   ├── modules/
│   │   │   ├── navigation.js          ← Mobile menu, sticky header
│   │   │   ├── smooth-scroll.js       ← Anchor link smooth scroll
│   │   │   ├── animations.js          ← Intersection Observer animations
│   │   │   ├── contact-form.js        ← Form validation + AJAX submit
│   │   │   └── accordion.js           ← FAQ accordion
│   │   └── vendor/                    ← Third-party scripts (if any)
│   ├── images/
│   │   ├── logo.svg                   ← Main logo (SVG always)
│   │   ├── logo-white.svg             ← White version for dark backgrounds
│   │   ├── favicon.ico
│   │   ├── apple-touch-icon.png       ← 180x180px
│   │   ├── og-image.jpg               ← 1200x630px Open Graph image
│   │   └── hero-bg.jpg                ← Homepage hero background
│   ├── fonts/                         ← Self-hosted fonts (optional)
│   │   ├── playfair-display/
│   │   └── inter/
│   └── icons/
│       └── sprite.svg                 ← SVG icon sprite
│
├── inc/                               ← PHP includes (logic, not templates)
│   ├── custom-post-types.php          ← CPT registrations
│   ├── custom-taxonomies.php          ← Taxonomy registrations
│   ├── enqueue.php                    ← Script/style enqueue
│   ├── menus.php                      ← Nav menu registration
│   ├── acf-fields.php                 ← ACF field group registration (PHP)
│   ├── ajax-handlers.php              ← WordPress AJAX handlers
│   ├── contact-form-handler.php       ← Form processing logic
│   ├── seo-meta.php                   ← Custom meta tags
│   ├── security.php                   ← Security hardening
│   └── helpers.php                    ← Utility functions
│
├── languages/                         ← Translation files (future-proof)
│   └── pakistan-legal-solutions.pot
│
├── .gitignore
├── README.md
└── screenshot.png                     ← 1200x900px, shown in WP admin
```

---

## 6. WordPress Configuration on Hostinger

### 6.1 Install WordPress on Hostinger

Log in to Hostinger hPanel → Websites → Add Website → WordPress.

Fill in:
```
Website title:    Pakistan Legal Solutions
Admin username:   pakistanlegalsolution_admin   (NOT "admin" — security reason)
Admin password:   Generate a strong password, save it
Admin email:      mubeen@pakistanlegalsolution.com
Language:         English
```

### 6.2 Hostinger WordPress Settings to Change

After WordPress installs, go to WP Admin:

**Settings → General:**
```
Site Title:    Pakistan Legal Solutions
Tagline:       Trusted legal services across Pakistan
Timezone:      Asia/Karachi
Date Format:   F j, Y
```

**Settings → Permalinks:**
Select: Post name → Save. (Makes URLs clean: `/practice-areas/family-law/`)

**Settings → Reading:**
```
Your homepage displays: A static page
Homepage: Home   (create this page first)
Posts page: Blog
```

**Settings → Discussion:**
- Uncheck "Allow people to submit comments" unless you want a blog with comments

### 6.3 Create All Pages in WordPress Admin

Before writing a single theme file, create all the pages so WordPress has them in the database. Go to Pages → Add New:

| Page Title | Slug | Template to assign later |
|---|---|---|
| Home | `/` | Front Page |
| About Us | `/about` | template-about.php |
| Practice Areas | `/practice-areas` | template-practice-areas.php |
| Family Law | `/practice-areas/family-law` | Default (CPT handles this) |
| Tax Law | `/practice-areas/tax-law` | CPT |
| Property Law | `/practice-areas/property-law` | CPT |
| Corporate Law | `/practice-areas/corporate-law` | CPT |
| Labor Law | `/practice-areas/labor-law` | CPT |
| Constitutional Law | `/practice-areas/constitutional-law` | CPT |
| Our Team | `/team` | Default |
| Blog | `/blog` | Default |
| Contact Us | `/contact` | template-contact.php |
| Privacy Policy | `/privacy-policy` | Default |
| Disclaimer | `/disclaimer` | Default |

---

## 7. Theme File-by-File Reference

### 7.1 style.css — Theme Registration

This file registers your theme with WordPress. The comment block at the top is **mandatory** — WordPress reads it to display your theme in Appearance → Themes.

```css
/*
Theme Name:         Pakistan Legal Solutions
Theme URI:          https://pakistanlegalsolution.com
Author:             Mubeen Mehmood
Author URI:         https://mubeenmehmood.com
Description:        Custom professional theme for Pakistan Legal Solutions (Lahore-based; serving clients across Pakistan). Built with modern PHP, semantic HTML5, and vanilla JavaScript.
Version:            1.0.0
Requires at least:  6.4
Tested up to:       6.5
Requires PHP:       8.2
License:            Proprietary
Text Domain:        pakistan-legal-solutions
Tags:               custom-header, custom-menu, featured-images, threaded-comments, translation-ready
*/

/*
  DO NOT put design CSS here.
  WordPress enqueues this file automatically.
  All design CSS lives in assets/css/main.css
  which is enqueued via functions.php.
  
  This file intentionally has no styles.
*/
```

### 7.2 functions.php — Theme Brain

Split your functions.php into includes to keep it clean. The main file just loads everything:

```php
<?php
/**
 * Pakistan Legal Solutions Theme — functions.php
 *
 * This file bootstraps the theme. All logic lives in /inc/ files.
 * Keeping this file minimal makes it easy to find and debug anything.
 *
 * @package PakistanLegalSolutions
 * @version 1.0.0
 * @author  Mubeen Mehmood
 */

// Security: prevent direct file access
defined( 'ABSPATH' ) || exit;

// ─── Constants ────────────────────────────────────────────────────────────────
define( 'PLS_VERSION',    wp_get_theme()->get( 'Version' ) );
define( 'PLS_DIR',        get_template_directory() );
define( 'PLS_URI',        get_template_directory_uri() );
define( 'PLS_ASSETS',     PLS_URI . '/assets' );
define( 'PLS_INC',        PLS_DIR . '/inc' );

// ─── Core Theme Setup ─────────────────────────────────────────────────────────
require_once PLS_INC . '/setup.php';         // add_theme_support, image sizes
require_once PLS_INC . '/menus.php';         // register_nav_menus
require_once PLS_INC . '/enqueue.php';       // wp_enqueue_scripts
require_once PLS_INC . '/helpers.php';       // utility functions

// ─── Content ──────────────────────────────────────────────────────────────────
require_once PLS_INC . '/custom-post-types.php';
require_once PLS_INC . '/custom-taxonomies.php';

// ─── ACF (load only if plugin is active) ─────────────────────────────────────
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once PLS_INC . '/acf-fields.php';
}

// ─── Forms & AJAX ─────────────────────────────────────────────────────────────
require_once PLS_INC . '/contact-form-handler.php';
require_once PLS_INC . '/ajax-handlers.php';

// ─── Security ─────────────────────────────────────────────────────────────────
require_once PLS_INC . '/security.php';

// ─── SEO ──────────────────────────────────────────────────────────────────────
require_once PLS_INC . '/seo-meta.php';
```

**inc/setup.php:**

```php
<?php
/**
 * Theme setup: add_theme_support, image sizes, content width.
 */
defined( 'ABSPATH' ) || exit;

function pls_theme_setup(): void {

    // Let WordPress handle the <title> tag
    add_theme_support( 'title-tag' );

    // Enable featured images
    add_theme_support( 'post-thumbnails' );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => [ 'site-title', 'site-description' ],
    ] );

    // HTML5 markup support
    add_theme_support( 'html5', [
        'comment-list', 'comment-form', 'search-form',
        'gallery', 'caption', 'style', 'script',
    ] );

    // Wide and full alignment support (for Gutenberg blocks if ever used)
    add_theme_support( 'align-wide' );

    // Editor color palette (keeps Gutenberg consistent with theme)
    add_theme_support( 'editor-color-palette', [
        [ 'name' => 'Brand Maroon',  'slug' => 'brand-maroon',  'color' => '#8B1A1A' ],
        [ 'name' => 'Brand Gold',    'slug' => 'brand-gold',    'color' => '#C4962A' ],
        [ 'name' => 'Dark',          'slug' => 'dark',          'color' => '#1A1A1A' ],
        [ 'name' => 'White',         'slug' => 'white',         'color' => '#FFFFFF' ],
    ] );

    // Disable WordPress emoji scripts (reduces page weight)
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Custom image sizes
    add_image_size( 'hero-full',        1920, 1080, true );
    add_image_size( 'hero-mobile',       768,  512, true );
    add_image_size( 'card-landscape',    800,  533, true );
    add_image_size( 'card-portrait',     600,  800, true );
    add_image_size( 'attorney-portrait', 480,  640, true );
    add_image_size( 'thumbnail-square',  400,  400, true );
    add_image_size( 'og-image',         1200,  630, true );

    // Make theme translation-ready
    load_theme_textdomain( 'pakistan-legal-solutions', PLS_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'pls_theme_setup' );

// Content width (WordPress standard)
function pls_content_width(): void {
    $GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'pls_content_width', 0 );
```

**inc/menus.php:**

```php
<?php
defined( 'ABSPATH' ) || exit;

function pls_register_menus(): void {
    register_nav_menus( [
        'primary'    => __( 'Primary Navigation',    'pakistan-legal-solutions' ),
        'footer-1'   => __( 'Footer Column 1',       'pakistan-legal-solutions' ),
        'footer-2'   => __( 'Footer Column 2',       'pakistan-legal-solutions' ),
        'mobile'     => __( 'Mobile Navigation',     'pakistan-legal-solutions' ),
    ] );
}
add_action( 'after_setup_theme', 'pls_register_menus' );
```

**inc/enqueue.php:**

```php
<?php
defined( 'ABSPATH' ) || exit;

function pls_enqueue_scripts(): void {

    // ── Styles ─────────────────────────────────────────────────────────────

    // Google Fonts — loaded from Google CDN
    // For GDPR compliance, self-host instead (see /assets/fonts/)
    wp_enqueue_style(
        'pls-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'pls-main',
        PLS_ASSETS . '/css/main.css',
        [ 'pls-google-fonts' ],
        PLS_VERSION
    );

    // ── Scripts ────────────────────────────────────────────────────────────

    // Deregister jQuery from footer (we use vanilla JS)
    // wp_deregister_script( 'jquery' );
    // Note: Some plugins need jQuery. Deregister carefully.

    // Main JS — loaded in footer, deferred
    wp_enqueue_script(
        'pls-main',
        PLS_ASSETS . '/js/main.js',
        [], // no dependencies
        PLS_VERSION,
        [ 'in_footer' => true, 'strategy' => 'defer' ]
    );

    // Pass PHP data to JavaScript (AJAX URL, nonce, etc.)
    wp_localize_script( 'pls-main', 'plsData', [
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'pls_nonce' ),
        'homeUrl'   => home_url(),
        'themeUrl'  => PLS_URI,
        'isHome'    => is_front_page() ? 'true' : 'false',
    ] );

    // Page-specific scripts (only load where needed)
    if ( is_page_template( 'template-contact.php' ) ) {
        wp_enqueue_script(
            'pls-contact',
            PLS_ASSETS . '/js/modules/contact-form.js',
            [ 'pls-main' ],
            PLS_VERSION,
            [ 'in_footer' => true, 'strategy' => 'defer' ]
        );
    }
}
add_action( 'wp_enqueue_scripts', 'pls_enqueue_scripts' );

// Remove Gutenberg block styles (we don't use them)
function pls_dequeue_block_styles(): void {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'pls_dequeue_block_styles', 100 );
```

**inc/helpers.php:**

```php
<?php
defined( 'ABSPATH' ) || exit;

/**
 * Get template part with data passed as variables.
 * Usage: pls_get_part( 'components/attorney-card', [ 'post_id' => 5 ] );
 */
function pls_get_part( string $part, array $data = [] ): void {
    if ( $data ) {
        // Extract variables so template can use $variable_name directly
        extract( $data, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract
    }
    get_template_part( 'template-parts/' . $part );
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
                    <a href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">
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
```

### 7.3 header.php

```php
<?php
/**
 * Site Header
 * Used on every page via get_header().
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php // Preconnect to Google Fonts for faster load ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php // Favicons — generate all sizes at realfavicongenerator.net ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/site.webmanifest">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">
    <?php esc_html_e( 'Skip to main content', 'pakistan-legal-solutions' ); ?>
</a>

<header class="site-header" id="site-header" role="banner">
    <div class="site-header__inner container">

        <?php // Logo ?>
        <div class="site-header__logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-text" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php // Primary Navigation — outputs from template part ?>
        <?php get_template_part( 'template-parts/header/navigation' ); ?>

        <?php // CTA Button ?>
        <div class="site-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
               class="btn btn--primary btn--sm"
               aria-label="<?php esc_attr_e( 'Book a consultation', 'pakistan-legal-solutions' ); ?>">
                <?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>

        <?php // Mobile menu toggle ?>
        <button class="mobile-menu-toggle"
                id="mobile-menu-toggle"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="<?php esc_attr_e( 'Open menu', 'pakistan-legal-solutions' ); ?>">
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
        </button>

    </div><!-- .site-header__inner -->

    <?php // Mobile menu ?>
    <?php get_template_part( 'template-parts/header/mobile-menu' ); ?>

</header><!-- .site-header -->
```

**template-parts/header/navigation.php:**

```php
<?php
/**
 * Primary navigation.
 * Uses Walker_Nav_Menu for full control over the markup.
 */
defined( 'ABSPATH' ) || exit;
?>
<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'pakistan-legal-solutions' ); ?>">
    <?php
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'menu_id'         => 'primary-menu',
        'menu_class'      => 'primary-nav__list',
        'container'       => false,
        'depth'           => 2,
        'fallback_cb'     => false,
        'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
    ] );
    ?>
</nav>
```

**template-parts/header/mobile-menu.php:**

```php
<?php
/**
 * Mobile navigation drawer.
 * Toggled by JavaScript in assets/js/modules/navigation.js
 */
defined( 'ABSPATH' ) || exit;
?>
<div class="mobile-menu" id="mobile-menu" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Mobile menu', 'pakistan-legal-solutions' ); ?>">
    <div class="mobile-menu__inner">

        <button class="mobile-menu__close"
                id="mobile-menu-close"
                aria-label="<?php esc_attr_e( 'Close menu', 'pakistan-legal-solutions' ); ?>">
            &times;
        </button>

        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu__list',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => false,
        ] );
        ?>

        <div class="mobile-menu__contact">
            <a href="tel:+924235710000" class="mobile-menu__phone">
                +92 42 3571 0000
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--primary btn--full">
                <?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>

    </div><!-- .mobile-menu__inner -->
</div><!-- .mobile-menu -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true"></div>
```

### 7.4 footer.php

```php
<?php
/**
 * Site Footer
 */
?>

<footer class="site-footer" id="site-footer" role="contentinfo">

    <div class="site-footer__main">
        <div class="container">
            <div class="site-footer__grid">

                <?php // Column 1: Firm info ?>
                <div class="site-footer__col site-footer__col--brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                        <img src="<?php echo esc_url( PLS_ASSETS ); ?>/images/logo-white.svg"
                             alt="<?php bloginfo( 'name' ); ?>"
                             width="200" height="60" loading="lazy">
                    </a>
                    <p class="site-footer__tagline">
                        <?php esc_html_e( 'Trusted legal guidance for clients across Pakistan. Your rights, our commitment.', 'pakistan-legal-solutions' ); ?>
                    </p>
                    <div class="site-footer__social">
                        <a href="https://facebook.com/pakistanlegalsolution" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <?php echo pls_icon( 'facebook' ); ?>
                        </a>
                        <a href="https://linkedin.com/company/pakistanlegalsolution" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <?php echo pls_icon( 'linkedin' ); ?>
                        </a>
                        <a href="https://wa.me/923001234567" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            <?php echo pls_icon( 'whatsapp' ); ?>
                        </a>
                    </div>
                </div>

                <?php // Column 2: Quick Links ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Quick Links', 'pakistan-legal-solutions' ); ?></h3>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'footer-1',
                        'menu_class'     => 'site-footer__nav',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ] );
                    ?>
                </div>

                <?php // Column 3: Practice Areas ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?></h3>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'footer-2',
                        'menu_class'     => 'site-footer__nav',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ] );
                    ?>
                </div>

                <?php // Column 4: Contact info ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Contact Us', 'pakistan-legal-solutions' ); ?></h3>
                    <address class="site-footer__address">
                        <p>
                            <?php echo pls_icon( 'map-pin' ); ?>
                            2nd Floor, Commerce Centre<br>
                            MM Alam Road, Gulberg III<br>
                            Lahore 54660, Pakistan
                        </p>
                        <p>
                            <?php echo pls_icon( 'phone' ); ?>
                            <a href="tel:+924235710000">+92 42 3571 0000</a>
                        </p>
                        <p>
                            <?php echo pls_icon( 'mail' ); ?>
                            <a href="mailto:info@pakistanlegalsolution.com">info@pakistanlegalsolution.com</a>
                        </p>
                        <p>
                            <?php echo pls_icon( 'clock' ); ?>
                            Sat–Thu: 9am – 6pm PKT
                        </p>
                    </address>
                </div>

            </div><!-- .site-footer__grid -->
        </div><!-- .container -->
    </div><!-- .site-footer__main -->

    <div class="site-footer__bottom">
        <div class="container">
            <p class="site-footer__copy">
                &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'pakistan-legal-solutions' ); ?>
            </p>
            <nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal links', 'pakistan-legal-solutions' ); ?>">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">
                    <?php esc_html_e( 'Privacy Policy', 'pakistan-legal-solutions' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>">
                    <?php esc_html_e( 'Disclaimer', 'pakistan-legal-solutions' ); ?>
                </a>
            </nav>
        </div>
    </div><!-- .site-footer__bottom -->

</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
```

### 7.5 front-page.php — Homepage

```php
<?php
/**
 * Homepage Template
 * WordPress uses this when Settings → Reading → Homepage is set to a static page.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php get_template_part( 'template-parts/home/hero' ); ?>
    <?php get_template_part( 'template-parts/home/trust-bar' ); ?>
    <?php get_template_part( 'template-parts/home/practice-areas' ); ?>
    <?php get_template_part( 'template-parts/home/why-choose-us' ); ?>
    <?php get_template_part( 'template-parts/home/attorneys' ); ?>
    <?php get_template_part( 'template-parts/home/testimonials' ); ?>
    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>
    <?php get_template_part( 'template-parts/home/contact-strip' ); ?>

</main>

<?php get_footer(); ?>
```

**template-parts/home/hero.php:**

```php
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
                    <span class="hero__stat-number">15+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Years Experience', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">500+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Cases Won', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">6</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">100%</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Client First', 'pakistan-legal-solutions' ); ?></span>
                </div>
            </div>

        </div><!-- .hero__text -->
    </div><!-- .hero__content -->

</section><!-- .hero -->
```

### 7.6 page.php — Static Pages

```php
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
```

### 7.7 single.php — Blog Posts

```php
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
```

### 7.8 archive.php

```php
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
```

### 7.9 404.php

```php
<?php
/**
 * 404 Page Not Found
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">
    <section class="error-404 container">
        <div class="error-404__content">
            <p class="error-404__code" aria-hidden="true">404</p>
            <h1 class="error-404__heading">
                <?php esc_html_e( 'Page Not Found', 'pakistan-legal-solutions' ); ?>
            </h1>
            <p class="error-404__message">
                <?php esc_html_e( "Sorry, the page you're looking for doesn't exist or has been moved.", 'pakistan-legal-solutions' ); ?>
            </p>
            <div class="error-404__actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                    <?php esc_html_e( 'Return to Homepage', 'pakistan-legal-solutions' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--outline">
                    <?php esc_html_e( 'Contact Us', 'pakistan-legal-solutions' ); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
```

### 7.10 template-contact.php

```php
<?php
/**
 * Template Name: Contact Page
 * Registers this file as a selectable template in WP Admin → Page → Template.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'Contact Us', 'pakistan-legal-solutions' ),
        __( 'Schedule a free consultation with our legal team', 'pakistan-legal-solutions' )
    ); ?>

    <section class="contact-section">
        <div class="container">
            <div class="contact-layout">

                <?php // Left: Form ?>
                <div class="contact-layout__form">
                    <h2 class="contact-layout__heading">
                        <?php esc_html_e( 'Send Us a Message', 'pakistan-legal-solutions' ); ?>
                    </h2>
                    <?php get_template_part( 'template-parts/forms/contact-form' ); ?>
                </div>

                <?php // Right: Info ?>
                <div class="contact-layout__info">
                    <h2 class="contact-layout__heading">
                        <?php esc_html_e( 'Our Office', 'pakistan-legal-solutions' ); ?>
                    </h2>

                    <div class="contact-info">
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'map-pin' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Address', 'pakistan-legal-solutions' ); ?></strong>
                                <p>2nd Floor, Commerce Centre<br>MM Alam Road, Gulberg III<br>Lahore 54660, Pakistan</p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'phone' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Phone', 'pakistan-legal-solutions' ); ?></strong>
                                <p><a href="tel:+924235710000">+92 42 3571 0000</a></p>
                                <p><a href="https://wa.me/923001234567">WhatsApp: +92 300 123 4567</a></p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'mail' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Email', 'pakistan-legal-solutions' ); ?></strong>
                                <p><a href="mailto:info@pakistanlegalsolution.com">info@pakistanlegalsolution.com</a></p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'clock' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Office Hours', 'pakistan-legal-solutions' ); ?></strong>
                                <p>Saturday – Thursday: 9am – 6pm<br>Friday: Closed (Jumu'ah)</p>
                            </div>
                        </div>
                    </div>

                    <?php // Google Maps Embed ?>
                    <div class="contact-map">
                        <iframe
                            title="<?php esc_attr_e( 'Pakistan Legal Solutions — office location', 'pakistan-legal-solutions' ); ?>"
                            src="https://www.google.com/maps/embed?pb=REPLACE_WITH_YOUR_EMBED_URL"
                            width="100%"
                            height="280"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div><!-- .contact-layout__info -->

            </div><!-- .contact-layout -->
        </div><!-- .container -->
    </section>

</main>

<?php get_footer(); ?>
```

**template-parts/forms/contact-form.php:**

```php
<?php
/**
 * Contact Form HTML
 * Submission handled by inc/contact-form-handler.php via WordPress AJAX.
 */
defined( 'ABSPATH' ) || exit;

// Show success/error messages after non-JS form submit
$form_sent  = isset( $_GET['sent'] )  && '1' === $_GET['sent'];
$form_error = isset( $_GET['error'] ) && '1' === $_GET['error'];
?>

<?php if ( $form_sent ) : ?>
    <div class="form-notice form-notice--success" role="alert">
        <strong><?php esc_html_e( 'Thank you!', 'pakistan-legal-solutions' ); ?></strong>
        <?php esc_html_e( 'Your message has been received. We will contact you within 24 hours.', 'pakistan-legal-solutions' ); ?>
    </div>
<?php endif; ?>

<?php if ( $form_error ) : ?>
    <div class="form-notice form-notice--error" role="alert">
        <?php esc_html_e( 'Something went wrong. Please try again or call us directly.', 'pakistan-legal-solutions' ); ?>
    </div>
<?php endif; ?>

<form
    class="contact-form"
    id="contact-form"
    action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
    method="POST"
    novalidate>

    <?php // Security nonces — ALWAYS include these ?>
    <input type="hidden" name="action" value="pls_contact_form">
    <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'pls_contact_form' ) ); ?>">

    <?php // Honeypot field — spam bots fill this in, humans don't ?>
    <div class="form-honeypot" aria-hidden="true" style="display:none;">
        <label for="website">Leave this empty</label>
        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
    </div>

    <div class="form-grid">

        <div class="form-field">
            <label for="cf-name" class="form-label">
                <?php esc_html_e( 'Full Name', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="text"
                   id="cf-name"
                   name="name"
                   class="form-input"
                   required
                   autocomplete="name"
                   placeholder="<?php esc_attr_e( 'Ahmad Ali Khan', 'pakistan-legal-solutions' ); ?>">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-email" class="form-label">
                <?php esc_html_e( 'Email Address', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="email"
                   id="cf-email"
                   name="email"
                   class="form-input"
                   required
                   autocomplete="email"
                   placeholder="ahmad@example.com">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-phone" class="form-label">
                <?php esc_html_e( 'Phone Number', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="tel"
                   id="cf-phone"
                   name="phone"
                   class="form-input"
                   required
                   autocomplete="tel"
                   placeholder="+92 300 000 0000">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-practice-area" class="form-label">
                <?php esc_html_e( 'Practice Area', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <select id="cf-practice-area" name="practice_area" class="form-select" required>
                <option value=""><?php esc_html_e( 'Select a practice area', 'pakistan-legal-solutions' ); ?></option>
                <option value="family-law"><?php esc_html_e( 'Family Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="tax-law"><?php esc_html_e( 'Tax Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="property-law"><?php esc_html_e( 'Property Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="corporate-law"><?php esc_html_e( 'Corporate Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="labor-law"><?php esc_html_e( 'Labor Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="constitutional-law"><?php esc_html_e( 'Constitutional Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="other"><?php esc_html_e( 'Other / General Inquiry', 'pakistan-legal-solutions' ); ?></option>
            </select>
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field form-field--full">
            <label for="cf-message" class="form-label">
                <?php esc_html_e( 'Brief Description of Your Matter', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <textarea id="cf-message"
                      name="message"
                      class="form-textarea"
                      required
                      rows="5"
                      placeholder="<?php esc_attr_e( 'Please describe your legal matter briefly...', 'pakistan-legal-solutions' ); ?>"></textarea>
            <span class="form-error" role="alert"></span>
        </div>

    </div><!-- .form-grid -->

    <div class="form-footer">
        <button type="submit" class="btn btn--primary btn--lg" id="cf-submit">
            <span class="btn-text"><?php esc_html_e( 'Send My Inquiry', 'pakistan-legal-solutions' ); ?></span>
            <span class="btn-loading" aria-hidden="true" style="display:none;">
                <?php esc_html_e( 'Sending...', 'pakistan-legal-solutions' ); ?>
            </span>
        </button>
        <p class="form-privacy">
            <?php esc_html_e( 'Your information is confidential and protected by attorney-client privilege.', 'pakistan-legal-solutions' ); ?>
        </p>
    </div>

    <div class="form-response" id="form-response" role="alert" aria-live="polite"></div>

</form>
```

### 7.11 template-about.php

```php
<?php
/**
 * Template Name: About Page
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'About Our Firm', 'pakistan-legal-solutions' ),
        __( 'Trusted legal advisors serving clients across Pakistan', 'pakistan-legal-solutions' )
    ); ?>

    <?php // Firm Story Section ?>
    <section class="about-story">
        <div class="container">
            <div class="about-story__grid">
                <div class="about-story__content">
                    <h2><?php esc_html_e( 'Our Story', 'pakistan-legal-solutions' ); ?></h2>
                    <?php the_content(); // Client edits this in WP admin ?>
                </div>
                <div class="about-story__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'lazy', 'alt' => __( 'Pakistan Legal Solutions team and office', 'pakistan-legal-solutions' ) ] ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php // Values Section ?>
    <section class="about-values">
        <div class="container">
            <h2 class="section-title section-title--centered">
                <?php esc_html_e( 'Our Core Values', 'pakistan-legal-solutions' ); ?>
            </h2>
            <div class="values-grid">
                <?php
                $values = [
                    [ 'icon' => 'users',     'title' => __( 'Client First',    'pakistan-legal-solutions' ), 'desc' => __( 'Every decision we make is guided by what is best for our client. Period.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'eye',       'title' => __( 'Transparency',    'pakistan-legal-solutions' ), 'desc' => __( 'No hidden fees. No legal jargon. Clear communication at every step.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'award',     'title' => __( 'Excellence',      'pakistan-legal-solutions' ), 'desc' => __( 'We hold ourselves to the highest standards of legal practice and professionalism.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'shield',    'title' => __( 'Integrity',       'pakistan-legal-solutions' ), 'desc' => __( 'We do what is right, even when it is difficult. Ethical practice is non-negotiable.', 'pakistan-legal-solutions' ) ],
                ];
                foreach ( $values as $value ) : ?>
                    <div class="value-card">
                        <?php echo pls_icon( esc_attr( $value['icon'] ) ); ?>
                        <h3><?php echo esc_html( $value['title'] ); ?></h3>
                        <p><?php echo esc_html( $value['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php // Team Section ?>
    <section class="about-team">
        <div class="container">
            <h2 class="section-title section-title--centered">
                <?php esc_html_e( 'Meet Our Partners', 'pakistan-legal-solutions' ); ?>
            </h2>
            <?php
            $team = new WP_Query( [
                'post_type'      => 'team_member',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ] );
            if ( $team->have_posts() ) : ?>
                <div class="team-grid team-grid--full">
                    <?php while ( $team->have_posts() ) : $team->the_post();
                        get_template_part( 'template-parts/components/attorney-card', null, [
                            'post_id' => get_the_ID(),
                            'size'    => 'large',
                        ] );
                    endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>

</main>

<?php get_footer(); ?>
```

### 7.12 single-practice_area.php

```php
<?php
/**
 * Single Practice Area Template
 * WordPress uses this automatically for practice_area post type.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php pls_page_hero(
            get_the_title(),
            pls_field( 'pa_subtitle', get_the_ID(), __( 'Expert legal representation in Pakistan', 'pakistan-legal-solutions' ) )
        ); ?>

        <section class="pa-content">
            <div class="container">
                <div class="pa-layout">

                    <div class="pa-main">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="pa-main__image">
                                <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'eager', 'alt' => get_the_title() ] ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="pa-main__content entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php // ACF: Key services list ?>
                        <?php
                        $services = get_field( 'pa_key_services' );
                        if ( $services ) : ?>
                            <div class="pa-services">
                                <h3><?php esc_html_e( 'Our Services Include', 'pakistan-legal-solutions' ); ?></h3>
                                <ul class="pa-services__list">
                                    <?php foreach ( $services as $service ) : ?>
                                        <li>
                                            <?php echo pls_icon( 'check' ); ?>
                                            <?php echo esc_html( $service['service_name'] ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div><!-- .pa-main -->

                    <aside class="pa-sidebar">
                        <?php // Other practice areas ?>
                        <div class="pa-sidebar__widget">
                            <h3><?php esc_html_e( 'Other Practice Areas', 'pakistan-legal-solutions' ); ?></h3>
                            <?php
                            $other = new WP_Query( [
                                'post_type'      => 'practice_area',
                                'posts_per_page' => -1,
                                'post__not_in'   => [ get_the_ID() ],
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                            ] );
                            if ( $other->have_posts() ) : ?>
                                <ul class="pa-sidebar__list">
                                    <?php while ( $other->have_posts() ) : $other->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo pls_icon( 'chevron-right' ); ?>
                                                <?php the_title(); ?>
                                            </a>
                                        </li>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <?php // Consultation CTA ?>
                        <div class="pa-sidebar__cta">
                            <h3><?php esc_html_e( 'Need Legal Help?', 'pakistan-legal-solutions' ); ?></h3>
                            <p><?php esc_html_e( 'Talk to one of our attorneys today. First consultation is free.', 'pakistan-legal-solutions' ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--primary btn--full">
                                <?php esc_html_e( 'Book Free Consultation', 'pakistan-legal-solutions' ); ?>
                            </a>
                            <a href="tel:+924235710000" class="btn btn--outline btn--full" style="margin-top: 10px;">
                                +92 42 3571 0000
                            </a>
                        </div>
                    </aside>

                </div><!-- .pa-layout -->
            </div><!-- .container -->
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
```

### 7.13 archive-practice_area.php

```php
<?php
/**
 * Practice Areas Archive
 * Accessible at: /practice-areas/
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'Our Practice Areas', 'pakistan-legal-solutions' ),
        __( 'Expert legal services across all major areas of Pakistani law', 'pakistan-legal-solutions' )
    ); ?>

    <section class="pa-archive">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="pa-grid">
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/components/practice-card' );
                    endwhile; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'No practice areas found.', 'pakistan-legal-solutions' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>

</main>

<?php get_footer(); ?>
```

---

## 8. CSS Architecture

### 8.1 CSS Custom Properties (assets/css/base/_variables.css)

```css
:root {
    /* ── Brand Colors ─────────────────────────────────────── */
    --color-brand-primary:     #8B1A1A;   /* Deep maroon */
    --color-brand-primary-dark:#5C1010;   /* Hover state */
    --color-brand-gold:        #C4962A;   /* Gold accent */
    --color-brand-gold-dark:   #A07820;   /* Gold hover */

    /* ── Text Colors ──────────────────────────────────────── */
    --color-text-primary:      #1A1A1A;
    --color-text-secondary:    #444444;
    --color-text-muted:        #777777;
    --color-text-inverse:      #FFFFFF;

    /* ── Background Colors ────────────────────────────────── */
    --color-bg-white:          #FFFFFF;
    --color-bg-cream:          #F8F5F0;
    --color-bg-light:          #F2EDE8;
    --color-bg-dark:           #1A1A1A;
    --color-bg-darker:         #111111;

    /* ── Border Colors ────────────────────────────────────── */
    --color-border-light:      #E8E0D8;
    --color-border-medium:     #D4C8BC;
    --color-border-dark:       #8B7355;

    /* ── Semantic Colors ──────────────────────────────────── */
    --color-success:           #2D7A2D;
    --color-error:             #C0392B;
    --color-warning:           #E67E22;

    /* ── Typography ───────────────────────────────────────── */
    --font-heading:      'Playfair Display', Georgia, 'Times New Roman', serif;
    --font-body:         'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    --font-mono:         'Courier New', Courier, monospace;

    /* Type scale (Major Third: 1.25 ratio) */
    --text-xs:    0.64rem;   /* 10px */
    --text-sm:    0.8rem;    /* 13px */
    --text-base:  1rem;      /* 16px */
    --text-lg:    1.25rem;   /* 20px */
    --text-xl:    1.563rem;  /* 25px */
    --text-2xl:   1.953rem;  /* 31px */
    --text-3xl:   2.441rem;  /* 39px */
    --text-4xl:   3.052rem;  /* 49px */
    --text-5xl:   3.815rem;  /* 61px */
    --text-hero:  clamp(2.5rem, 5vw, 4.5rem);  /* Fluid hero size */

    /* ── Spacing ──────────────────────────────────────────── */
    /* 8px base unit — all spacing is a multiple of 8 */
    --space-1:    0.25rem;   /* 4px */
    --space-2:    0.5rem;    /* 8px */
    --space-3:    0.75rem;   /* 12px */
    --space-4:    1rem;      /* 16px */
    --space-5:    1.25rem;   /* 20px */
    --space-6:    1.5rem;    /* 24px */
    --space-8:    2rem;      /* 32px */
    --space-10:   2.5rem;    /* 40px */
    --space-12:   3rem;      /* 48px */
    --space-16:   4rem;      /* 64px */
    --space-20:   5rem;      /* 80px */
    --space-24:   6rem;      /* 96px */
    --space-32:   8rem;      /* 128px */

    /* ── Layout ───────────────────────────────────────────── */
    --container-max:      1200px;
    --container-padding:  clamp(1rem, 5vw, 2rem);

    /* ── Borders & Radius ─────────────────────────────────── */
    --radius-sm:    2px;
    --radius-md:    4px;
    --radius-lg:    8px;
    --radius-xl:    16px;
    --radius-full:  9999px;

    /* ── Shadows ──────────────────────────────────────────── */
    --shadow-sm:    0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-md:    0 4px 16px rgba(0, 0, 0, 0.10);
    --shadow-lg:    0 8px 32px rgba(0, 0, 0, 0.12);
    --shadow-xl:    0 16px 48px rgba(0, 0, 0, 0.15);

    /* ── Transitions ──────────────────────────────────────── */
    --transition-fast:    150ms ease;
    --transition-base:    250ms ease;
    --transition-slow:    400ms ease;

    /* ── Z-Index Stack ────────────────────────────────────── */
    --z-below:      -1;
    --z-base:        0;
    --z-dropdown:   100;
    --z-sticky:     200;
    --z-overlay:    300;
    --z-modal:      400;
    --z-toast:      500;
}
```

### 8.2 Modern CSS Reset (assets/css/base/_reset.css)

```css
/* Modern CSS Reset — Eric Meyer + Josh Comeau inspired */
*, *::before, *::after {
    box-sizing: border-box;
}

* {
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
    -webkit-text-size-adjust: 100%;
    hanging-punctuation: first last;
}

body {
    min-height: 100dvh;
    font-family: var(--font-body);
    font-size: var(--text-base);
    line-height: 1.6;
    color: var(--color-text-primary);
    background-color: var(--color-bg-white);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

img, picture, video, canvas, svg {
    display: block;
    max-width: 100%;
}

input, button, textarea, select {
    font: inherit;
}

p, h1, h2, h3, h4, h5, h6 {
    overflow-wrap: break-word;
}

h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-heading);
    line-height: 1.2;
    color: var(--color-text-primary);
}

a {
    color: inherit;
    text-decoration: none;
}

ul, ol {
    list-style: none;
}

button {
    cursor: pointer;
    background: none;
    border: none;
}

address {
    font-style: normal;
}

/* Skip link for accessibility */
.skip-link {
    position: absolute;
    top: -100%;
    left: 1rem;
    padding: 0.5rem 1rem;
    background: var(--color-brand-primary);
    color: var(--color-text-inverse);
    font-size: var(--text-sm);
    font-weight: 600;
    z-index: var(--z-toast);
    border-radius: 0 0 var(--radius-md) var(--radius-md);
    transition: top var(--transition-fast);
}

.skip-link:focus {
    top: 0;
}

/* Focus styles — visible for keyboard users */
:focus-visible {
    outline: 2px solid var(--color-brand-primary);
    outline-offset: 2px;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}
```

### 8.3 Layout System (assets/css/layout/_grid.css)

```css
/* Container */
.container {
    width: 100%;
    max-width: var(--container-max);
    margin-inline: auto;
    padding-inline: var(--container-padding);
}

.container--narrow {
    max-width: 800px;
}

.container--wide {
    max-width: 1400px;
}

/* Section spacing — consistent rhythm across all pages */
.section {
    padding-block: var(--space-20);
}

.section--sm {
    padding-block: var(--space-12);
}

.section--lg {
    padding-block: var(--space-32);
}

/* BEM grid utilities */
.grid {
    display: grid;
    gap: var(--space-8);
}

.grid--2 { grid-template-columns: repeat(2, 1fr); }
.grid--3 { grid-template-columns: repeat(3, 1fr); }
.grid--4 { grid-template-columns: repeat(4, 1fr); }

.grid--auto {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

@media (max-width: 768px) {
    .grid--2,
    .grid--3,
    .grid--4 {
        grid-template-columns: 1fr;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .grid--3,
    .grid--4 {
        grid-template-columns: repeat(2, 1fr);
    }
}
```

### 8.4 Button Component (assets/css/components/_buttons.css)

```css
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    padding: 0.75rem 1.75rem;
    font-family: var(--font-body);
    font-size: var(--text-base);
    font-weight: 600;
    line-height: 1;
    text-align: center;
    border: 2px solid transparent;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all var(--transition-base);
    white-space: nowrap;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.btn:focus-visible {
    outline: 2px solid var(--color-brand-primary);
    outline-offset: 3px;
}

/* Primary: Maroon */
.btn--primary {
    background-color: var(--color-brand-primary);
    color: var(--color-text-inverse);
    border-color: var(--color-brand-primary);
}

.btn--primary:hover,
.btn--primary:focus-visible {
    background-color: var(--color-brand-primary-dark);
    border-color: var(--color-brand-primary-dark);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Gold: For CTA sections */
.btn--gold {
    background-color: var(--color-brand-gold);
    color: var(--color-bg-dark);
    border-color: var(--color-brand-gold);
}

.btn--gold:hover {
    background-color: var(--color-brand-gold-dark);
    border-color: var(--color-brand-gold-dark);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Outline: Secondary action */
.btn--outline {
    background-color: transparent;
    color: var(--color-brand-primary);
    border-color: var(--color-brand-primary);
}

.btn--outline:hover {
    background-color: var(--color-brand-primary);
    color: var(--color-text-inverse);
}

/* White outline: on dark backgrounds */
.btn--outline-white {
    background-color: transparent;
    color: var(--color-text-inverse);
    border-color: rgba(255, 255, 255, 0.6);
}

.btn--outline-white:hover {
    background-color: var(--color-text-inverse);
    color: var(--color-text-primary);
    border-color: var(--color-text-inverse);
}

/* Sizes */
.btn--sm  { padding: 0.5rem 1.25rem; font-size: var(--text-sm); }
.btn--lg  { padding: 1rem 2.25rem;   font-size: var(--text-lg); }
.btn--full { width: 100%; }
```

---

## 9. JavaScript Architecture

### 9.1 main.js — Entry Point

```javascript
/**
 * Pakistan Legal Solutions theme — main JavaScript
 * Imports and initializes all modules.
 * 
 * Uses vanilla ES6+. No jQuery. No build step required.
 * This file is loaded deferred in the footer via wp_enqueue_script.
 */

import { initNavigation } from './modules/navigation.js';
import { initAnimations } from './modules/animations.js';
import { initSmoothScroll } from './modules/smooth-scroll.js';

document.addEventListener( 'DOMContentLoaded', () => {
    initNavigation();
    initAnimations();
    initSmoothScroll();
} );
```

`main.js` uses `import`; WordPress will not add `type="module"` by default. Register it in `inc/enqueue.php` (after `wp_enqueue_script` for `pls-main`):

```php
add_filter( 'script_loader_tag', static function ( string $tag, string $handle ): string {
    if ( in_array( $handle, [ 'pls-main', 'pls-contact' ], true ) ) {
        return str_replace( '<script ', '<script type="module" ', $tag, 1 );
    }
    return $tag;
}, 10, 2 );
```

### 9.2 modules/navigation.js

```javascript
/**
 * Navigation Module
 * - Sticky header on scroll
 * - Mobile menu open/close
 * - Keyboard accessibility (Escape to close)
 * - Body scroll lock when mobile menu is open
 */

export function initNavigation() {

    const header     = document.getElementById( 'site-header' );
    const toggle     = document.getElementById( 'mobile-menu-toggle' );
    const menu       = document.getElementById( 'mobile-menu' );
    const closeBtn   = document.getElementById( 'mobile-menu-close' );
    const overlay    = document.getElementById( 'mobile-menu-overlay' );

    if ( ! header ) return;

    // ── Sticky header ──────────────────────────────────────────────────────
    const stickyObserver = new IntersectionObserver(
        ( [ entry ] ) => {
            header.classList.toggle( 'site-header--scrolled', ! entry.isIntersecting );
        },
        { rootMargin: `-${ header.offsetHeight }px 0px 0px 0px` }
    );

    // Observe a sentinel element at the top of the page
    const sentinel = document.createElement( 'div' );
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
    document.body.prepend( sentinel );
    stickyObserver.observe( sentinel );

    // ── Mobile menu ────────────────────────────────────────────────────────
    if ( ! toggle || ! menu ) return;

    function openMenu() {
        menu.classList.add( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'false' );
        toggle.setAttribute( 'aria-expanded', 'true' );
        overlay.classList.add( 'is-visible' );
        document.body.style.overflow = 'hidden'; // Lock scroll
        closeBtn?.focus();
    }

    function closeMenu() {
        menu.classList.remove( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'true' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        overlay.classList.remove( 'is-visible' );
        document.body.style.overflow = '';
        toggle.focus();
    }

    toggle.addEventListener( 'click', openMenu );
    closeBtn?.addEventListener( 'click', closeMenu );
    overlay?.addEventListener( 'click', closeMenu );

    // Close on Escape key
    document.addEventListener( 'keydown', ( e ) => {
        if ( e.key === 'Escape' && menu.classList.contains( 'is-open' ) ) {
            closeMenu();
        }
    } );
}
```

### 9.3 modules/animations.js

```javascript
/**
 * Scroll Animations Module
 * Uses IntersectionObserver — no libraries needed.
 * Respects prefers-reduced-motion.
 */

export function initAnimations() {

    // Respect user's motion preference
    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if ( prefersReducedMotion ) return;

    const animatedElements = document.querySelectorAll( '[data-animate]' );

    if ( ! animatedElements.length ) return;

    const observer = new IntersectionObserver(
        ( entries ) => {
            entries.forEach( ( entry ) => {
                if ( entry.isIntersecting ) {
                    entry.target.classList.add( 'is-animated' );
                    // Unobserve after animation fires (performance)
                    observer.unobserve( entry.target );
                }
            } );
        },
        {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px',
        }
    );

    animatedElements.forEach( ( el ) => observer.observe( el ) );
}

// Usage in PHP templates: add data-animate="fade-up" to any element.
// CSS handles the actual animation via .is-animated class.
```

### 9.4 modules/contact-form.js

```javascript
/**
 * Contact Form Module
 * - Client-side validation
 * - AJAX submission (no page reload)
 * - Success/error states
 * - Loading state on button
 */

export function initContactForm() {

    const form     = document.getElementById( 'contact-form' );
    const submit   = document.getElementById( 'cf-submit' );
    const response = document.getElementById( 'form-response' );

    if ( ! form ) return;

    // ── Validation ─────────────────────────────────────────────────────────
    const validators = {
        name:          ( v ) => v.trim().length >= 2,
        email:         ( v ) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( v ),
        phone:         ( v ) => /^[\d\s\+\-\(\)]{7,15}$/.test( v.trim() ),
        practice_area: ( v ) => v !== '',
        message:       ( v ) => v.trim().length >= 10,
    };

    const errorMessages = {
        name:          'Please enter your full name.',
        email:         'Please enter a valid email address.',
        phone:         'Please enter a valid phone number.',
        practice_area: 'Please select a practice area.',
        message:       'Please describe your matter (at least 10 characters).',
    };

    function validateField( input ) {
        const name    = input.name;
        const value   = input.value;
        const isValid = validators[ name ] ? validators[ name ]( value ) : true;
        const errorEl = input.closest( '.form-field' )?.querySelector( '.form-error' );

        input.classList.toggle( 'is-invalid', ! isValid );
        input.classList.toggle( 'is-valid', isValid );

        if ( errorEl ) {
            errorEl.textContent = isValid ? '' : ( errorMessages[ name ] || 'This field is required.' );
        }

        return isValid;
    }

    // Validate on blur (user leaves field)
    form.querySelectorAll( 'input, select, textarea' ).forEach( ( input ) => {
        input.addEventListener( 'blur', () => validateField( input ) );
    } );

    // ── Submission ─────────────────────────────────────────────────────────
    form.addEventListener( 'submit', async ( e ) => {
        e.preventDefault();

        // Validate all fields
        const inputs    = form.querySelectorAll( 'input:not([type="hidden"]):not([name="website"]), select, textarea' );
        const allValid  = [ ...inputs ].map( validateField ).every( Boolean );

        if ( ! allValid ) {
            // Focus first invalid field
            form.querySelector( '.is-invalid' )?.focus();
            return;
        }

        // Set loading state
        submit.disabled = true;
        submit.querySelector( '.btn-text' ).style.display    = 'none';
        submit.querySelector( '.btn-loading' ).style.display = 'inline';
        response.textContent = '';
        response.className   = 'form-response';

        try {
            const formData = new FormData( form );
            const res      = await fetch( form.action, {
                method: 'POST',
                body:   formData,
            } );

            const data = await res.json();

            if ( data.success ) {
                response.textContent = data.data.message || 'Thank you! We will be in touch within 24 hours.';
                response.classList.add( 'form-response--success' );
                form.reset();
                form.querySelectorAll( '.is-valid' ).forEach( ( el ) => el.classList.remove( 'is-valid' ) );
            } else {
                throw new Error( data.data?.message || 'Submission failed.' );
            }

        } catch ( err ) {
            response.textContent = err.message || 'Something went wrong. Please call us directly.';
            response.classList.add( 'form-response--error' );
        } finally {
            submit.disabled = false;
            submit.querySelector( '.btn-text' ).style.display    = 'inline';
            submit.querySelector( '.btn-loading' ).style.display = 'none';
            response.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
        }
    } );
}

document.addEventListener( 'DOMContentLoaded', initContactForm );
```

---

## 10. Custom Post Types Reference

**inc/custom-post-types.php:**

```php
<?php
defined( 'ABSPATH' ) || exit;

function pls_register_post_types(): void {

    // ── Practice Areas ─────────────────────────────────────────────────────
    register_post_type( 'practice_area', [
        'labels' => [
            'name'               => __( 'Practice Areas',       'pakistan-legal-solutions' ),
            'singular_name'      => __( 'Practice Area',        'pakistan-legal-solutions' ),
            'add_new_item'       => __( 'Add Practice Area',    'pakistan-legal-solutions' ),
            'edit_item'          => __( 'Edit Practice Area',   'pakistan-legal-solutions' ),
            'view_item'          => __( 'View Practice Area',   'pakistan-legal-solutions' ),
            'all_items'          => __( 'All Practice Areas',   'pakistan-legal-solutions' ),
            'search_items'       => __( 'Search Practice Areas','pakistan-legal-solutions' ),
            'not_found'          => __( 'No practice areas found.', 'pakistan-legal-solutions' ),
        ],
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,        // Enables Gutenberg editor
        'query_var'           => true,
        'rewrite'             => [ 'slug' => 'practice-areas', 'with_front' => false ],
        'capability_type'     => 'post',
        'has_archive'         => 'practice-areas',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ],
        'delete_with_user'    => false,
    ] );

    // ── Team Members ───────────────────────────────────────────────────────
    register_post_type( 'team_member', [
        'labels' => [
            'name'          => __( 'Team Members',       'pakistan-legal-solutions' ),
            'singular_name' => __( 'Team Member',        'pakistan-legal-solutions' ),
            'add_new_item'  => __( 'Add Team Member',    'pakistan-legal-solutions' ),
            'edit_item'     => __( 'Edit Team Member',   'pakistan-legal-solutions' ),
            'all_items'     => __( 'All Team Members',   'pakistan-legal-solutions' ),
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'team', 'with_front' => false ],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
    ] );

    // ── Testimonials ───────────────────────────────────────────────────────
    register_post_type( 'testimonial', [
        'labels' => [
            'name'          => __( 'Testimonials',      'pakistan-legal-solutions' ),
            'singular_name' => __( 'Testimonial',       'pakistan-legal-solutions' ),
            'add_new_item'  => __( 'Add Testimonial',   'pakistan-legal-solutions' ),
            'all_items'     => __( 'All Testimonials',  'pakistan-legal-solutions' ),
        ],
        'public'             => false,    // Not publicly visible (used in queries only)
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => [ 'title', 'editor' ],
    ] );
}
add_action( 'init', 'pls_register_post_types' );
```

---

## 11. ACF Fields Setup

Install the free **Advanced Custom Fields** plugin. Then add this to `inc/acf-fields.php` to register fields via code (not the GUI) — this means fields travel with your theme via Git:

```php
<?php
/**
 * ACF Field Groups — registered via PHP so they travel with the theme.
 * Requires Advanced Custom Fields plugin (free).
 */
defined( 'ABSPATH' ) || exit;

// ── Practice Area Fields ───────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'      => 'group_practice_area',
    'title'    => 'Practice Area Details',
    'fields'   => [
        [
            'key'           => 'field_pa_subtitle',
            'label'         => 'Page Subtitle',
            'name'          => 'pa_subtitle',
            'type'          => 'text',
            'instructions'  => 'Short subtitle shown under the page title (max 80 characters)',
        ],
        [
            'key'           => 'field_pa_icon',
            'label'         => 'Icon Name',
            'name'          => 'pa_icon',
            'type'          => 'text',
            'instructions'  => 'SVG icon name from sprite (e.g. "scale", "building", "users")',
        ],
        [
            'key'           => 'field_pa_key_services',
            'label'         => 'Key Services',
            'name'          => 'pa_key_services',
            'type'          => 'repeater',
            'button_label'  => 'Add Service',
            'sub_fields'    => [
                [
                    'key'   => 'field_pa_service_name',
                    'label' => 'Service Name',
                    'name'  => 'service_name',
                    'type'  => 'text',
                ],
            ],
        ],
        [
            'key'           => 'field_pa_card_excerpt',
            'label'         => 'Card Excerpt',
            'name'          => 'pa_card_excerpt',
            'type'          => 'textarea',
            'rows'          => 3,
            'instructions'  => 'Short description shown on practice area cards (max 120 characters)',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'practice_area' ] ],
    ],
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
] );

// ── Team Member Fields ─────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_team_member',
    'title'  => 'Attorney Details',
    'fields' => [
        [
            'key'   => 'field_tm_title',
            'label' => 'Job Title',
            'name'  => 'tm_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_tm_credentials',
            'label' => 'Academic Credentials',
            'name'  => 'tm_credentials',
            'type'  => 'text',
            'instructions' => 'e.g. LLB (Punjab), LLM (London School of Economics)',
        ],
        [
            'key'   => 'field_tm_experience',
            'label' => 'Years of Experience',
            'name'  => 'tm_experience',
            'type'  => 'number',
        ],
        [
            'key'   => 'field_tm_phone',
            'label' => 'Direct Phone',
            'name'  => 'tm_phone',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_tm_email',
            'label' => 'Direct Email',
            'name'  => 'tm_email',
            'type'  => 'email',
        ],
        [
            'key'   => 'field_tm_linkedin',
            'label' => 'LinkedIn URL',
            'name'  => 'tm_linkedin',
            'type'  => 'url',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'team_member' ] ],
    ],
] );

// ── Testimonial Fields ─────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_testimonial',
    'title'  => 'Testimonial Details',
    'fields' => [
        [
            'key'   => 'field_t_client_name',
            'label' => 'Client Name',
            'name'  => 't_client_name',
            'type'  => 'text',
        ],
        [
            'key'     => 'field_t_case_type',
            'label'   => 'Case Type',
            'name'    => 't_case_type',
            'type'    => 'select',
            'choices' => [
                'family-law'        => 'Family Law',
                'tax-law'           => 'Tax Law',
                'property-law'      => 'Property Law',
                'corporate-law'     => 'Corporate Law',
                'labor-law'         => 'Labor Law',
                'constitutional'    => 'Constitutional Law',
            ],
        ],
        [
            'key'   => 'field_t_rating',
            'label' => 'Star Rating',
            'name'  => 't_rating',
            'type'  => 'number',
            'min'   => 1,
            'max'   => 5,
            'default_value' => 5,
        ],
        [
            'key'   => 'field_t_location',
            'label' => 'Client City',
            'name'  => 't_location',
            'type'  => 'text',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ] ],
    ],
] );
```

---

## 12. Contact Form — PHP Handler

**inc/contact-form-handler.php:**

```php
<?php
/**
 * Contact Form AJAX Handler
 * Processes form submissions securely.
 * Responds with JSON — consumed by contact-form.js
 */
defined( 'ABSPATH' ) || exit;

// Handle for both logged-in and non-logged-in users
add_action( 'wp_ajax_pls_contact_form',        'pls_handle_contact_form' );
add_action( 'wp_ajax_nopriv_pls_contact_form', 'pls_handle_contact_form' );

function pls_handle_contact_form(): void {

    // ── 1. Verify nonce ────────────────────────────────────────────────────
    if ( ! check_ajax_referer( 'pls_contact_form', 'nonce', false ) ) {
        wp_send_json_error( [ 'message' => __( 'Security check failed. Please reload the page and try again.', 'pakistan-legal-solutions' ) ], 403 );
    }

    // ── 2. Honeypot check (spam bot trap) ──────────────────────────────────
    if ( ! empty( $_POST['website'] ) ) {
        // Silently succeed (don't tell bots they were caught)
        wp_send_json_success( [ 'message' => __( 'Thank you! We will be in touch soon.', 'pakistan-legal-solutions' ) ] );
    }

    // ── 3. Rate limiting (simple: 3 submissions per hour per IP) ──────────
    $ip         = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $rate_key   = 'pls_form_rate_' . md5( $ip );
    $rate_count = (int) get_transient( $rate_key );

    if ( $rate_count >= 3 ) {
        wp_send_json_error( [ 'message' => __( 'Too many submissions. Please wait an hour before trying again, or call us directly.', 'pakistan-legal-solutions' ) ], 429 );
    }

    // ── 4. Sanitize and validate inputs ───────────────────────────────────
    $name          = sanitize_text_field( $_POST['name']          ?? '' );
    $email         = sanitize_email(      $_POST['email']         ?? '' );
    $phone         = sanitize_text_field( $_POST['phone']         ?? '' );
    $practice_area = sanitize_text_field( $_POST['practice_area'] ?? '' );
    $message       = sanitize_textarea_field( $_POST['message']   ?? '' );

    $errors = [];

    if ( strlen( $name ) < 2 )                 $errors[] = 'Name is required.';
    if ( ! is_email( $email ) )                $errors[] = 'Valid email is required.';
    if ( strlen( $phone ) < 7 )                $errors[] = 'Phone number is required.';
    if ( empty( $practice_area ) )             $errors[] = 'Practice area is required.';
    if ( strlen( $message ) < 10 )             $errors[] = 'Please provide more detail about your matter.';

    if ( ! empty( $errors ) ) {
        wp_send_json_error( [ 'message' => implode( ' ', $errors ) ], 422 );
    }

    // ── 5. Build and send email ────────────────────────────────────────────
    $admin_email   = get_option( 'admin_email' );
    $to            = 'info@pakistanlegalsolution.com'; // Change to real email
    $subject       = sprintf(
        '[Pakistan Legal Solutions] New Inquiry: %s — %s',
        ucfirst( str_replace( '-', ' ', $practice_area ) ),
        $name
    );

    $body  = "New contact form submission from pakistanlegalsolution.com\n";
    $body .= "=================================================\n\n";
    $body .= "Name:          {$name}\n";
    $body .= "Email:         {$email}\n";
    $body .= "Phone:         {$phone}\n";
    $body .= "Practice Area: {$practice_area}\n\n";
    $body .= "Message:\n{$message}\n\n";
    $body .= "=================================================\n";
    $body .= "Submitted: " . wp_date( 'F j, Y \a\t g:i a T' ) . "\n";
    $body .= "IP Address: " . esc_html( $ip ) . "\n";
    $body .= "Page: " . esc_html( wp_get_referer() ?: 'Unknown' ) . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "From: Pakistan Legal Solutions Website <noreply@pakistanlegalsolution.com>",
        "Reply-To: {$name} <{$email}>",
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    // ── 6. Send auto-reply to client ───────────────────────────────────────
    if ( $sent ) {
        $reply_subject = __( 'Your Inquiry Has Been Received — Pakistan Legal Solutions', 'pakistan-legal-solutions' );
        $reply_body    = sprintf(
            "Dear %s,\n\nThank you for contacting Pakistan Legal Solutions.\n\n" .
            "We have received your inquiry regarding %s and one of our attorneys will contact you within 24 hours.\n\n" .
            "If your matter is urgent, please call us directly at +92 42 3571 0000.\n\n" .
            "Kind regards,\nPakistan Legal Solutions\n" .
            "MM Alam Road, Gulberg III, Lahore, Pakistan\n" .
            "+92 42 3571 0000 | info@pakistanlegalsolution.com",
            esc_html( $name ),
            esc_html( ucfirst( str_replace( '-', ' ', $practice_area ) ) )
        );
        wp_mail( $email, $reply_subject, $reply_body, [
            'Content-Type: text/plain; charset=UTF-8',
            'From: Pakistan Legal Solutions <info@pakistanlegalsolution.com>',
        ] );
    }

    // ── 7. Increment rate limit counter ───────────────────────────────────
    set_transient( $rate_key, $rate_count + 1, HOUR_IN_SECONDS );

    // ── 8. Respond ────────────────────────────────────────────────────────
    if ( $sent ) {
        wp_send_json_success( [
            'message' => __( 'Thank you, ' . esc_html( $name ) . '! Your message has been received. We will contact you within 24 hours.', 'pakistan-legal-solutions' ),
        ] );
    } else {
        wp_send_json_error( [
            'message' => __( 'Message could not be sent. Please call us at +92 42 3571 0000.', 'pakistan-legal-solutions' ),
        ], 500 );
    }
}
```

---

## 13. Performance Best Practices

### 13.1 Image Optimization

Always add `loading="lazy"` to below-fold images, `loading="eager"` only to hero/LCP images.

Always specify `width` and `height` attributes to prevent layout shift:
```php
<?php the_post_thumbnail( 'card-landscape', [
    'loading' => 'lazy',
    'alt'     => get_the_title(),
    'width'   => 800,
    'height'  => 533,
] ); ?>
```

Use SVG for all logos and icons. Use WebP for photos when possible (Hostinger supports it).

### 13.2 Critical CSS

For the above-the-fold content (hero section), inline critical CSS in the `<head>` to prevent render-blocking:

```php
// In inc/enqueue.php, add:
function pls_inline_critical_css(): void {
    $critical_file = PLS_DIR . '/assets/css/critical.css';
    if ( file_exists( $critical_file ) ) {
        echo '<style id="pls-critical">';
        echo file_get_contents( $critical_file ); // phpcs:ignore
        echo '</style>';
    }
}
add_action( 'wp_head', 'pls_inline_critical_css', 1 );
```

### 13.3 Preload Key Resources

```php
function pls_preload_resources(): void {
    // Preload hero image on homepage
    if ( is_front_page() ) {
        echo '<link rel="preload" as="image" href="' . esc_url( PLS_ASSETS . '/images/hero-bg.jpg' ) . '" fetchpriority="high">' . "\n";
    }
    // Preload primary font
    echo '<link rel="preload" as="font" type="font/woff2" href="' . esc_url( PLS_ASSETS . '/fonts/inter-400.woff2' ) . '" crossorigin>' . "\n";
}
add_action( 'wp_head', 'pls_preload_resources', 2 );
```

---

## 14. Security Hardening

**inc/security.php:**

```php
<?php
defined( 'ABSPATH' ) || exit;

// ── Remove WordPress fingerprints ──────────────────────────────────────────
remove_action( 'wp_head', 'wp_generator' );           // Remove WP version
remove_action( 'wp_head', 'rsd_link' );               // Remove RSD link
remove_action( 'wp_head', 'wlwmanifest_link' );       // Remove WLW manifest
remove_action( 'wp_head', 'wp_shortlink_wp_head' );   // Remove shortlink
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

// ── Disable XML-RPC (common attack vector) ─────────────────────────────────
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_xmlrpc_server_class', '__return_false' );

// ── Disable file editing from WP Admin ────────────────────────────────────
// Also add this to wp-config.php: define('DISALLOW_FILE_EDIT', true);

// ── Hide login page hint ───────────────────────────────────────────────────
function pls_obscure_login_error(): string {
    return __( 'Invalid credentials.', 'pakistan-legal-solutions' );
}
add_filter( 'login_errors', 'pls_obscure_login_error' );

// ── Limit login attempts (basic) ───────────────────────────────────────────
// Use Wordfence plugin for proper brute force protection.

// ── Remove WordPress version from scripts/styles ──────────────────────────
function pls_remove_version_query( string $src ): string {
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src',  'pls_remove_version_query', 9999 );
add_filter( 'script_loader_src', 'pls_remove_version_query', 9999 );

// ── Add security headers ───────────────────────────────────────────────────
// Better done at Nginx/Apache level on Hostinger, but this helps too:
function pls_security_headers(): void {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}
add_action( 'send_headers', 'pls_security_headers' );

// ── Disable REST API for unauthenticated users (optional, stricter) ────────
// Uncomment if you don't need public REST API access:
// add_filter( 'rest_authentication_errors', function( $result ) {
//     if ( ! is_user_logged_in() ) {
//         return new WP_Error( 'rest_not_logged_in', 'You must be logged in.', [ 'status' => 401 ] );
//     }
//     return $result;
// } );
```

---

## 15. SEO Implementation

**inc/seo-meta.php:**

```php
<?php
/**
 * Custom SEO meta tags and Open Graph.
 * Works alongside Yoast SEO plugin.
 * These only output if Yoast is not handling them.
 */
defined( 'ABSPATH' ) || exit;

function pls_schema_markup(): void {
    // Law firm structured data (JSON-LD)
    // This helps Google understand your business and show rich results.
    if ( is_front_page() ) :
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'LegalService',
            'name'        => get_bloginfo( 'name' ),
            'description' => get_bloginfo( 'description' ),
            'url'         => home_url(),
            'logo'        => [
                '@type' => 'ImageObject',
                'url'   => PLS_ASSETS . '/images/logo.png',
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '2nd Floor, Commerce Centre, MM Alam Road, Gulberg III',
                'addressLocality' => 'Lahore',
                'addressRegion'   => 'Punjab',
                'postalCode'      => '54660',
                'addressCountry'  => 'PK',
            ],
            'telephone'       => '+92-42-3571-0000',
            'openingHours'    => [ 'Sa-Th 09:00-18:00' ],
            'priceRange'      => '$$',
            'areaServed'      => 'Pakistan',
            'serviceType'     => [
                'Family Law', 'Tax Law', 'Property Law',
                'Corporate Law', 'Labor Law', 'Constitutional Law',
            ],
        ];
        printf(
            '<script type="application/ld+json">%s</script>' . "\n",
            wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES )
        );
    endif;
}
add_action( 'wp_head', 'pls_schema_markup' );
```

---

## 16. GitHub Workflow

### 16.1 Daily Development Cycle

```bash
# Start of day: pull latest changes
git checkout develop
git pull origin develop

# Create feature branch for today's work
git checkout -b feature/practice-area-pages

# Work in Cursor + Local. Save files. See changes in browser.
# Commit frequently (every logical unit of work):
git add .
git commit -m "feat: add family law practice area page template"
git commit -m "feat: add sidebar with related practice areas"
git commit -m "style: add practice area page CSS"

# Push to GitHub
git push origin feature/practice-area-pages

# When feature is complete, merge to develop
git checkout develop
git merge feature/practice-area-pages
git push origin develop

# When site is ready to deploy, merge to main
git checkout main
git merge develop
git push origin main
```

### 16.2 Optional — Auto Deploy with GitHub Actions

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Hostinger

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Deploy via FTP
        uses: SamKirkland/FTP-Deploy-Action@v4.3.4
        with:
          server:   ${{ secrets.FTP_SERVER }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          server-dir: /public_html/wp-content/themes/pakistan-legal-solutions/
          local-dir:  ./
          exclude:    |
            **/.git*
            **/.git*/**
            **/node_modules/**
            .gitignore
            README.md
            .github/**
```

Then go to your GitHub repo → Settings → Secrets and Variables → Actions → Add:
- `FTP_SERVER` — your Hostinger FTP hostname (from hPanel → FTP Accounts)
- `FTP_USERNAME` — your FTP username
- `FTP_PASSWORD` — your FTP password

Now every `git push origin main` auto-deploys your theme to Hostinger.

---

## 17. Deploy to Hostinger

### 17.1 Get Hostinger FTP Details

Log in to Hostinger hPanel → Hosting → your site → FTP Accounts:
```
FTP Host:     ftp.pakistanlegalsolution.com (or the server IP)
FTP User:     u123456789
FTP Password: (set your own)
FTP Port:     21
```

### 17.2 Upload via FileZilla (Manual)

1. Download FileZilla (free) from filezilla-project.org
2. Open FileZilla → File → Site Manager → New Site
3. Enter FTP details above
4. Connect
5. Navigate to: `/public_html/wp-content/themes/`
6. Drag your `pakistan-legal-solutions` folder from your computer to the server

### 17.3 Activate the Theme

1. Go to your live WordPress admin: `pakistanlegalsolution.com/wp-admin`
2. Appearance → Themes
3. Click "Activate" on Pakistan Legal Solutions

Your site is live.

### 17.4 Set Up Email (Critical)

WordPress's default `wp_mail()` uses PHP mail, which often goes to spam. Fix it:

1. In Hostinger hPanel → Email → create `noreply@pakistanlegalsolution.com`
2. Install **WP Mail SMTP** plugin
3. Go to WP Mail SMTP → Settings → SMTP
4. Mailer: Other SMTP
5. SMTP Host: `smtp.hostinger.com`
6. SMTP Port: `465`
7. Encryption: SSL
8. Username: `noreply@pakistanlegalsolution.com`
9. Password: (your email password)
10. Send a test email to confirm it works

---

## 18. Post-Launch Checklist

Run through every item before calling the site done:

```
CORE FUNCTIONALITY
□ All pages load without PHP errors
□ All navigation links work correctly
□ Contact form submits and sends email to firm
□ Contact form auto-reply reaches test email
□ Mobile menu opens and closes correctly
□ Site logo links to homepage
□ Footer navigation links work
□ All practice area pages accessible

PERFORMANCE
□ PageSpeed score: pagespeed.web.dev — aim for 90+ mobile
□ All images have loading="lazy" except hero
□ No render-blocking resources
□ WP Super Cache configured and active
□ Hostinger LiteSpeed Cache enabled (hPanel → Advanced → Cache)

SEO
□ Yoast SEO configured for organization
□ All pages have unique meta titles and descriptions
□ XML sitemap generated: pakistanlegalsolution.com/sitemap_index.xml
□ Sitemap submitted to Google Search Console
□ Schema markup valid: schema.org/SchemaValidator
□ robots.txt accessible: pakistanlegalsolution.com/robots.txt
□ No noindex on live pages (check Yoast SEO settings)
□ Google Analytics / GA4 set up

SECURITY  
□ Admin username is NOT "admin"
□ Strong admin password set
□ Wordfence Security installed and configured
□ Wordfence firewall enabled
□ WordPress, plugins, and theme all up to date
□ define('DISALLOW_FILE_EDIT', true) in wp-config.php
□ SSL certificate active (https:// — Hostinger provides free)
□ www vs non-www redirect consistent (choose one)
□ Backups scheduled in UpdraftPlus (weekly minimum)

LEGAL (LAW FIRM SPECIFIC)
□ Privacy Policy page complete and linked in footer
□ Disclaimer page complete and linked in footer
□ "Attorney-client privilege" notice on contact form
□ Bar council registration numbers shown (if required)

CONTENT
□ All placeholder text replaced with real content
□ All placeholder images replaced with real photos
□ Real phone number on every CTA
□ Real address in footer and contact page
□ Google Maps showing correct office location
□ Attorney photos uploaded and looking professional
□ Practice area content written by or approved by attorneys

ACCESSIBILITY
□ All images have descriptive alt text
□ All form fields have associated labels
□ Site navigable by keyboard only (Tab through entire site)
□ Color contrast ratio passes WCAG AA
□ Skip link works (Tab on homepage)
□ Focus states visible on all interactive elements
```

---

## 19. Cursor + Claude Prompts

Save these. Use them in Cursor whenever you need to generate or fix code.

### Prompt: New Template File

```
I'm building a WordPress theme called "Pakistan Legal Solutions" for a Pakistani law practice (confirm primary city and service area with the client—Lahore is used in examples only).

Create [filename] — [describe what it does].

Technical requirements:
- PHP 8.2, WordPress coding standards
- All output escaped with esc_html(), esc_url(), esc_attr()  
- Text wrapped in __() for translation: __('text', 'pakistan-legal-solutions')
- No inline styles — CSS classes only (BEM naming)
- Semantic HTML5 with ARIA attributes where needed
- Use get_template_part() for reusable sections
- Use PLS_ASSETS constant for asset URLs (defined in functions.php)
- get_template_directory_uri() is available as PLS_URI

Theme constants available:
- PLS_VERSION, PLS_DIR, PLS_URI, PLS_ASSETS, PLS_INC
- pls_icon($name) — outputs SVG icon from sprite
- pls_field($key, $post_id, $fallback) — gets ACF field with fallback
- pls_page_hero($title, $subtitle) — outputs page hero section
- pls_breadcrumb() — outputs breadcrumb nav

Output the complete file with no explanation, ready to paste.
```

### Prompt: CSS Component

```
Generate CSS for the [component name] component using BEM naming.

Design system variables (all defined as CSS custom properties):
Colors: --color-brand-primary (#8B1A1A), --color-brand-gold (#C4962A)
        --color-text-primary (#1A1A1A), --color-text-secondary (#444444)
        --color-bg-cream (#F8F5F0), --color-bg-dark (#1A1A1A)
Fonts:  --font-heading (Playfair Display, serif), --font-body (Inter, sans-serif)
Space:  --space-4 (1rem), --space-6 (1.5rem), --space-8 (2rem), --space-12 (3rem)
Radius: --radius-md (4px), --radius-lg (8px)
Shadow: --shadow-md, --shadow-lg
Trans:  --transition-base (250ms ease)

Requirements:
- Use CSS custom properties, never hardcode values
- Mobile-first: base styles for mobile, @media (min-width: 768px) for desktop
- Include hover/focus states for interactive elements
- Include .is-animated state for scroll animations (opacity + transform)
- BEM: .block, .block__element, .block--modifier
- No !important
- Aim for under 80 lines

Output only the CSS, no explanation.
```

### Prompt: JavaScript Module

```
Generate a JavaScript ES6 module for [feature name] in a WordPress theme.

Context:
- No jQuery, no frameworks, vanilla ES6+
- Runs after DOMContentLoaded, exported as initXxx() function
- WordPress AJAX available via plsData.ajaxUrl and plsData.nonce (injected by wp_localize_script)
- Must work without a build step (no import from node_modules)
- Use IntersectionObserver for scroll-based features
- Handle keyboard accessibility (Escape key, focus management)
- Respect prefers-reduced-motion

Feature to build: [describe the feature in detail]

Output as a single ES6 module file, export the init function.
```

### Prompt: Fix PHP Error

```
I'm getting this error in my WordPress theme "Pakistan Legal Solutions":

[paste error message]

File: [filename]
Line: [line number]

Here is the relevant code:
[paste code]

Fix the error. Follow WordPress coding standards. Escape all output.
Explain in one line what caused it.
```

### Prompt: WP_Query for CPT

```
Generate a WP_Query for the WordPress theme "Pakistan Legal Solutions" that:
- Queries post type: [post type name]
- [describe filter/order/limit requirements]
- Resets postdata after the loop with wp_reset_postdata()
- Includes proper empty state handling
- Follows WordPress coding standards

Output the complete PHP loop, ready to paste into a template file.
```

---

## 20. Troubleshooting

### White screen / PHP fatal error
Enable debug mode in Local: right-click site → Open site shell → or edit `wp-config.php` and add:
```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```
Check `wp-content/debug.log` for the actual error.

### Theme not appearing in WP Admin
- Verify your `style.css` has the `Theme Name:` comment block at the top
- Verify the theme folder is directly inside `wp-content/themes/` (not nested inside another folder)
- Check for PHP syntax errors in `functions.php` (a single typo breaks the entire theme)

### Custom post types not showing in menus
Go to Appearance → Menus → Screen Options (top right) → check the boxes for your CPTs. They'll appear in the left panel.

### Contact form sending but emails not arriving
- Install WP Mail SMTP and configure Hostinger SMTP (see Step 17.4)
- Check spam folder first
- Test with WP Mail SMTP's built-in test email feature
- Verify the email address in `contact-form-handler.php` is correct

### CSS changes not showing on live site
- Hostinger may be caching. Go to hPanel → Advanced → Cache → Purge All
- If WP Super Cache is active, Plugins → WP Super Cache → Delete Cache
- Hard refresh browser: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)

### `get_field()` returning null
- Verify ACF plugin is active
- Verify the field group is assigned to the correct post type in `acf-fields.php`
- Verify the field `name` in PHP matches exactly what's in `acf_add_local_field_group()`
- Use `var_dump( get_field( 'field_name' ) )` to debug

### JavaScript not working
- Check browser console for errors (F12)
- Verify the script is enqueued in `inc/enqueue.php` with correct path
- Verify `PLS_ASSETS` constant points to the right directory
- If using ES6 modules, ensure `type="module"` is set or use the `strategy` parameter

### Permalinks showing 404
Go to Settings → Permalinks → click "Save Changes" (even without changing anything). This flushes the rewrite rules.

### FTP upload overwrites only changed files
FileZilla compares file modification dates. If it seems to re-upload everything, go to Edit → Settings → Transfers → File Exists Actions and set to "Overwrite if newer."

---

## Quick Reference

```
Local dev URL:     http://pakistan-legal-solutions.local
Live site URL:     https://pakistanlegalsolution.com
WP Admin (local):  http://pakistan-legal-solutions.local/wp-admin
WP Admin (live):   https://pakistanlegalsolution.com/wp-admin
Theme folder:      app/public/wp-content/themes/pakistan-legal-solutions/
Debug log:         app/public/wp-content/debug.log

GitHub repo:       github.com/mubeenmehmood/pakistan-legal-solutions-theme
Main branch:       main (production)
Dev branch:        develop (active work)

Brand colors:
  Primary:   #8B1A1A  (deep maroon)
  Dark:      #5C1010  (hover)
  Gold:      #C4962A  (accent)
  Cream:     #F8F5F0  (light bg)
  Dark bg:   #1A1A1A  (footer/CTA)
  Text:      #1A1A1A / #444444 / #777777

Fonts:
  Headings:  Playfair Display (serif)
  Body:      Inter (sans-serif)

Commit message format:
  feat:     new feature
  fix:      bug fix
  style:    CSS/visual change
  refactor: code cleanup
  docs:     documentation

Hostinger deploy path:
  /public_html/wp-content/themes/pakistan-legal-solutions/
```

---

*Built by Mubeen Mehmood — 2026*  
*Replace all placeholder content with real firm data before going live.*  
*Theme: Pakistan Legal Solutions | Domain: pakistanlegalsolution.com | Stack: WordPress + Custom PHP | Host: Hostinger Premium*