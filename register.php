<?php
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Contact Us - All you need in one place.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? </h3>
                            <p>Register a new account takes a few seconds!⚡</p>
                            <?php if ($error): ?>
                                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
                            <?php endif; ?>
                        </div>
                        <form class="row" method="post" action="backend/register_process.php">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">First Name</label>
                                    <input class="form-control" type="text" id="reg-fn" name="first_name" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-ln">Last Name</label>
                                    <input class="form-control" type="text" id="reg-ln" name="last_name" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <input class="form-control" type="text" id="reg-email" name="email" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-username">Username</label>
                                    <input class="form-control" type="text" id="reg-phone" name="username" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <input class="form-control" type="password" id="reg-pass" name="password" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <input class="form-control" type="password" id="reg-pass-confirm" name="password_confirm" >
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="login.php">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->

    <!-- Include Footer Area -->
    <?php include 'footer.php'; ?>

    <!-- ========================= JS here ========================= -->
</body>