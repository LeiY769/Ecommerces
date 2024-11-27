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

    <!-- Include Hero Area -->
    <?php include 'hero_section.php'; ?>
    
    <!-- Include Shipping Info Area -->
    <?php include 'shipping_info_section.php'; ?>

    <!-- Include Trending Product Area -->
    <?php include 'deals_section.php'; ?>

    <!-- Include Footer Area -->
    <?php include 'footer_section.php'; ?>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/navCart.js"></script>
    <script src="assets/js/index.js"></script>
</body>