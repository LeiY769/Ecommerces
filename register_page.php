<?php
include_once 'backend/session.php';
include_once 'backend/db.php';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$title = "UniDeli - Register";
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- <head> -->
<?php include 'head_section.php'; ?>

<body>
    <!-- Include Header -->
    <?php include 'header_section.php'; ?>

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
                        <form class="row" method="post" action="backend/register.php">
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
                            <p class="outer-link">Already have an account? <a href="login_page.php">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->

    <!-- Include Footer Area -->
    <?php include 'footer_section.php'; ?>

    <!-- ========================= JS here ========================= -->
</body>