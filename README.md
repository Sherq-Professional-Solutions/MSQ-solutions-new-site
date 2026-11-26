# MSQ Solutions — Website

Multi-page PHP website with an admin dashboard that manages every image on the
site (logo, favicon, about illustrations, project images, client logos) through
uploads — no code editing needed.

## Pages

| File            | Contents                                                        |
|-----------------|-----------------------------------------------------------------|
| `index.php`     | Home — services, about, projects                                |
| `about.php`     | About                                                           |
| `services.php`  | Services → Platforms → Work process                             |
| `project.php`   | Projects & Clients (projects, then clients)                     |
| `contact.php`   | Contact Us                                                      |
| `admin/`        | Image Manager dashboard (login required)                        |

## Admin dashboard

Open `https://your-domain/admin/` (or `/msq-site/admin/` in a subfolder).

- **Default login:** user `admin`, password `MsqAdmin@2026`
- **Change the password before going live.** In `includes/config.php`, replace
  `ADMIN_PASS_HASH` with the hash of your new password:

  ```bash
  php -r "echo password_hash('YourNewPassword', PASSWORD_DEFAULT);"
  ```

- Pick a file on any card and it uploads immediately (auto-save).
  "Replace" swaps the image, "Remove" restores the built-in default.
- Uploads are validated (extension + real file type), SVGs are sanitised,
  files are stored in `/uploads/` with random names, and the whole folder is
  protected by `.htaccess` (no script execution, no directory listing).
- The mapping of slot → file lives in `/uploads/images.json`.
  When a slot is empty the website automatically shows its built-in default,
  so nothing ever breaks.

Image slots: company logo (header + footer), favicon, 2 about illustrations,
4 project images, 4 client logos. Accepted types: JPG / PNG / WebP / SVG
(favicon also .ico) · max 5 MB per file.

## Requirements

- PHP 7.2+ (PHP 8.x recommended) with `fileinfo` + `session` enabled (standard)
- Apache with `mod_rewrite` not required; `.htaccess` support recommended
  (on Nginx, block PHP execution inside `/uploads/` at server level)

## Local preview

```bash
php -S localhost:8080    # from this folder, then open http://localhost:8080
```

## Structure

```
msq-site/
├── index.php · about.php · services.php · project.php · contact.php
├── admin/            login.php · logout.php · index.php · auth.php · assets/
├── assets/           css/style.css · js/main.js
├── includes/         config.php · images.php · header.php · footer.php · sections
└── uploads/          uploaded images + images.json registry (+ .htaccess guard)
```
