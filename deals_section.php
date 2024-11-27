<?php
require_once 'backend/db.php';
require_once 'render_product.php';

$products = get_promotions();
?>

<section class="trending-product section" style="margin-top: 12px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Week deals ❤️‍🔥</h2>
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