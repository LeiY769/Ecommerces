<?php
    require_once 'backend/session.php';
    require_once 'backend/db.php';
    $error = isset($_GET['error']) ? $_GET['error'] : '';
    $title = "UniDeli - Order";
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- <head> -->
<?php include 'head_section.php'; ?>

<body>
    <!-- Include Header -->
    <?php include 'header_section.php'; ?>

    <div class="shopping-cart section">
        <div class="container">
            <div class="product-grid-topbar">
                <div class="row align-items-center">
                    <h3>Order page</h3>
                </div>
            </div>
            <?php if ($error): ?>
                <p style="color:red; padding-bottom:30px;">🚨<?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->

                <!-- Cart Single List list -->
                <form action="backend/order.php" method="post" id="order_form">
                    <div class="products-list"></div>
                </form>
                <!-- End Single List list -->
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart subtotal<span id="cart-sub-total">€0</span></li>
                                        <li>Shipping <span>Free</span></li>
                                        <li>You save<span>€3</span></li>
                                        <li class="last">You pay<span id="cart-total">€0</span></li>
                                    </ul>
                                    <div class="single-form form-default button">
                                        <button type="submit" form="order_form" class="btn">Checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer Area -->
    <?php include 'footer_section.php'; ?>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/cart.js"></script>
</body>