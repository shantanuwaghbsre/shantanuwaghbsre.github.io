<!-- Including the configuration file -->
<?php include 'config.php'; ?>
<!-- Including the header file -->
<?php include 'header.php'; ?>
    <!-- Opening div for the wishlist container -->
    <div class="product-wishlist-container">
        <!-- Opening div for the container -->
        <div class="container">
             <!-- Opening div for the row -->
            <div class="row">
                 <!-- Opening div for the column -->
                <div class="col-md-12">
                    <!-- Displaying the section heading -->
                    <h2 class="section-head">My Wishlist</h2>
                    <?php
                     // Checking if the user wishlist cookie is set and not empty
                    if(isset($_COOKIE['user_wishlist']) && !empty($_COOKIE['user_wishlist'])){
                        $pid = array(); // Initializing an array to store product IDs
                        $pid = json_decode($_COOKIE['user_wishlist']);// Decoding the JSON string stored in the cookie
                        if(is_object($pid)){// Checking if the decoded value is an object
                            $pid = get_object_vars($pid);
                             // Converting the object to an associative array
                        }
                        $pids = implode(',',$pid);// Converting the array of product IDs into a comma-separated string
                        $db = new Database();// Creating a new instance of the Database class
                        $db->select('products','*',null,"product_id IN ({$pids})",null,null);// Retrieving product details based on the stored IDs
                        $result = $db->getResult();// Getting the result of the database query
                        if(count($result) > 0){ // Checking if there are any results ?>
                            <table class="table table-bodered">
                                <thead>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                <?php foreach($result as $row){ ?>
                                     <!-- Looping through the retrieved product details -->
                                    <tr><!-- Opening table row -->
                                        <td><img src="product-images/<?php echo $row['featured_image']; ?>" alt="" width="100px" /></td>
                                         <!-- Displaying product image -->
                                        <td><?php echo $row['product_title']; ?></td>
                                        <!-- Displaying product title -->
                                        <td> <?php echo $row['product_price']; ?></td>
                                        <td><!-- Displaying product price -->
                                            <a class="btn btn-sm btn-primary remove-wishlist-item" href="" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>

                                <?php    } ?>
                                </tbody>
                            </table>
                            <a class="btn btn-sm btn-primary proceed-to-cart" href="javascript:void(0)" >Proceed to Cart</a>
                        <?php    }
                    }else{ ?>
                        <!-- If there are no products in the wishlist -->
                    <div class="empty-result">
                        No products were added to the wishlist.
                    </div>

                    <?php } ?>


                    <?php //} ?>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>