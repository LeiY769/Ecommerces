<?php
function renderProduct($product)
{?>

    <div class="col-lg-4 col-md-6 col-12">
        <!-- Start Single Product -->
        <div class="single-product">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="#">
                <div class="button">
                    <button class="btn add-to-cart"
                        product-id="<?php echo htmlspecialchars($product['product_id']); ?>"
                        product-name="<?php echo htmlspecialchars($product['name']); ?>"
                        product-price="<?php echo htmlspecialchars($product['price']); ?>"
                        product-image="<?php echo htmlspecialchars($product['image']); ?>">
                        🍽️ Add
                    </button>
                </div>
            </div>
            <div class="product-info">
                <span class="category"><?php echo ucfirst(htmlspecialchars($product['category'])); ?></span>
                <h4 class="title">
                    <a href="product-details.html"><?php echo htmlspecialchars($product['name']); ?></a>
                </h4>
                <div class="price">
                    <?php
                        if (!empty($product['discount_price'])){
                            echo '<span> €'. $product['discount_price'] . '</span>';
                            echo '<span class="discount-price"> €'. $product['price'] . '</span>';
                        }
                        else{
                            echo '<span> €'. $product['price'] . '</span>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- End Single Product -->
    </div>
<?php }
?>