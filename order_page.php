<?php
    require_once 'backend/session.php';
    require_once 'backend/db.php';
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
                <div class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="product-details.html"><img src="assets/images/cart/01.jpg" alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="product-details.html">
                                    Canon EOS M50 Mirrorless Camera</a></h5>
                            <p class="product-des">
                                <span><em>Unit price :</em> €5</span>
                                <span><em>Discount price :</em> €4</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input name="quantity" class="form-control productQuantity" type="number" product-id="1">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>$910.00</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" href="javascript:void(0)"><i class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
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
                                        <li>Cart Subtotal<span>$2560.00</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="checkout_page.php" class="btn">Checkout</a>
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