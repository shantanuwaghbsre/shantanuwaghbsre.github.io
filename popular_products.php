<?php include 'config.php'; ?> <!-- Include the configuration file -->
<?php include 'header.php'; ?> <!-- Include the header file -->

    <div class="product-section content"> <!-- Container for the product section -->
        <div class="container">  <!-- Bootstrap container -->
            <div class="row"> <!-- Bootstrap row -->
                <div class="col-md-12">  <!-- Column for the main content -->
                    <h2 class="section-head">Popular Products</h2> <!-- Section heading -->
                    <?php
                    $limit = 8;  // Limit of products to display
                    $db = new Database(); // Create a new instance of the database class
                    $db->select('products','*',null,'product_views > 0 AND product_status = 1 AND qty > 0','product_views DESC',$limit);
                    $result = $db->getResult();
                    if(count($result) > 0){
                         // Check if there are products to display
                        foreach($result as $row){ ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image latest">
                                        <a class="image" href="single_product.php?pid=<?php echo $row['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $row['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $row['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo $row['product_title']; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $row['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="pagination-outer">
                    <?php echo $db->pagination('products',null,'product_views > 0 AND product_status = 1 AND qty > 0',$limit); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'footer.php'; ?>