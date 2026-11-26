<?php
/**
 * MSQ Solutions admin — login.
 */
require_once __DIR__ . '/auth.php';

if (msq_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    $tokenOk = msq_csrf_check(isset($_POST['csrf']) ? $_POST['csrf'] : '');
    $userOk = hash_equals(ADMIN_USER, $user);
    $passOk = password_verify($pass, ADMIN_PASS_HASH);

    if (!$tokenOk) {
        $error = 'Your session expired — please try again.';
    } elseif (!$userOk || !$passOk) {
        sleep(1); // slow brute-force attempts
        $error = 'Wrong username or password.';
    } else {
        session_regenerate_id(true);
        $_SESSION['msq_admin_ok'] = true;
        header('Location: index.php');
        exit;
    }
}
$csrf = msq_csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Sign in | <?php echo msq_e(SITE_NAME); ?> Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/admin.css" rel="stylesheet">
</head>
<body class="admin-body login-body">
  <div class="login-wrap">
    <div class="login-card">
      <div class="login-brand">
        <span class="login-mark">MSQ</span>
        <div>
          <strong><?php echo msq_e(SITE_NAME); ?></strong>
          <small>Image Manager · Admin</small>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger py-2 small mb-3"><i class="bi bi-exclamation-triangle me-1"></i><?php echo msq_e($error); ?></div>
      <?php endif; ?>

      <form method="post" action="login.php" novalidate>
        <input type="hidden" name="csrf" value="<?php echo msq_e($csrf); ?>">
        <div class="mb-3">
          <label class="form-label small fw-semibold" for="username">Username</label>
          <input class="form-control" type="text" id="username" name="username" autocomplete="username" required autofocus>
        </div>
        <div class="mb-4">
          <label class="form-label small fw-semibold" for="password">Password</label>
          <input class="form-control" type="password" id="password" name="password" autocomplete="current-password" required>
        </div>
        <button class="btn btn-msq w-100" type="submit"><i class="bi bi-box-arrow-in-right me-1"></i> Sign in</button>
      </form>

      <a class="login-back" href="../index.php"><i class="bi bi-arrow-left me-1"></i> Back to website</a>
    </div>
  </div>
</body>
</html>
