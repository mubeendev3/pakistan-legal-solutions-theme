# Pakistan Legal Solutions — WordPress Theme

Custom WordPress theme for **Pakistan Legal Solutions**, a professional legal services site (Lahore-based; clients across Pakistan). The theme is built **without a page builder**: native PHP templates, semantic HTML5, modern CSS, and vanilla JavaScript for performance and long-term maintainability.

| | |
| --- | --- |
| **Public site** | [pakistanlegalsolution.com](https://pakistanlegalsolution.com) |
| **CMS** | WordPress 6.4+ |
| **PHP** | 8.2+ |
| **Text domain / slug** | `pakistan-legal-solutions` |
| **PHP prefix** | `PLS_` / `pls_` |

> **Note:** The registered domain uses singular *solution*; the brand name uses *Solutions*. Keep DNS, email, and legal copy aligned with what the client has registered.

---

## Features

- **Custom templates** — Homepage, About, Contact, Practice Areas overview, blog, archives, 404, search.
- **Custom post types** — Practice areas (`practice_area`), team members (`team_member`), with matching single/archive templates.
- **Advanced Custom Fields (ACF)** — Client-editable content; field groups can be registered in PHP (`inc/acf-fields.php`) when ACF is active.
- **Native contact handling** — PHP + `wp_mail()` (no mandatory form plugin).
- **Security & SEO hooks** — Theme includes patterns for hardening and meta (often paired with Yoast SEO on production).
- **Asset architecture** — Organized CSS (BEM + custom properties), modular JS, SVG icons, optional self-hosted fonts.

---

## Repository contents

| Path | Purpose |
| --- | --- |
| **`wordpress-website-guide.md`** | End-to-end developer reference: local setup, Hostinger, every theme file, CPTs, ACF, forms, performance, security, SEO, Git workflow, deploy, troubleshooting. **Start here** when implementing or extending the theme. |
| **`.gitignore`** | Ignores OS/editor noise, `node_modules`, build output, env files, and server-only artifacts. |

As you add the theme, this repo should grow to match the structure documented in the guide (see **Theme structure** below).

---

## Requirements

- **WordPress** 6.4 or newer (6.5+ recommended per project standards).
- **PHP** 8.2+.
- **Plugins** expected for full operation as documented in the guide:
  - [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) (free)
  - [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) (recommended on production)
  - Caching, security, and backup plugins as per your hosting policy (e.g. WP Super Cache, Wordfence, UpdraftPlus — see the guide)

Do **not** rely on Elementor or similar page builders for this theme; they are intentionally out of scope.

---

## Installation

1. Clone or copy this folder into your WordPress themes directory:
   ```text
   wp-content/themes/pakistan-legal-solutions/
   ```
2. In **Appearance → Themes**, activate **Pakistan Legal Solutions**.
3. Install and activate **ACF** (and other plugins from the guide).
4. Create pages, assign the static front page, set permalinks to **Post name**, and configure menus as described in **`wordpress-website-guide.md`** (sections on WordPress configuration and pages).

For **local development**, the guide recommends [Local by WP Engine](https://localwp.com/) with PHP 8.2 and MySQL 8.0.

---

## Theme structure (overview)

The production layout is specified in detail in **`wordpress-website-guide.md`** (section *Complete Folder Structure*). In short:

- **Root templates** — `style.css`, `functions.php`, `index.php`, `header.php`, `footer.php`, `front-page.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`, and page templates such as `template-contact.php`, `template-about.php`, `template-practice-areas.php`.
- **`inc/`** — Setup, menus, enqueue, CPTs, taxonomies, ACF registration, contact handler, AJAX, security, SEO helpers.
- **`template-parts/`** — Reusable partials (header/footer, home sections, practice area blocks, components, forms).
- **`assets/`** — `css/`, `js/`, `images/`, `fonts/`, `icons/` (e.g. SVG sprite).
- **`languages/`** — Translation template (`.pot`) when you internationalize strings.

Design CSS should live under **`assets/css/`** and be enqueued from `functions.php` / `inc/enqueue.php`, not in the large comment-only `style.css` header file beyond theme registration.

---

## Development workflow

1. Work in this theme directory; refresh the browser after saves (no build step required unless you add one later).
2. Use **Git** for version control; push to GitHub and deploy to hosting (FTP, CI, or host-specific pipeline — see the guide’s *GitHub Workflow* and *Deploy to Hostinger* sections).
3. Replace all **placeholders** (address, phone, stats, map, social URLs, bar references, etc.) with client-approved content before launch.

---

## Deployment

Typical flow documented in the guide:

- **GitHub** → artifact or branch → **FTP/SFTP** to the server (e.g. Hostinger), or automated deploy if you add it.
- Never commit **`wp-config.php`**, `.env`, or production secrets (already covered in `.gitignore`).

---

## Documentation

| Document | What it covers |
| --- | --- |
| [`wordpress-website-guide.md`](./wordpress-website-guide.md) | Full build spec: template hierarchy, `functions.php` bootstrap, sample `inc/*` snippets, CSS/JS layout, CPT reference, ACF, contact form handler, performance, security, SEO, checklists, Cursor prompts, troubleshooting. |

---

## Security

- Do not expose admin credentials or API keys in the repository.
- Follow WordPress coding standards and capability checks for any admin or AJAX code.
- See **`wordpress-website-guide.md`** → *Security Hardening* for theme-level patterns.

---

## Credits

- **Theme / guide author:** Mubeen Mehmood  
- **Brand:** Pakistan Legal Solutions  

---

## License

Theme code and assets are intended as **proprietary** client work unless you explicitly release them under an open license. If you publish only a subset (for example, a starter skeleton), clarify the license in this section and in `style.css` header comments.

---

## Contributing

If this repository is **private** and team-only: use branches and pull requests; keep commits focused; update the guide when behavior or file layout changes.

If you **open-source** a fork later, add `CONTRIBUTING.md` and a clear SPDX license file consistent with your legal review.
