<div id="content">
<?php include 'config.php'; // Include the configuration file
  // Create a new instance of the Database class
$db = new Database();

 // Set dynamic title
$title = "Shopping Project";
// include header 
include 'header.php'; ?>

<div id="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-content " style="height:115vh;">
                    <div class="banner-carousel owl-carousel owl-theme">
                        <div class="item">
                            <img src="images/rishigyan.jpg" alt=""/>
                        </div>
                        <div class="item">
                            <img src="images/img.webp" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-section popular-products">
       <!-- Container for popular products -->
    <div class="container">
         <!-- Row to contain the content -->
        <div class="row">
            <div class="col-md-12">
                   <!-- Section heading -->
                <h2 class="section-head">Popular Products</h2>
                   <!-- Carousel for popular products -->
                <div class="popular-carousel owl-carousel owl-theme">
                    <?php
                     // Selecting popular products from the database
                        $db->select('products','*',null,'product_views > 0','product_views DESC',10);
                        $result = $db->getResult();
                         // Checking if there are any popular products
                        if(count($result) > 0){
                            // Looping through the popular products
                            foreach($result as $row){ ?>
                                <!-- Individual product grid -->
                    <div class="product-grid latest item">
                        <div class="product-image popular">
                             <!-- Link to the single product page -->
                            <a class="image" href="single_product.php?pid=<?php echo $row['product_id']; ?>">
                                  <!-- Product image -->
                                <img class="pic-1" src="product-images/<?php echo $row['featured_image']; ?>">
                            </a>
                             <!-- Button group for product actions -->
                            <div class="product-button-group">
                                   <!-- Button to view product details -->
                                <a href="single_product.php?pid=<?php echo $row['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                <!-- Button to add product to cart -->
                                <a href="" class="add-to-cart" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                <!-- Button to add product to wishlist -->
                                <a href="" class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                         <!-- Product content -->
                        <div class="product-content">
                              <!-- Title of the product -->
                            <h3 class="title">
                                  <!-- Link to the single product page -->
                                <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo substr($row['product_title'],0,50),''; ?></a>
                            </h3>
                             <!-- Price of the product -->
                            <div class="price" style="display:flex; justify-content:center;">
                                 <!-- Currency symbol -->
                                <div>&#8377;</div>
                                 <!-- Product price -->
                                <?php echo $row['product_price']; ?></div>
                        </div>
                    </div>
                    <!-- End of individual product grid -->
                    <?php    }
                    }else{
                } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">Latest Products</h2>
                <div class="latest-carousel owl-carousel owl-theme">
                    <?php
            $db = new Database();
            $db->select('products','*',null,null,'product_id DESC',6);
            $result = $db->getResult();
            if(count($result) > 0){
                foreach($result as $row){ ?>
                    <div class="product-grid latest item">
                        <div class="product-image popular">
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
                                <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo substr($row['product_title'],0,50),''; ?></a>
                            </h3>
                            <div class="price" style="display:flex; justify-content:center;"><div>&#8377;</div> <?php echo $row['product_price']; ?></div>
                        </div>
                    </div>
        <?php    }
            }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</div>