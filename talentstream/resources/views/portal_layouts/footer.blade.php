<!-- Footer Section Start -->
<footer>
  <!-- Footer Area Start -->
  <section class="footer-Content">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">
              <img src="{{ asset('portal/assets/img/logo.png') }}" class="img-responsive" alt="Footer Logo">
            </h3>
            <div class="textwidget">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod
                purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, consectetur eget facilisis sed.</p>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="widget">
            <h3 class="block-title">Quick Links</h3>
            <ul class="menu">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">License</a></li>
              <li><a href="#">Terms & Conditions</a></li>
              <li><a href="#">Contact</a></li>
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
              <a class="twitter" href="https://twitter.com/GrayGrids"><i class="ti-twitter-alt"></i></a>
              <a class="facebook" href="https://web.facebook.com/GrayGrids"><i class="ti-facebook"></i></a>
              <a class="youtube" href="https://youtube.com/"><i class="ti-youtube"></i></a>
              <a class="dribble" href="https://dribbble.com/GrayGrids"><i class="ti-dribbble"></i></a>
              <a class="linkedin" href="https://www.linkedin.com/GrayGrids"><i class="ti-linkedin"></i></a>
            </div>
            <p>Join our mailing list to stay up to date and get notices about our new releases!</p>
            <form class="subscribe-box">
              <input type="text" placeholder="Your email">
              <input type="submit" class="btn-system" value="Send">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer area End -->

  <!-- Copyright Start  -->
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
  <!-- Copyright End -->
</footer>
<!-- Footer Section End -->

<!-- Go To Top Link -->
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

<!-- Main JS -->
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
<script src="path/to/jquery.min.js"></script>
<script src="path/to/bootstrap.min.js"></script> 
<script src="path/to/theme-scripts.js"></script>

<!-- Summernote JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
  $(document).ready(function() {
    // Switch between login and register
    $('.cd-switcher li a').click(function(e) {
      e.preventDefault();

      $('.cd-switcher a').removeClass('selected');
      $(this).addClass('selected');

      // Get the index of the clicked tab (0 for login, 1 for register)
      var index = $(this).parent().index();

      // Hide all forms
      $('#cd-login, #cd-signup, #cd-reset-password').removeClass('is-selected');

      // Show the form based on tab
      if(index === 0){
        $('#cd-login').addClass('is-selected');
      } else if(index === 1){
        $('#cd-signup').addClass('is-selected');
      }
    });

    // Show reset password form
    $('.cd-form-bottom-message a').click(function(e) {
      e.preventDefault();
      $('#cd-login, #cd-signup').removeClass('is-selected');
      $('#cd-reset-password').addClass('is-selected');
    });

    // Back to login from reset password
    $('#cd-reset-password .cd-form-bottom-message a').click(function(e) {
      e.preventDefault();
      $('#cd-reset-password').removeClass('is-selected');
      $('#cd-login').addClass('is-selected');
    });
  });
</script>


</body>
</html>
