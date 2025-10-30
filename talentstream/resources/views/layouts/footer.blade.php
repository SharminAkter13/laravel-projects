      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-4">
            <div class="copyright text-center text-xl-left text-muted">
              <a href="#" class="font-weight-bold ml-1" target="_blank">All Right Reserve To
                   &copy; TalentStream
              </a>
            </div>
          </div>
          <div class="col-xl-8 pr-4">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">TalentStream</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">
                  MIT License
                </a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
          crossorigin="anonymous"></script>

  <!-- Optional JS -->
  <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>

  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=1.1.2') }}"></script>

  <!-- TrackJS -->
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS && TrackJS.install({
      token: "ee6fab19c5a04ac1a32a645abde4613a",
      application: "argon-dashboard-free"
    });
  </script>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>
</body>
</html>
