<?php
$page_title = 'About Us';
$page_desc  = 'MSQ Solutions is a 100% Black Swazi-owned company based in Eswatini, delivering smart software solutions and digital transformation services. We are your technology partner.';
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- ***** Page Hero Start ***** -->
<div class="page-hero" id="about">
  <div class="header-text">
    <div class="container">
      <span class="hero-kicker"><span class="dot"></span> About Us</span>
      <h1>We are your technology partner</h1>
      <p>A 100% Black Swazi-owned technology partner, helping organisations across Eswatini measure, streamline and grow.</p>
    </div>
  </div>
</div>
<!-- ***** Page Hero End ***** -->

<?php include __DIR__ . '/includes/section-about.php'; ?>

<!-- ***** Counter Start ***** -->
<section class="counter">
  <div class="content">
    <div class="container">
      <div class="count-grid">
        <div class="count-item" data-reveal>
          <strong><em><span class="count" data-count="100" data-suffix="%">0%</span></em></strong>
          <span>Black Swazi-Owned</span>
        </div>
        <div class="count-item d1" data-reveal>
          <strong><em><span class="count" data-count="4">0</span></em></strong>
          <span>Core Services</span>
        </div>
        <div class="count-item d2" data-reveal>
          <strong><em><span class="count" data-count="4">0</span></em></strong>
          <span>Ready-Made Platforms</span>
        </div>
        <div class="count-item d3" data-reveal>
          <strong><em><span class="count" data-count="4">0</span></em></strong>
          <span>Flagship Projects</span>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ***** Counter End ***** -->

<?php include __DIR__ . '/includes/footer.php'; ?>
