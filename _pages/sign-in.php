<?php

$nofooter = true;
$msg = "Sign in";
if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
?>
  <script type="text/javascript">
    window.location.href = 'index.php?page=index';
  </script>
  <?php
  exit;
}
if (isset($_POST['submit'])) {
  $user = getUser($conn, $_POST['email']);
  print($user['password_sha256']);
  print(sha256($_POST['password']));
  if ($user) {
    if (sha256($_POST['password']) == $user['password_sha256'] && $_POST['email'] == $user['email']) {
      login($conn, $_POST['email'], $_POST['password']);
      updateUser($conn, $_POST['email']);
      $_SESSION['LOGGEDIN'] = true;
      $_SESSION['EMAIL'] = $user['email'];
      $_SESSION['USERNAME'] = $user['username'];
      $_SESSION['ID'] = $user['id'];
      $_SESSION['CREATED_AT'] = $user['created_at'];
      $_SESSION['LAST_LOGIN'] = $user['last_login'];
      if ($_POST['REMEMBER'] == true) {
        $_SESSION['REMEMBER'] = true;
      }
  ?>
      <script type="text/javascript">
        window.location.href = 'index.php?page=index';
      </script>
<?php
      exit;
    } else {
      $msg = "Wrong email or password";
    }
  } else {
    $msg = "Wrong email or password";
  }
}
?>
<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-4 col-md-8 col-12 mx-auto">
        <div class="card z-index-0 fadeIn3 fadeInBottom">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
              <h4 class="text-white font-weight-bolder text-center mt-2 mb-0"><?php echo $msg; ?></h4>
              <div class="row mt-3">
                <div class="col-2 text-center ms-auto">
                  <a class="btn btn-link px-3" href="javascript:;">
                  <i class="fa-brands fa-facebook text-white text-lg"></i>
                  </a>
                </div>
                <div class="col-2 text-center px-1">
                  <a class="btn btn-link px-3" href="javascript:;">
                    <i class="fa-brands fa-github text-white text-lg"></i>
                  </a>
                </div>
                <div class="col-2 text-center me-auto">
                  <a class="btn btn-link px-3" href="javascript:;">
                    <i class="fa-brands fa-google fa-4x text-white text-lg"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form role="form" method="post" action="" class="text-start">
              <div class="input-group input-group-outline my-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
              </div>
              <div class="input-group input-group-outline mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="form-check form-switch d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                <label class="form-check-label mb-0 ms-3" name="REMEMBER" value="true" for="rememberMe">Remember me</label>
              </div>
              <div class="text-center">
                <button type="submit" name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
              </div>
              <p class="mt-4 text-sm text-center">
                <a href="index.php?page=register">Don't have an account?</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer position-absolute bottom-2 py-2 w-100">
    <div class="container">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-12 col-md-6 my-auto">
          <div class="copyright text-center text-sm text-white text-lg-start">
            © <script>
              document.write(new Date().getFullYear())
            </script>,
            made with <i class="fa fa-heart" aria-hidden="true"></i> by
            <a href="svenbledt.github.io" class="font-weight-bold text-white" target="_blank">Sven Bledt</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="../assets/js/plugins/parallax.min.js"></script>
<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="../assets/js/main.min.js?v=3.0.4" type="text/javascript"></script>
</body>

</html>