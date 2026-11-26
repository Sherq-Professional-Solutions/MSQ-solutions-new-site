<?php
/**
 * MSQ Solutions admin — shared auth & helpers.
 * Every admin page requires this file first.
 */
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/images.php';

if (session_status() === PHP_SESSION_NONE) {
    session_name('msqAdmin');
    session_start();
}

function msq_admin_logged_in() {
    return !empty($_SESSION['msq_admin_ok']);
}

function msq_admin_require() {
    if (!msq_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function msq_csrf_token() {
    if (empty($_SESSION['msq_csrf'])) {
        $_SESSION['msq_csrf'] = bin2hex(random_bytes(24));
    }
    return $_SESSION['msq_csrf'];
}

function msq_csrf_check($token) {
    return is_string($token) && !empty($_SESSION['msq_csrf']) && hash_equals($_SESSION['msq_csrf'], $token);
}

function msq_flash($key, $value = null) {
    if ($value !== null) {
        $_SESSION['msq_flash'][$key] = $value;
        return $value;
    }
    $v = isset($_SESSION['msq_flash'][$key]) ? $_SESSION['msq_flash'][$key] : null;
    unset($_SESSION['msq_flash'][$key]);
    return $v;
}

function msq_e($text) {
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

/** Human-readable file size. */
function msq_size_fmt($bytes) {
    if ($bytes >= 1048576) return number_format($bytes / 1048576, 1) . ' MB';
    if ($bytes >= 1024) return number_format($bytes / 1024, 1) . ' KB';
    return $bytes . ' B';
}

/** Validate + store one uploaded image into a slot. Returns [ok, message]. */
function msq_handle_upload($slot, $file) {
    $slots = msq_image_slots();
    if (!isset($slots[$slot])) {
        return array(false, 'Unknown image slot.');
    }
    if (!isset($file['error']) || is_array($file['error'])) {
        return array(false, 'Invalid upload payload.');
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return array(false, 'Upload failed (error code ' . (int) $file['error'] . ') — file may exceed the server limit.');
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        return array(false, 'Invalid upload source.');
    }

    $maxBytes = defined('ADMIN_MAX_UPLOAD_MB') ? ADMIN_MAX_UPLOAD_MB * 1048576 : 5242880;
    if ($file['size'] <= 0 || $file['size'] > $maxBytes) {
        return array(false, 'File is empty or larger than ' . ADMIN_MAX_UPLOAD_MB . ' MB.');
    }

    $slotConf = $slots[$slot];
    $allowed = array_map('trim', explode(',', strtolower($slotConf['accept'])));
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) {
        return array(false, 'Extension ".' . $ext . '" not allowed here. Accepted: ' . $slotConf['accept'] . '.');
    }

    // Real MIME type check
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $mimeMap = array(
        'image/jpeg' => array('jpg', 'jpeg'), 'image/png' => array('png'),
        'image/webp' => array('webp'), 'image/svg+xml' => array('svg'),
        'text/plain' => array('svg'), 'text/xml' => array('svg'),
        'application/xml' => array('svg'), 'image/x-icon' => array('ico'),
        'image/vnd.microsoft.icon' => array('ico'),
    );
    if (!isset($mimeMap[$mime]) || !in_array($mimeMap[$mime][0], $allowed, true)) {
        return array(false, 'File content is "' . $mime . '" — that is not an accepted image type.');
    }

    // Raster images must really decode; SVG must parse as XML
    if ($mime !== 'image/svg+xml' && $ext !== 'svg' && !in_array($ext, array('ico'), true)) {
        $info = @getimagesize($file['tmp_name']);
        if ($info === false) {
            return array(false, 'Image is corrupt or not a real picture.');
        }
    } elseif ($ext === 'svg' || $mime === 'image/svg+xml') {
        $svg = (string) file_get_contents($file['tmp_name']);
        if (@simplexml_load_string($svg) === false) {
            return array(false, 'SVG file is not valid XML.');
        }
        file_put_contents($file['tmp_name'], msq_sanitize_svg($svg));
    }

    if (!is_dir(MSQ_UPLOAD_DIR) && !@mkdir(MSQ_UPLOAD_DIR, 0755, true)) {
        return array(false, 'Could not create the /uploads folder — check permissions.');
    }

    $newName = $slot . '-' . date('Ymd-His') . '-' . substr(bin2hex(random_bytes(4)), 0, 6) . '.' . $ext;
    $dest = MSQ_UPLOAD_DIR . '/' . $newName;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return array(false, 'Could not save the file — check folder permissions on /uploads.');
    }
    @chmod($dest, 0644);

    // Remove the previous file for this slot, then record the new one
    $registry = msq_registry();
    if (!empty($registry[$slot]['file'])) {
        $old = MSQ_UPLOAD_DIR . '/' . basename($registry[$slot]['file']);
        if (is_file($old)) {
            @unlink($old);
        }
    }
    $registry[$slot] = array(
        'file' => $newName,
        'orig' => $file['name'],
        'time' => date('Y-m-d H:i'),
    );
    msq_registry_save($registry);

    return array(true, $slotConf['label'] . ' updated.');
}

/** Remove a slot's uploaded image (falls back to the built-in default). */
function msq_handle_delete($slot) {
    $slots = msq_image_slots();
    if (!isset($slots[$slot])) {
        return array(false, 'Unknown image slot.');
    }
    $registry = msq_registry();
    if (empty($registry[$slot]['file'])) {
        return array(false, 'Nothing uploaded for that slot yet.');
    }
    $old = MSQ_UPLOAD_DIR . '/' . basename($registry[$slot]['file']);
    if (is_file($old)) {
        @unlink($old);
    }
    unset($registry[$slot]);
    msq_registry_save($registry);
    return array(true, $slots[$slot]['label'] . ' removed — default is shown again.');
}
