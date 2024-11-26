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

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form action="backend/verification.php" class="card login-form" method="post" id="login_form">
                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <?php
                                    if (isset($_GET['error'])) {
                                        $err = $_GET['error'];
                                        if ($err == 1)
                                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                                        if ($err == 2)
                                            echo "<p style='color:red'>Utilisateur ou mot de passe incomplet</p>";
                                    }
                                    if (isset($_GET['success'])){
                                        echo "<p style=\"color:green;\">".htmlspecialchars($_GET['success'])."</p><br><br>";
                                    }
                                ?>
                                <div class="form-group input-group">
                                    <label for="reg-fn">Username</label>
                                    <input name="username" class="form-control" type="text" id="reg-email" required>
                                </div>
                                <div class="form-group input-group">
                                    <label for="reg-fn">Password</label>
                                    <input name="password" class="form-control" type="password" id="reg-pass" required>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between bottom-content">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input width-auto" id="exampleCheck1">
                                        <label class="form-check-label">Remember me</label>
                                    </div>
                                </div>
                                <div class="button">
                                    <button class="btn" type="submit" id='submit' value='login'>Login</button>
                                </div>
                                <p class="outer-link">Don't have an account? <a href="register.php">Register here </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <canvas id="confetti" style="position:absolute; top:0; left:0; z-index:100000;"></canvas>

    <!-- End Account Login Area -->
    <!-- Include Footer Area -->
    <?php include 'footer.php'; ?>
    
    <!-- ========================= JS here ========================= -->
    <script src="assets/js/main.js"></script>
</body>