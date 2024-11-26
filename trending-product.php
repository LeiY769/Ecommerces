<?php
require_once 'backend/utility.php';

// Connect to the database
$conn = connect_to_db();

// Fetch products from the database
$stmt = $conn->prepare("SELECT * FROM Product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
function renderProduct($product)
{
    ?>
    <div class="col-lg-3 col-md-6 col-12">
        <!-- Start Single Product -->
        <div class="single-product">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="#">
                <div class="button">
                    <a href="product-details.html" class="btn">🍽️ Add to cart</a>
                </div>
            </div>
            <div class="product-info">
                <span class="category"><?php echo ucfirst(htmlspecialchars($product['category'])); ?></span>
                <h4 class="title">
                    <a href="product-details.html"><?php echo htmlspecialchars($product['name']); ?></a>
                </h4>
                <div class="price">
                    <span><?php echo '€' . number_format($product['price'], 2); ?></span>
                    <?php if (!empty($product['discount_price'])): ?>
                        <span class="discount-price"><?php echo '€' . number_format($product['discount_price'], 2); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- End Single Product -->
    </div>
    <?php
}
?>

<section class="trending-product section" style="margin-top: 12px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending food ❤️‍🔥</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($products as $product) {
                renderProduct($product);
            }
            ?>

        </div>
    </div>
</section>