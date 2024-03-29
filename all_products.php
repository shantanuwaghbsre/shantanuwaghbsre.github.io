<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<!-- Product Section -->
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">All Products</h2>
                    <?php
                     // Define limit for pagination
                    $limit = 8;
                     // Initialize database connection
                    $db = new Database();
                     // Retrieve products from the database
                    $db->select('products','*',null,'product_status = 1 AND qty > 0','product_id DESC',$limit);
                    $result = $db->getResult();
                     // Check if products are available
                    if(count($result) > 0){
                         // Loop through each product and display details
                        foreach($result as $row){ ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image latest"> <!-- Product Image -->
                                        <a class="image" href="single_product.php?pid=<?php echo $row['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $row['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                               <!-- View Product -->
                                            <a href="single_product.php?pid=<?php echo $row['product_id']; ?>" ><i class="fa fa-eye"></i></a> <!-- Add to Cart -->
                                            <a href="" class="add-to-cart" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>   <!-- Add to Wishlist -->
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <!-- Product Title -->
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo $row['product_title']; ?></a>
                                        </h3>
                                            <!-- Product Price -->
                                        <div class="price"> <?php echo $row['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                    } ?>
                </div>
                <div class="col-md-12">
                     <!-- Pagination -->
                    <div class="pagination-outer">
                    <?php echo $db->pagination('products',null,'product_status = 1 AND qty > 0',$limit); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Product Section -->
<?php include 'footer.php'; ?>