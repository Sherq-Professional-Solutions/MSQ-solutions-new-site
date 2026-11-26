<?php
/**
 * MSQ Solutions — site-wide configuration
 * Update company details here; every page picks them up automatically.
 */
define('SITE_NAME', 'MSQ Solutions');
define('SITE_TAGLINE', 'Technology Partner');
define('SITE_EMAIL', 'info@msqsolutions.net');
define('SITE_PHONE_DISPLAY', '+268 7953 5611');
define('SITE_PHONE_LINK', '+26879535611');
define('SITE_ADDRESS1', '555 Logwaja Street, Extension 6');
define('SITE_ADDRESS2', 'Manzini, Eswatini');
define('SITE_LINKEDIN', 'https://www.linkedin.com/company/msq-solutions/');
define('SITE_DESCRIPTION', 'MSQ Solutions is a 100% Black Swazi-owned software development and digital transformation company based in Manzini, Eswatini. Business analysis, website & mobile app development, system design and ready-made management platforms — because you can\'t improve what you don\'t measure.');

/**
 * Base URL of the folder that contains the PHP pages (auto-detected).
 * Lets every page reference assets/css & assets/js correctly no matter
 * where the site is installed (web root, subfolder, local server...).
 * Example: site at https://example.com/msq-site/index.php -> '/msq-site'
 * Pages inside /admin/ are detected and mapped back to the site root.
 */
$msq_base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (substr($msq_base, -6) === '/admin') {
    $msq_base = substr($msq_base, 0, -6);
}
define('BASE_URL', rtrim($msq_base, '/'));

/* ============================================================
   Admin dashboard — image upload manager (/admin/index.php)
   CHANGE the password below BEFORE going live. To set a new one,
   run:  php -r "echo password_hash('YourNewPassword', PASSWORD_DEFAULT);"
   and paste the result into ADMIN_PASS_HASH.
   ============================================================ */
define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2y$10$DohDlepuhsio6CBEdfqY1e3ngzYXw4Y2hyin6QvAyhMgqxKMBhMCa'); // default: MsqAdmin@2026
define('ADMIN_MAX_UPLOAD_MB', 5);
