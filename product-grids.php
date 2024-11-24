<?php
require_once 'backend/utility.php';


// Connect to the database
$conn = connect_to_db();

// Pagination settings
$products_per_page = 12;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;

// Fetch categories
$category_stmt = $conn->prepare("SELECT DISTINCT category FROM Product");
$category_stmt->execute();
$categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);
$category_filter = isset($_GET['category']) ? (array) $_GET['category'] : [];
$category_conditions = [];



// Fetch total number of products with filters
$price_filter = $_GET['price'] ?? [];
$price_conditions = [];
$params = [];

if (in_array('0-5', $price_filter)) {
    $price_conditions[] = "(price BETWEEN 0 AND 5)";
}
if (in_array('5-10', $price_filter)) {
    $price_conditions[] = "(price BETWEEN 5 AND 10)";
}
if (in_array('10-15', $price_filter)) {
    $price_conditions[] = "(price BETWEEN 10 AND 15)";
}

if (!empty($category_filter)) {
    foreach ($category_filter as $index => $category) {
        $category_conditions[] = "category = :category_$index";
        $params[":category_$index"] = $category;
    }
}

$conditions_sql = 'WHERE 1=1';
if (!empty($price_conditions) && !empty($category_conditions)) {
    $conditions_sql = 'WHERE (' . implode(' OR ', $price_conditions) . ') AND (' . implode(' OR ', $category_conditions) . ')';
} elseif (!empty($price_conditions)) {
    $conditions_sql = 'WHERE ' . implode(' OR ', $price_conditions);
} elseif (!empty($category_conditions)) {
    $conditions_sql = 'WHERE ' . implode(' OR ', $category_conditions);
}

$total_products_stmt = $conn->prepare("SELECT COUNT(*) FROM Product $conditions_sql");
$total_products_stmt->execute($params);
$total_products = $total_products_stmt->fetchColumn();
$total_pages = ceil($total_products / $products_per_page);

// Fetch products for the current page with filters
$stmt = $conn->prepare("SELECT * FROM Product $conditions_sql LIMIT $products_per_page OFFSET $offset");
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

function renderProduct($product)
{
    ?>
    <div class="col-lg-4 col-md-6 col-12">
        <!-- Start Single Product -->
        <script></script>
        <div class="single-product">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="#">
                <div class="button">
                    <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                </div>
            </div>
            <div class="product-info">
                <span class="category"><?php echo htmlspecialchars($product['category']); ?></span>
                <h4 class="title">
                    <a href="product-details.html"><?php echo htmlspecialchars($product['name']); ?></a>
                </h4>
                <div class="price">
                    <span><?php echo '$' . number_format($product['price'], 2); ?></span>
                    <?php if (!empty($product['discount_price'])): ?>
                        <span class="discount-price"><?php echo '$' . number_format($product['discount_price'], 2); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- End Single Product -->
    </div>
    <?php
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>UniDeli - All you need in one place.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    submitForm();
                });
            });

            // Appel initial pour charger les produits via AJAX
            submitForm();
        });

        function submitForm() {
            var form = document.querySelector('.product-sidebar form');
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'product-grids.php?' + new URLSearchParams(formData).toString(), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(xhr.responseText, 'text/html');
                    var newContent = doc.querySelector('.product-grids-head').innerHTML;
                    document.querySelector('.product-grids-head').innerHTML = newContent;
                }
            };
            xhr.send();
        }
    </script>

</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Shop Grid</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)">Shop</a></li>
                        <li>Shop Grid</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">

                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>Filter by Price</h3>
                            <form method="get" action="product-grids.php">
                                <div class="single-widget condition">
                                    <h3>Filter by Price</h3>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price[]" value="0-5"
                                            id="price1" <?php echo in_array('0-5', $price_filter) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="price1">
                                            $0 - $5
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price[]" value="5-10"
                                            id="price2" <?php echo in_array('5-10', $price_filter) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="price2">
                                            $5 - $10
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="price[]" value="10-15"
                                            id="price3" <?php echo in_array('10-15', $price_filter) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="price3">
                                            $10 - $15
                                        </label>
                                    </div>
                                </div>
                                <div class="single-widget condition">
                                    <h3>Filter by Category</h3>
                                    <?php foreach ($categories as $category): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category[]"
                                                value="<?php echo htmlspecialchars($category['category']); ?>"
                                                id="category_<?php echo htmlspecialchars($category['category']); ?>" <?php echo in_array($category['category'], $category_filter) ? 'checked' : ''; ?>>
                                            <label class="form-check-label"
                                                for="category_<?php echo htmlspecialchars($category['category']); ?>">
                                                <?php echo htmlspecialchars($category['category']); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- End Product Sidebar -->
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <h3>Available product</h3>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    <?php foreach ($products as $product): ?>
                                        <?php renderProduct($product); ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Pagination -->
                                    <div class="pagination left">
                                        <ul class="pagination-list">
                                            <?php if ($page > 1): ?>
                                                <li><a href="?page=<?php echo $page - 1; ?>"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="<?php echo $i == $page ? 'active' : ''; ?>"><a
                                                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php endfor; ?>
                                            <?php if ($page < $total_pages): ?>
                                                <li><a href="?page=<?php echo $page + 1; ?>"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <!--/ End Pagination -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Product Grids -->

    <!-- Include Footer Area -->
    <?php include 'footer.php'; ?>

    <!-- ========================= JS here ========================= -->
</body>