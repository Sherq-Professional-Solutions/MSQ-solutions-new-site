<?php
/**
 * MSQ Solutions — image registry
 * Every picture on the website (logo, favicon, illustrations, project
 * images, client logos) is managed through this registry instead of
 * being hardcoded in the templates.
 *
 * - Files live in /uploads/ and are recorded in /uploads/images.json
 * - The admin dashboard (admin/index.php) uploads/replaces/removes them
 * - Templates call msq_image('slot'); when no image was uploaded yet it
 *   returns null and the template falls back to the built-in default.
 */

if (!defined('BASE_URL')) {
    require_once __DIR__ . '/config.php';
}

define('MSQ_UPLOAD_DIR', dirname(__DIR__) . '/uploads');

/**
 * All manageable image slots, grouped for the dashboard.
 * group    -> dashboard section heading
 * label    -> human-readable name
 * where    -> where the image appears on the website
 * accept   -> allowed file extensions
 * fallback -> short text shown in the dashboard while the default is used
 */
function msq_image_slots() {
    return array(
        'site_logo' => array(
            'group' => 'Branding & Logo', 'label' => 'Company Logo',
            'where' => 'Header and footer of every page (replaces the "MSQ" badge)',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'Built-in MSQ badge',
        ),
        'favicon' => array(
            'group' => 'Branding & Logo', 'label' => 'Favicon (browser tab icon)',
            'where' => 'Browser tab / bookmark icon',
            'accept' => 'png,jpg,jpeg,svg,ico,webp', 'fallback' => 'Built-in "M" icon',
        ),
        'about_dashboard' => array(
            'group' => 'About Illustrations', 'label' => 'About — Dashboard Illustration',
            'where' => 'About page, row 1 ("We are your technology partner")',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'Built-in dashboard drawing',
        ),
        'about_mobile' => array(
            'group' => 'About Illustrations', 'label' => 'About — Mobile App Illustration',
            'where' => 'About page, row 2 ("You can\'t improve what you don\'t measure")',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'Built-in phone drawing',
        ),
        'project_ewsc' => array(
            'group' => 'Project Images', 'label' => 'Project — Eswatini Water Services',
            'where' => 'Projects & Clients page, "Customer Mobile Application" card',
            'accept' => 'png,jpg,jpeg,webp,svg', 'fallback' => 'Blue-grey panel with phone icon',
        ),
        'project_gov' => array(
            'group' => 'Project Images', 'label' => 'Project — Government of Eswatini',
            'where' => 'Projects & Clients page, "Performance Management System" card',
            'accept' => 'png,jpg,jpeg,webp,svg', 'fallback' => 'Dark panel with institution icon',
        ),
        'project_eric' => array(
            'group' => 'Project Images', 'label' => 'Project — Eswatini Royal Insurance',
            'where' => 'Projects & Clients page, "Enterprise Mobile Application" card',
            'accept' => 'png,jpg,jpeg,webp,svg', 'fallback' => 'Grey panel with briefcase icon',
        ),
        'project_pspf' => array(
            'group' => 'Project Images', 'label' => 'Project — Public Service Pension Fund',
            'where' => 'Projects & Clients page, "Member Mobile Application" card',
            'accept' => 'png,jpg,jpeg,webp,svg', 'fallback' => 'Charcoal panel with card icon',
        ),
        'client_ewsc' => array(
            'group' => 'Client Logos', 'label' => 'Client Logo — Eswatini Water Services',
            'where' => 'Projects & Clients page, clients grid',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'EWSC monogram',
        ),
        'client_gov' => array(
            'group' => 'Client Logos', 'label' => 'Client Logo — Government of Eswatini',
            'where' => 'Projects & Clients page, clients grid',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'GOV monogram',
        ),
        'client_eric' => array(
            'group' => 'Client Logos', 'label' => 'Client Logo — Eswatini Royal Insurance',
            'where' => 'Projects & Clients page, clients grid',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'ERIC monogram',
        ),
        'client_pspf' => array(
            'group' => 'Client Logos', 'label' => 'Client Logo — Public Service Pension Fund',
            'where' => 'Projects & Clients page, clients grid',
            'accept' => 'svg,png,jpg,jpeg,webp', 'fallback' => 'PSPF monogram',
        ),
    );
}

function msq_registry_file() {
    return MSQ_UPLOAD_DIR . '/images.json';
}

/** Read the slot => file mapping (returns [] when nothing uploaded yet). */
function msq_registry() {
    $f = msq_registry_file();
    if (!is_readable($f)) {
        return array();
    }
    $data = json_decode((string) file_get_contents($f), true);
    return is_array($data) ? $data : array();
}

/** Persist the slot => file mapping. */
function msq_registry_save(array $registry) {
    if (!is_dir(MSQ_UPLOAD_DIR)) {
        @mkdir(MSQ_UPLOAD_DIR, 0755, true);
    }
    file_put_contents(msq_registry_file(), json_encode($registry, JSON_PRETTY_PRINT), LOCK_EX);
}

/**
 * Public URL of the image uploaded for $slot, or null when the slot is
 * still using its built-in default. Templates: echo it escaped.
 */
function msq_image($slot) {
    $registry = msq_registry();
    if (empty($registry[$slot]['file'])) {
        return null;
    }
    $file = basename($registry[$slot]['file']); // registry may only hold a name
    if (!is_file(MSQ_UPLOAD_DIR . '/' . $file)) {
        return null;
    }
    return BASE_URL . '/uploads/' . rawurlencode($file);
}

/** Details for the dashboard: file name, size and upload time, or null. */
function msq_image_meta($slot) {
    $registry = msq_registry();
    if (empty($registry[$slot]['file'])) {
        return null;
    }
    $file = basename($registry[$slot]['file']);
    $path = MSQ_UPLOAD_DIR . '/' . $file;
    if (!is_file($path)) {
        return null;
    }
    return array(
        'file' => $file,
        'url'  => BASE_URL . '/uploads/' . rawurlencode($file),
        'size' => filesize($path),
        'time' => isset($registry[$slot]['time']) ? $registry[$slot]['time'] : '',
        'orig' => isset($registry[$slot]['orig']) ? $registry[$slot]['orig'] : $file,
    );
}

/** Total uploaded bytes + number of filled slots (dashboard stats). */
function msq_upload_stats() {
    $registry = msq_registry();
    $count = 0;
    $bytes = 0;
    $last = '';
    foreach ($registry as $slot => $meta) {
        $path = MSQ_UPLOAD_DIR . '/' . basename(isset($meta['file']) ? $meta['file'] : '');
        if (is_file($path)) {
            $count++;
            $bytes += filesize($path);
            if (!empty($meta['time']) && $meta['time'] > $last) {
                $last = $meta['time'];
            }
        }
    }
    return array('count' => $count, 'bytes' => $bytes, 'last' => $last);
}

/** Basic SVG hardening: strip scripts, event handlers and risky references. */
function msq_sanitize_svg($svg) {
    $svg = preg_replace('#<\s*(script|foreignObject|iframe|object|embed|use)\b[^>]*>.*?<\s*/\s*\1\s*>#is', '', $svg);
    $svg = preg_replace('#<\s*(script|foreignObject|iframe|object|embed|use)\b[^>]*/?\s*>#is', '', $svg);
    $svg = preg_replace('/\son\w+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $svg);
    $svg = preg_replace('/(\s(?:xlink:)?href\s*=\s*)(?:"[^"]*"|\'[^\']*\')/i', '$1"#"',
        preg_replace_callback('/(\s(?:xlink:)?href\s*=\s*)("(?:[^"]*)"|\'(?:[^\']*)\')/i', function ($m) {
            if (preg_match('/^\s*(javascript|data)\s*:/i', $m[2])) {
                return $m[1] . '"#"';
            }
            return $m[1] . $m[2];
        }, $svg));
    return $svg;
}
