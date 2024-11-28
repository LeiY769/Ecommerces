<?php
include_once 'backend/session.php';
include_once 'backend/db.php';
require_once 'render_product.php';
$title = "UniDeli - Products";

// Pagination settings
$products_per_page = 12;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;

// Fetch categories
$categories = get_categories_db();
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

// Fetch search
$search_condition = "";
if(isset($_GET['search'])){
    $search_condition = $_GET['search'];
}

$conditions_sql = 'WHERE 1=1';
if (!empty($price_conditions)) {
    $conditions_sql = 'WHERE (' . implode(' OR ', $price_conditions) .')';
}
if (!empty($category_conditions)) {
    if (!empty($price_conditions)) {
        $conditions_sql .= 'AND (' . implode(' OR ', $category_conditions) . ')';
    }
    else{
        $conditions_sql = 'WHERE (' . implode(' OR ', $category_conditions).')';
    }
}
if (!empty($search_condition)) {
    if (!empty($price_conditions) || !empty($category_conditions)) {
        $conditions_sql .= 'AND name LIKE \'%'.$search_condition.'%\'';
    }
    else{
        $conditions_sql = 'WHERE name LIKE \'%'.$search_condition.'%\'';
    }
}

$total_products = get_products_filtered_db($conditions_sql, $params);
$total_pages = ceil($total_products / $products_per_page);

$products = get_products_filtered_paged_db($conditions_sql, $products_per_page, $offset, $params);

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- <head> -->
<?php include 'head_section.php'; ?>

<body>
    <!-- Include Header -->
    <?php include 'header_section.php'; ?>

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 product-sidebar-container">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">

                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>Filter by Price</h3>
                            <form method="get" action="products_page.php">
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
                                                <?php echo ucfirst(htmlspecialchars($category['category'])); ?>
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
                                <h3>Products</h3>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    <?php foreach ($products as $product): ?>
                                        <?php renderProduct($product); ?>
                                    <?php endforeach; ?>
                                    <?php
                                        if (empty($products)){
                                            echo '<div style="display:flex; justify-content:center; align-items:center; height:400px;">No results for your search 😥</div>';
                                        }
                                    ?>
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
    <?php include 'footer_section.php'; ?>

    <!-- ========================= JS here ========================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    submitForm();
                });
            });
            submitForm();
        });

        function submitForm() {
            var form = document.querySelector('.product-sidebar form');
            var formData = new FormData(form);
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            if (urlParams.has('page')){
                formData.append('page', urlParams.get('page'));
            }
            if (urlParams.has('search')){
                formData.append('search', urlParams.get('search'));
            }
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'products_page.php?' + new URLSearchParams(formData).toString(), true);
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
    <script src="assets/js/navCart.js"></script>
</body>