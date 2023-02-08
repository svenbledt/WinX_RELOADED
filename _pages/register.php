<?php
$nofooter = true;
$msg = "Register";
if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
?>
    <script type="text/javascript">
        window.location.href = 'index.php?page=index';
    </script>
    <?php
    exit;
}
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Check if the password is valid
    if (pwdValidate($_POST['password'])) {
        // Check if the email is valid
        if (mailValidate($_POST['email'])) {
            // Check if the username is valid
            if (userValidate($_POST['username'])) {
                register($conn, $_POST['email'], $_POST['password'], $_POST['username']);
                $_SESSION['EMAIL'] = $_POST['email'];
                $_SESSION['USERNAME'] = $post['username'];
                $_SESSION['ID'] = $conn->lastInsertId();
                $_SESSION['CREATED_AT'] = getTimestamp();
                $_SESSION['LOGGEDIN'] = true;
    ?>
                <script type="text/javascript">
                    window.location.href = 'index.php?page=index';
                </script>
<?php
                exit;
            } else {
                // Username is not valid
                $msg = "Username must be at least 3 characters long and contain only letters and numbers.";
                exit;
            }
        } else {
            // Email is not valid
            $msg = "Email is not valid";
            exit;
        }
    } else {
        // Password is not valid
        $msg = "Password must be at least 8 characters long and contain at least one number, one uppercase letter and one lowercase letter.";
        exit;
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
                                        <i class="fa fa-facebook text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center px-1">
                                    <a class="btn btn-link px-3" href="javascript:;">
                                        <i class="fa fa-github text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center me-auto">
                                    <a class="btn btn-link px-3" href="javascript:;">
                                        <i class="fa fa-google text-white text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="" class="text-start">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Username</label>
                                <input name="username" type="username" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Repeat password</label>
                                <input name="password2" type="password" class="form-control" required>
                            </div>
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe" required>
                                <label name="policy" class="form-check-label mb-0 ms-3" for="rememberMe">Accept pricacy policy and terms of use conditions</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                            </div>
                            <p class="mt-4 text-sm text-center">
                                <a href="index.php?page=sign-in">Already have an account</a>
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
<script src="../assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
</body>

</html>