<?php
/**
 * Services section — the four core service cards.
 * Set $services_variant = 'home' before including to get the
 * overlapping-card style used on the home page (no heading).
 */
$is_home = (isset($services_variant) && $services_variant === 'home');
?>
<!-- ***** Services Start ***** -->
<section class="section<?php echo $is_home ? ' home-feature' : ''; ?>" id="services">
  <div class="container">
    <?php if (!$is_home): ?>
    <div class="center-heading" data-reveal>
      <span class="kicker">What We Do</span>
      <h2 class="section-title">Our Services</h2>
      <p class="section-sub">Four core services that take you from understanding your processes to running them on the right technology.</p>
    </div>
    <?php endif; ?>
    <div class="feature-grid">
      <!-- ***** Service Item 1 ***** -->
      <div class="features-small-item" data-reveal>
        <div class="icon"><div class="icon-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div></div>
        <h5 class="features-title">Business Analysis</h5>
        <p>We analyse your business processes to determine your technology needs and system requirements — so you procure the right solutions, the first time.</p>
      </div>
      <!-- ***** Service Item 2 ***** -->
      <div class="features-small-item d1" data-reveal>
        <div class="icon"><div class="icon-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div></div>
        <h5 class="features-title">Website Development</h5>
        <p>Websites and web applications that give your business a strong online presence and answer your custom technology needs.</p>
      </div>
      <!-- ***** Service Item 3 ***** -->
      <div class="features-small-item d2" data-reveal>
        <div class="icon"><div class="icon-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div></div>
        <h5 class="features-title">Mobile App Development</h5>
        <p>iOS and Android apps that help you engage your customers and streamline operations, built by an experienced mobile development team.</p>
      </div>
      <!-- ***** Service Item 4 ***** -->
      <div class="features-small-item d3" data-reveal>
        <div class="icon"><div class="icon-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg></div></div>
        <h5 class="features-title">System Design</h5>
        <p>System requirement and architecture design for custom solutions that fully integrate with the way your business works.</p>
      </div>
    </div>
  </div>
</section>
<!-- ***** Services End ***** -->
