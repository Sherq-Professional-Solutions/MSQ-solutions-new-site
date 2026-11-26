<?php
/**
 * MSQ Solutions admin — image manager dashboard.
 * Upload / replace / remove every picture used on the website here;
 * nothing on the public site needs to be edited by hand.
 */
require_once __DIR__ . '/auth.php';
msq_admin_require();

$slots  = msq_image_slots();
$notice = null;
$noticeType = 'success';

/* ---------- POST actions: upload / delete ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : '';
    if (!msq_csrf_check($csrf)) {
        $notice = 'Security token expired — please try again.';
        $noticeType = 'danger';
    } else {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $slot   = isset($_POST['slot']) ? preg_replace('/[^a-z0-9_]/', '', $_POST['slot']) : '';
        if ($action === 'upload' && isset($_FILES['image'])) {
            list($ok, $notice) = msq_handle_upload($slot, $_FILES['image']);
            $noticeType = $ok ? 'success' : 'danger';
        } elseif ($action === 'delete') {
            list($ok, $notice) = msq_handle_delete($slot);
            $noticeType = $ok ? 'success' : 'danger';
        } else {
            $notice = 'Unknown action.';
            $noticeType = 'danger';
        }
    }
}

$stats = msq_upload_stats();
$totalSlots = count($slots);
$csrf = msq_csrf_token();
$groups = array();
foreach ($slots as $key => $conf) {
    $groups[$conf['group']][$key] = $conf;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Dashboard | <?php echo msq_e(SITE_NAME); ?> Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/admin.css" rel="stylesheet">
</head>
<body class="admin-body no-js">

<div class="admin-shell">
  <!-- ***** Sidebar ***** -->
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
      <?php if ($logoUrl = msq_image('site_logo')): ?>
        <img src="<?php echo msq_e($logoUrl); ?>" alt="<?php echo msq_e(SITE_NAME); ?>" class="sidebar-logo-img">
      <?php else: ?>
        <span class="sidebar-mark">MSQ</span>
      <?php endif; ?>
      <div>
        <strong><?php echo msq_e(SITE_NAME); ?></strong>
        <small>Image Manager</small>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="#top" class="side-link active"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <?php foreach ($groups as $group => $items): ?>
        <a href="#group-<?php echo msq_e(preg_replace('/[^a-z]+/i', '-', strtolower($group))); ?>" class="side-link">
          <i class="bi bi-images"></i> <?php echo msq_e($group); ?>
          <span class="side-count"><?php
            $filled = 0;
            foreach ($items as $k => $v) { if (msq_image($k)) $filled++; }
            echo $filled . '/' . count($items);
          ?></span>
        </a>
      <?php endforeach; ?>
      <div class="side-sep"></div>
      <a href="<?php echo msq_e(BASE_URL); ?>/index.php" class="side-link" target="_blank" rel="noopener"><i class="bi bi-globe2"></i> View Website</a>
      <a href="logout.php" class="side-link side-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>
    <div class="sidebar-foot">
      <span class="status-dot"></span> Uploads healthy
    </div>
  </aside>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ***** Main ***** -->
  <div class="admin-main">
    <header class="admin-topbar">
      <button class="topbar-burger" id="sidebarToggle" aria-label="Toggle sidebar"><i class="bi bi-list"></i></button>
      <div class="topbar-title">
        <h1>Dashboard</h1>
        <span>Manage every picture on <?php echo msq_e(SITE_NAME); ?> without touching code</span>
      </div>
      <div class="topbar-actions">
        <a class="btn btn-outline-msq btn-sm" href="<?php echo msq_e(BASE_URL); ?>/index.php" target="_blank" rel="noopener">
          <i class="bi bi-globe2 me-1"></i><span class="d-none d-sm-inline">View Site</span>
        </a>
        <div class="dropdown">
          <button class="btn btn-user dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="user-chip"><?php echo msq_e(strtoupper(substr(ADMIN_USER, 0, 1))); ?></span>
            <span class="d-none d-md-inline"><?php echo msq_e(ADMIN_USER); ?></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
          </ul>
        </div>
      </div>
    </header>

    <main class="admin-content" id="top">
      <?php if ($notice): ?>
        <div class="alert alert-<?php echo $noticeType; ?> alert-dismissible fade show" role="alert">
          <i class="bi bi-<?php echo $noticeType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-1"></i>
          <?php echo msq_e($notice); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <!-- ***** Stats ***** -->
      <div class="stat-row">
        <div class="stat-card">
          <span class="stat-icon ic-red"><i class="bi bi-images"></i></span>
          <div><small>Slots filled</small><strong><?php echo $stats['count']; ?> / <?php echo $totalSlots; ?></strong></div>
        </div>
        <div class="stat-card">
          <span class="stat-icon ic-plain"><i class="bi bi-square"></i></span>
          <div><small>Using built-in default</small><strong><?php echo $totalSlots - $stats['count']; ?></strong></div>
        </div>
        <div class="stat-card">
          <span class="stat-icon ic-plain"><i class="bi bi-hdd"></i></span>
          <div><small>Storage used</small><strong><?php echo msq_size_fmt($stats['bytes']); ?></strong></div>
        </div>
        <div class="stat-card">
          <span class="stat-icon ic-plain"><i class="bi bi-clock-history"></i></span>
          <div><small>Last update</small><strong><?php echo $stats['last'] ? msq_e($stats['last']) : '—'; ?></strong></div>
        </div>
      </div>

      <!-- ***** Slot groups ***** -->
      <?php foreach ($groups as $group => $items):
        $gid = 'group-' . preg_replace('/[^a-z]+/i', '-', strtolower($group)); ?>
        <section class="slot-section" id="<?php echo msq_e($gid); ?>">
          <h2 class="slot-group-title"><?php echo msq_e($group); ?></h2>
          <div class="slot-grid">
            <?php foreach ($items as $key => $conf):
              $meta = msq_image_meta($key);
              $url  = $meta ? $meta['url'] : null; ?>
              <div class="slot-card<?php echo $url ? ' is-filled' : ''; ?>" id="slot-<?php echo msq_e($key); ?>">
                <div class="slot-preview">
                  <?php if ($url): ?>
                    <img src="<?php echo msq_e($url); ?>?t=<?php echo time(); ?>" alt="<?php echo msq_e($conf['label']); ?>">
                    <span class="slot-badge slot-badge-live">Live</span>
                  <?php else: ?>
                    <span class="slot-badge">Default</span>
                    <div class="slot-placeholder">
                      <i class="bi bi-<?php echo $key === 'favicon' ? 'app' : ($key === 'site_logo' ? 'patch-check' : 'image'); ?>"></i>
                      <small><?php echo msq_e($conf['fallback']); ?></small>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="slot-body">
                  <h3><?php echo msq_e($conf['label']); ?></h3>
                  <p><?php echo msq_e($conf['where']); ?></p>
                  <?php if ($meta): ?>
                    <div class="slot-file"><i class="bi bi-file-earmark-image me-1"></i>
                      <?php echo msq_e($meta['orig']); ?> · <?php echo msq_size_fmt($meta['size']); ?>
                      <?php if ($meta['time']): ?> · <?php echo msq_e($meta['time']); ?><?php endif; ?>
                    </div>
                  <?php endif; ?>
                  <form method="post" enctype="multipart/form-data" class="slot-form">
                    <input type="hidden" name="csrf" value="<?php echo msq_e($csrf); ?>">
                    <input type="hidden" name="action" value="upload">
                    <input type="hidden" name="slot" value="<?php echo msq_e($key); ?>">
                    <input type="file" class="slot-file-input" name="image" id="file-<?php echo msq_e($key); ?>"
                           accept=".<?php echo msq_e(str_replace(',', ',.', $conf['accept'])); ?>" required>
                    <div class="slot-actions">
                      <label class="btn btn-msq btn-sm" for="file-<?php echo msq_e($key); ?>">
                        <i class="bi bi-<?php echo $url ? 'arrow-repeat' : 'upload'; ?> me-1"></i><?php echo $url ? 'Replace' : 'Upload'; ?>
                      </label>
                      <button type="submit" class="btn btn-msq btn-sm slot-send">Save</button>
                      <span class="slot-note">.<?php echo msq_e(strtoupper(str_replace(',', ' / .', $conf['accept']))); ?> · max <?php echo (int) ADMIN_MAX_UPLOAD_MB; ?> MB</span>
                    </div>
                  </form>
                  <?php if ($meta): ?>
                    <form method="post" class="slot-form" onsubmit="return confirm('Remove this image and show the built-in default again?');">
                      <input type="hidden" name="csrf" value="<?php echo msq_e($csrf); ?>">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="slot" value="<?php echo msq_e($key); ?>">
                      <button type="submit" class="btn btn-remove btn-sm"><i class="bi bi-trash3 me-1"></i>Remove</button>
                    </form>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endforeach; ?>

      <footer class="admin-foot">
        <span>© <?php echo date('Y'); ?> <?php echo msq_e(SITE_NAME); ?> · Image Manager</span>
        <span>Registry: /uploads/images.json — images served from /uploads/</span>
      </footer>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/admin.js"></script>
</body>
</html>
