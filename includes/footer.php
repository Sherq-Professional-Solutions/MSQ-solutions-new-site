<?php require_once __DIR__ . '/config.php'; ?>
<!-- ***** Footer Start ***** -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="index.php" class="logo" aria-label="<?php echo SITE_NAME; ?> — home">
    <img src="assets/images/msq-removebg-preview.png" alt="<?php echo SITE_NAME; ?> logo" class="logo-img">
    <span class="logo-text">
        <?php echo SITE_NAME; ?>
        <small><?php echo SITE_TAGLINE; ?></small>
    </span>
</a>
        <p>MSQ Solutions is a technology development and planning partner for your organisation, specialising in digitalisation and automation of processes. A 100% Black Swazi-owned company based in Manzini, Eswatini — because you can't improve what you don't measure.</p>
        <ul class="social">
          <li><a href="<?php echo SITE_LINKEDIN; ?>" target="_blank" rel="noopener" aria-label="MSQ Solutions on LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a></li>
          <li><a href="mailto:<?php echo SITE_EMAIL; ?>" aria-label="Email MSQ Solutions"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></a></li>
          <li><a href="tel:<?php echo SITE_PHONE_LINK; ?>" aria-label="Call MSQ Solutions"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></a></li>
        </ul>
      </div>
      <div>
        <h6 class="footer-title">Quick Links</h6>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="services.php#platforms">Ready-Made Platforms</a></li>
          <li><a href="project.php">Recent Projects</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
      </div>
      <div>
        <h6 class="footer-title">Contact Us</h6>
        <ul class="f-contact">
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><span><?php echo SITE_ADDRESS1; ?>,<br><?php echo SITE_ADDRESS2; ?></span></li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><a href="tel:<?php echo SITE_PHONE_LINK; ?>"><?php echo SITE_PHONE_DISPLAY; ?></a></li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> MSQ Solutions. All Rights Reserved.</p>
      <div class="legal">
        <a href="index.php">Terms of Service</a>
        <a href="index.php">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>
<!-- ***** Footer End ***** -->

<script src="assets/js/main.js"></script>

</body>
</html>
