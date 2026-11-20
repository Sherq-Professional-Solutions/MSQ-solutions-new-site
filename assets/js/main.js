/* ============================================================
   MSQ SOLUTIONS — site behaviour
   ============================================================ */
(function () {
  "use strict";

  /* ***** Preloader ***** */
  window.addEventListener("load", function () {
    document.body.classList.add("loaded");
  });
  /* Fallback in case load fires before script or hangs */
  setTimeout(function () { document.body.classList.add("loaded"); }, 1800);

  /* ***** Sticky header ***** */
  var header = document.getElementById("siteHeader");
  function onScroll() {
    if (window.scrollY > 40) { header.classList.add("scrolled"); }
    else { header.classList.remove("scrolled"); }
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* ***** Mobile menu ***** */
  var trigger = document.getElementById("menuTrigger");
  var navMenu = document.getElementById("navMenu");
  if (trigger && navMenu) {
    trigger.addEventListener("click", function () {
      var open = navMenu.classList.toggle("open");
      trigger.classList.toggle("open", open);
      trigger.setAttribute("aria-expanded", open ? "true" : "false");
    });
    navMenu.addEventListener("click", function (e) {
      if (e.target.tagName === "A") {
        navMenu.classList.remove("open");
        trigger.classList.remove("open");
        trigger.setAttribute("aria-expanded", "false");
      }
    });
  }

  /* ***** Scroll reveal ***** */
  var revealItems = [].slice.call(document.querySelectorAll("[data-reveal]"));
  if ("IntersectionObserver" in window) {
    var revealSpy = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("revealed");
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    revealItems.forEach(function (el) { revealSpy.observe(el); });
  } else {
    revealItems.forEach(function (el) { el.classList.add("revealed"); });
  }

  /* ***** Animated counters ***** */
  var counters = [].slice.call(document.querySelectorAll(".count"));
  function runCounter(el) {
    var target = parseInt(el.getAttribute("data-count"), 10) || 0;
    var suffix = el.getAttribute("data-suffix") || "";
    var duration = 1400;
    var start = null;
    function step(ts) {
      if (!start) { start = ts; }
      var p = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(eased * target) + suffix;
      if (p < 1) { window.requestAnimationFrame(step); }
    }
    window.requestAnimationFrame(step);
  }
  if ("IntersectionObserver" in window) {
    var countSpy = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          runCounter(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });
    counters.forEach(function (el) { countSpy.observe(el); });
  } else {
    counters.forEach(function (el) {
      el.textContent = el.getAttribute("data-count") + (el.getAttribute("data-suffix") || "");
    });
  }

  /* ***** Contact form -> mailto (no backend needed) ***** */
  var form = document.getElementById("contact");
  var status = document.getElementById("formStatus");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var name = document.getElementById("name").value.trim();
      var email = document.getElementById("email").value.trim();
      var phone = document.getElementById("phone").value.trim();
      var subject = document.getElementById("subject").value.trim();
      var message = document.getElementById("message").value.trim();
      var mailSubject = subject || "Website enquiry from " + name;
      var body =
        "Name: " + name + "\n" +
        "Email: " + email + "\n" +
        (phone ? "Phone: " + phone + "\n" : "") +
        "\n" + message;
      window.location.href = "mailto:" + form.getAttribute("data-email") +
        "?subject=" + encodeURIComponent(mailSubject) +
        "&body=" + encodeURIComponent(body);
      status.classList.add("show");
    });
  }
})();
