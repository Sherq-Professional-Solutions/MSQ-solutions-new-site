<?php
$page_title = 'Contact Us';
$page_desc  = 'Talk to MSQ Solutions: 555 Logwaja Street, Extension 6, Manzini, Eswatini. Phone +268 7953 5611 or email info@msqsolutions.net — let\'s talk solutions.';
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- ***** Page Hero Start ***** -->
<div class="page-hero" id="contact-top">
  <div class="header-text">
    <div class="container">
      <span class="hero-kicker"><span class="dot"></span> Contact Us</span>
      <h1>Let's talk solutions</h1>
      <p>Tell us what you are trying to measure, manage or grow — we will show you how technology can get you there.</p>
    </div>
  </div>
</div>
<!-- ***** Page Hero End ***** -->

<!-- ***** CTA Band Start ***** -->
<section class="cta-band">
  <div class="container" data-reveal>
    <h2>Still running your business on spreadsheets and guesswork?</h2>
    <p>Let us build you a custom solution that gives you real-time data, streamlined processes and measurable results.</p>
    <a href="#contact-us" class="btn btn-light">Let's Talk Solutions
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
  </div>
</section>
<!-- ***** CTA Band End ***** -->

<!-- ***** Contact Us Start ***** -->
<section class="section section-soft" id="contact-us">
  <div class="container">
    <div class="center-heading" data-reveal>
      <span class="kicker">Get in Touch</span>
      <h2 class="section-title">Talk to us</h2>
      <p class="section-sub">Visit us, call us or send a message — we are based in Manzini and work with organisations across Eswatini.</p>
    </div>
    <div class="contact-wrap">
      <!-- ***** Contact Text Start ***** -->
      <div class="contact-info" data-reveal>
        <h5>Keep in touch</h5>
        <p>We reply to every enquiry — reach out on LinkedIn too.</p>
        <div class="info-row">
          <span class="info-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
          <div><h6>Address</h6><p><?php echo SITE_ADDRESS1; ?>,<br><?php echo SITE_ADDRESS2; ?></p></div>
        </div>
        <div class="info-row">
          <span class="info-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
          <div><h6>Phone</h6><p><a href="tel:<?php echo SITE_PHONE_LINK; ?>"><?php echo SITE_PHONE_DISPLAY; ?></a></p></div>
        </div>
        <div class="info-row">
          <span class="info-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
          <div><h6>Email</h6><p><a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></p></div>
        </div>
        <div class="info-row">
          <span class="info-chip"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></span>
          <div><h6>LinkedIn</h6><p><a href="<?php echo SITE_LINKEDIN; ?>" target="_blank" rel="noopener">linkedin.com/company/msq-solutions</a></p></div>
        </div>
      </div>
      <!-- ***** Contact Text End ***** -->

      <!-- ***** Contact Form Start ***** -->
      <div class="contact-form" data-reveal>
        <form id="contact" action="#contact-us" method="post" data-email="<?php echo SITE_EMAIL; ?>">
          <div class="form-grid">
            <div class="full" style="display:contents">
              <fieldset>
                <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required>
              </fieldset>
              <fieldset>
                <input name="email" type="email" class="form-control" id="email" placeholder="E-Mail Address" required>
              </fieldset>
            </div>
            <div class="full">
              <fieldset>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="Phone (optional)">
              </fieldset>
            </div>
            <div class="full">
              <fieldset>
                <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject (e.g. Performance platform demo)">
              </fieldset>
            </div>
            <div class="full">
              <fieldset>
                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Tell us about your project or the processes you want to digitalise..." required></textarea>
              </fieldset>
            </div>
            <div class="full">
              <fieldset>
                <div class="form-actions">
                  <button type="submit" id="form-submit" class="btn">Send Message
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                  </button>
                  <span class="form-status" id="formStatus">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Opening your email app...
                  </span>
                </div>
                <p class="form-note">This opens your email app with the message pre-filled to <?php echo SITE_EMAIL; ?>. Prefer email? Write to us directly at <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>.</p>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
      <!-- ***** Contact Form End ***** -->
    </div>
  </div>
</section>
<!-- ***** Contact Us End ***** -->

<?php include __DIR__ . '/includes/footer.php'; ?>
