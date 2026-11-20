<?php
$page_title = 'Home';
$page_desc  = 'MSQ Solutions is a 100% Black Swazi-owned software development and digital transformation company based in Manzini, Eswatini. Smart software for businesses that want to measure, streamline and grow.';
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome">
  <span class="glow g1"></span><span class="glow g2"></span>
  <!-- ***** Header Text Start ***** -->
  <div class="header-text">
    <div class="container">
      <span class="hero-kicker"><span class="dot"></span> MSQ Solutions · Manzini, Eswatini</span>
      <h1>Smart software for businesses that want to <strong>measure</strong>, <strong>streamline</strong> &amp; <strong>grow</strong></h1>
      <p>We are your trusted partner in digitalization and business analysis — helping you enhance efficiency, leverage technology and strengthen your online presence, because you can't improve what you don't measure.</p>
      <div class="hero-actions">
        <a href="services.php" class="btn">Explore Our Services</a>
        <a href="contact.php" class="btn btn-ghost">Let's Talk Solutions</a>
      </div>
      <div class="hero-badges">
        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> 100% Black Swazi-owned</span>
        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Government, utilities, insurance &amp; pensions</span>
        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg> Real-time, measurable results</span>
      </div>
    </div>
  </div>
  <!-- ***** Header Text End ***** -->
</div>
<!-- ***** Welcome Area End ***** -->

<?php $services_variant = 'home'; include __DIR__ . '/includes/section-services.php'; ?>

<?php include __DIR__ . '/includes/section-about.php'; ?>

<?php include __DIR__ . '/includes/section-projects.php'; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
