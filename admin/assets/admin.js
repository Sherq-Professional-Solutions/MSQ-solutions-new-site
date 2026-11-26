/* MSQ Solutions admin — dashboard behaviour */
(function () {
  // JS is active: hide the manual "Save" buttons (uploads auto-submit).
  document.body.classList.remove('no-js');

  // ----- Sidebar (mobile off-canvas) -----
  var sidebar = document.getElementById('adminSidebar');
  var toggle = document.getElementById('sidebarToggle');
  var backdrop = document.getElementById('sidebarBackdrop');

  function closeSidebar() {
    sidebar.classList.remove('open');
    backdrop.classList.remove('show');
  }
  if (toggle && sidebar && backdrop) {
    toggle.addEventListener('click', function () {
      sidebar.classList.toggle('open');
      backdrop.classList.toggle('show');
    });
    backdrop.addEventListener('click', closeSidebar);
  }

  // ----- Sidebar links: active state + close on mobile -----
  document.querySelectorAll('.side-link').forEach(function (link) {
    link.addEventListener('click', function () {
      document.querySelectorAll('.side-link').forEach(function (l) { l.classList.remove('active'); });
      link.classList.add('active');
      closeSidebar();
    });
  });

  // ----- Slot upload: submit as soon as a file is picked -----
  document.querySelectorAll('.slot-file-input').forEach(function (input) {
    input.addEventListener('change', function () {
      if (input.files && input.files.length > 0) {
        var fileName = input.files[0].name;
        var form = input.closest('form');
        // show chosen name on the note for feedback before reload
        var note = form.querySelector('.slot-note');
        if (note) { note.textContent = fileName; }
        form.submit();
      }
    });
  });

  // ----- Smooth-scroll offset handled by CSS scroll-margin-top -----
})();
