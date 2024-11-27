<?php
include_once 'backend/session.php';
include_once 'backend/db.php';

$categories = get_categories_db();
?>

<header class="header navbar-area">
    <!-- Start Topbar -->
    <div class="sticky-header">
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <ul class="menu-top-link">
                                <li>
                                    <div class="select-position">
                                        <select id="select4">
                                            <option value="0" selected>€ EURO</option>
                                            <option value="1">$ USD</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="select-position">
                                        <select id="select5">
                                        <option value="0" selected>English</option>
                                            <option value="1" >Français</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">
                            <div class="user">
                                <?php if (isLoggedIn()): ?>
                                    <i class="lni lni-user"></i>
                                    <?php echo 'Hello, ' . htmlspecialchars($_SESSION['first_name']) . ' ' . htmlspecialchars($_SESSION['last_name']); ?>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                            <ul class="user-login">
                                <?php if (isLoggedIn()): ?>
                                    <li>
                                        <a href="?logout=true">Logout</a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="login_page.php">Sign In</a>
                                    </li>
                                    <li>
                                        <a href="register_page.php">Register</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Start Header Middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <!-- Start Header Logo -->
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/images/logo/logo.png" alt="Logo">
                    </a>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <!-- Start Main Menu Search -->
                    <div class="main-menu-search">
                        <!-- navbar search start -->
                        <div class="navbar-search search-style-5">
                        <form action="products_page.php" method="get" style="display: flex; align-items: center; width: 100%; margin: 0; padding: 0; border: none;">
                                <div class="search-select">
                                    <div class="select-position">
                                        <select id="select1" name="category">
                                            <option selected>All</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo htmlspecialchars($category['category']); ?>">
                                                    <?php echo ucfirst(htmlspecialchars($category['category'])); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="search-input">
                                    <input type="text" name="search" placeholder="Search">
                                </div>
                                <div class="search-btn">
                                    <button><i class="lni lni-search-alt"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- navbar search Ends -->
                    </div>
                    <!-- End Main Menu Search -->
                </div>
                <?php if (!str_contains(basename($_SERVER['PHP_SELF']), "order_page")){?>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="right-area">
                        <div class="navbar-cart">
                            <div class="cart-items">
                                <a class="main-btn">
                                    🍽️
                                    <span class="total-items">0</span>
                                </a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>0 Items</span>
                                    </div>
                                    <?php if(isLoggedIn()){
                                        echo '<div class="content" id="empty-cart">
                                            Your order is empty 🏜️
                                        </div>';
                                    } else {
                                        echo '<div class="content must-be-logged">
                                            You must be logged in to order 🫤
                                        </div>';
                                    }?>
                                    <ul class="shopping-list">
                                        
                                    </ul>
                                    <?php if(!isLoggedIn()){
                                        echo '<div class="bottom">
                                            <div class="button">
                                                <a href="login_page.php" class="btn animate">Log in</a>
                                            </div>
                                        </div>';
                                    }else {
                                        echo '
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">€0</span>
                                        </div>
                                        <div class="bottom">
                                            <div class="button">
                                                <a href="order_page.php" class="btn animate">Order</a>
                                            </div>
                                        </div>';
                                    }?>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->
</header>