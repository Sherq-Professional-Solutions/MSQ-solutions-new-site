<?php
$page_title = 'Projects & Clients';
$page_desc  = 'Recent projects by MSQ Solutions: mobile apps and web systems delivered for Eswatini Water Services Corporation, the Government of Eswatini, Eswatini Royal Insurance and the Public Service Pension Fund.';
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- ***** Page Hero Start ***** -->
<div class="page-hero" id="projects-top">
  <div class="header-text">
    <div class="container">
      <span class="hero-kicker"><span class="dot"></span> Our Work</span>
      <h1>Projects &amp; Clients</h1>
      <p>Solutions we have delivered for government, utilities, insurance and pensions — and the organisations that trust them every day.</p>
    </div>
  </div>
</div>
<!-- ***** Page Hero End ***** -->

<?php include __DIR__ . '/includes/section-projects.php'; ?>

<!-- ***** Clients Start ***** -->
<section class="section section-soft" id="clients">
  <div class="container">
    <div class="center-heading" data-reveal>
      <span class="kicker">Our Clients</span>
      <h2 class="section-title">Trusted where it matters most</h2>
      <p class="section-sub">From government ministries to utilities, insurance and pensions — our solutions run at national scale, for organisations that can't afford to guess.</p>
    </div>
    <div class="client-grid">
      <!-- ***** Client Item 1 ***** -->
      <div class="client-card" data-reveal>
        <div class="client-mono">EWSC</div>
        <h5>Eswatini Water Services Corporation</h5>
        <span class="client-tag">Water &amp; Utilities</span>
        <p>Mobile application for customer bills, service applications and anonymous issue reporting.</p>
      </div>
      <!-- ***** Client Item 2 ***** -->
      <div class="client-card d1" data-reveal>
        <div class="client-mono">GOV</div>
        <h5>Government of Eswatini</h5>
        <span class="client-tag">Public Sector</span>
        <p>National performance management and appraisal system across ministries and departments.</p>
      </div>
      <!-- ***** Client Item 3 ***** -->
      <div class="client-card d2" data-reveal>
        <div class="client-mono">ERIC</div>
        <h5>Eswatini Royal Insurance Corporation</h5>
        <span class="client-tag">Insurance</span>
        <p>Customised performance, project management and procurement platform with HR modules.</p>
      </div>
      <!-- ***** Client Item 4 ***** -->
      <div class="client-card d3" data-reveal>
        <div class="client-mono">PSPF</div>
        <h5>Public Service Pension Fund</h5>
        <span class="client-tag">Pensions</span>
        <p>Mobile application putting pension fund services in members' pockets.</p>
      </div>
    </div>
  </div>
</section>
<!-- ***** Clients End ***** -->

<?php include __DIR__ . '/includes/footer.php'; ?>
