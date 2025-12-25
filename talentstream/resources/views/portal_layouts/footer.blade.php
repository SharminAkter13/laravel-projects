<footer>
  <section class="footer-Content mt-5">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">
              <a class="navbar-brand d-flex align-items-center mt-2" href="{{ route('portal.home') }}">
                <img src="{{ asset('portal/assets/img/favicon.ico') }}" alt="TalentStream Logo" class="me-2 logo-img">
                <h2 class="fw-bold text-danger mb-0">TalentStream</h2>
              </a>
            </h3>
            <div class="textwidget">
              <p>Connecting talent with opportunity. Manage your career or find your next great hire with TalentStream.</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">Quick Links</h3>
            <ul class="menu">
              <li><a href="{{ route('about') }}">About Us</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">License</a></li>
              <li><a href="#">Terms & Conditions</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">Trending Jobs</h3>
            <ul class="menu">
              <li><a href="#">Android Developer</a></li>
              <li><a href="#">Senior Accountant</a></li>
              <li><a href="#">Frontend Developer</a></li>
              <li><a href="#">Junior Tester</a></li>
              <li><a href="#">Project Manager</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">Follow Us</h3>
            <div class="bottom-social-icons social-icon">
              <a class="twitter" href="#"><i class="ti-twitter-alt"></i></a>
              <a class="facebook" href="#"><i class="ti-facebook"></i></a>
              <a class="youtube" href="#"><i class="ti-youtube"></i></a>
              <a class="dribble" href="#"><i class="ti-dribbble"></i></a>
              <a class="linkedin" href="#"><i class="ti-linkedin"></i></a>
            </div>
            <p>Join our mailing list to stay up to date!</p>
            <form class="subscribe-box">
              <input type="text" placeholder="Your email">
              <input type="submit" class="btn-system" value="Send">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="site-info text-center">
            <p>All Rights reserved &copy; 2025 - Designed & Developed by 
              <a rel="nofollow" href="#">TalentStream</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<a href="#" class="back-to-top">
  <i class="ti-arrow-up"></i>
</a>

<div id="loading">
  <div id="loading-center">
    <div id="loading-center-absolute">
      <div class="object" id="object_one"></div>
      <div class="object" id="object_two"></div>
      <div class="object" id="object_three"></div>
      <div class="object" id="object_four"></div>
      <div class="object" id="object_five"></div>
      <div class="object" id="object_six"></div>
      <div class="object" id="object_seven"></div>
      <div class="object" id="object_eight"></div>
    </div>
  </div>
</div>

<script src="{{ asset('portal/assets/js/jquery-min.js') }}"></script>
<script src="{{ asset('portal/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/material.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/material-kit.js') }}"></script>
<script src="{{ asset('portal/assets/js/color-switcher.js') }}"></script>
<script src="{{ asset('portal/assets/js/jquery.parallax.js') }}"></script>
<script src="{{ asset('portal/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('portal/assets/js/main.js') }}"></script>
<script src="{{ asset('portal/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/contact-form-script.js') }}"></script>
<script src="{{ asset('portal/assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('portal/assets/js/jquery.themepunch.tools.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
  $(document).ready(function() {
    
    // 1. Initialize SlickNav Mobile Menu
    // label: '' removes the "MENU" text visible in your image
    $('.navbar-nav').slicknav({
        prependTo: '.logo-menu .container',
        label: '', 
        allowParentLinks: true,
        closedSymbol: '<i class="fa fa-angle-right"></i>',
        openedSymbol: '<i class="fa fa-angle-down"></i>'
    });

    // 2. Auth Form Switcher Logic
    $('.cd-switcher li a').click(function(e) {
      e.preventDefault();
      $('.cd-switcher a').removeClass('selected');
      $(this).addClass('selected');
      var index = $(this).parent().index();
      $('#cd-login, #cd-signup, #cd-reset-password').removeClass('is-selected');
      if(index === 0){
        $('#cd-login').addClass('is-selected');
      } else if(index === 1){
        $('#cd-signup').addClass('is-selected');
      }
    });

    // 3. Password Reset View Logic
    $('.cd-form-bottom-message a').click(function(e) {
      e.preventDefault();
      $('#cd-login, #cd-signup').removeClass('is-selected');
      $('#cd-reset-password').addClass('is-selected');
    });

    $('#cd-reset-password .cd-form-bottom-message a').click(function(e) {
      e.preventDefault();
      $('#cd-reset-password').removeClass('is-selected');
      $('#cd-login').addClass('is-selected');
    });
  });
</script>

@stack('scripts')

</body>
</html>