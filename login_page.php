<?php 
    require_once 'backend/session.php';
    require_once 'backend/db.php';
    $title = "UniDeli - Login";
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- <head> -->
<?php include 'head_section.php'; ?>

<body>
    <!-- Include Header -->
    <?php include 'header_section.php'; ?>

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form action="backend/login.php" class="card login-form" method="post" id="login_form">
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
                                <div class="button">
                                    <button class="btn" type="submit" id='submit' value='login'>Login</button>
                                </div>
                                <p class="outer-link">Don't have an account? <a href="register_page.php">Register here </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <canvas id="confetti" style="position:absolute; top:0; left:0; z-index:100000;"></canvas>

    <!-- Include Footer Area -->
    <?php include 'footer_section.php'; ?>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/confettis.js"></script>
    <script src="assets/js/navCart.js"></script>
</body>