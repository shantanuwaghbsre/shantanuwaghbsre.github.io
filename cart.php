<?php include 'config.php'; ?> <!-- Including configuration file -->
<?php include 'header.php'; ?> <!-- Including header file -->
<!-- Container for product cart -->
<div class="product-cart-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                  <!-- Title for My Cart Section -->
                <h2 class="section-head">My Cart</h2>
                <?php
                // Checking if user cart cookie is set
                    if(isset($_COOKIE['user_cart'])){
                        // Getting product IDs from cart cookie
                        $pid = json_decode($_COOKIE['user_cart']);
                        if(is_object($pid)){
                            $pid = get_object_vars($pid);
                        }
                        $pids = implode(',',$pid); // Converting array of product IDs to string
                        $db = new Database();
                        // Retrieving product details from database based on product IDs
                        $db->select('products','*',null,'product_id IN ('.$pids.')',null,null);
                        // Getting the result from the database query
                        $result = $db->getResult();
                        // Checking if products are found in the cart
                        if(count($result) > 0){ ?>
                              <!-- Table to display cart items -->
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th width="120px">Product Price</th>
                                    <th width="100px">Qty.</th>
                                    <th width="100px">Sub Total</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                <?php foreach($result as $row){ ?>
                                    <tr class="item-row">
                                          <!-- Displaying product image -->
                                        <td><img src="product-images/<?php echo $row['featured_image']; ?>" alt="" width="70px" /></td>
                                        <td><?php echo $row['product_title']; ?></td>
                                        <td> <span class="product-price"><?php echo $row['product_price']; ?></span></td>
                                        <td> <!-- Input field for quantity -->
                                            <input class="form-control item-qty" type="number" value="1"/>
                                             <!-- Hidden inputs for product ID and price -->
                                            <input type="hidden" class="item-id" value="<?php echo $row['product_id']; ?>"/>
                                            <input type="hidden" class="item-price" value="<?php echo $row['product_price']; ?>"/>
                                        </td>
                                          <!-- Displaying subtotal -->
                                        <td> <span class="sub-total"><?php echo $row['product_price']; ?></span></td>
                                        <td> <!-- Button to remove item from cart -->
                                            <a class="btn btn-sm btn-primary remove-cart-item" href="" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                        <?php    } ?> <!-- Row to display total amount -->
                                    <tr>
                                        <td colspan="5" align="right"><b>TOTAL AMOUNT ()</b></td>
                                        <td class="total-amount"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                 <!-- Button to continue shopping -->
                                <a class="btn btn-sm btn-primary" href="<?php echo $hostname; ?>" >Continue Shopping</a>
                                 <!-- Checking if user is logged in -->
                                <?php if(isset($_SESSION['user_role'])){ ?>
                                  <!-- Checkout form -->
                                <form action="instamojo.php" class="checkout-form pull-right" method="POST">
                                    <?php
                                        $product_id = '';
                                        foreach($result as $row){
                                            $product_id .= $row['product_id'].',';
                                        }
                                    ?>
                                     <!-- Hidden inputs for checkout -->
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <input type="hidden" name="product_total" class="total-price" value="">
                                    <input type="hidden" name="product_qty" class="total-qty" value="1">
                                      <!-- Checkout button -->
                                    <input type="submit" class="btn btn-md btn-success" value="Proceed to Checkout">
                                </form>
                                <?php }else{ ?>
                                     <!-- Button to proceed to checkout (login required) -->
                                    <a class="btn btn-sm btn-success pull-right" href="#" data-toggle="modal" data-target="#userLogin_form" >Proceed to Checkout</a>
                                <?php } ?>
                <?php   }
                    }else{ ?>
                            <!-- Message for empty cart -->
                        <div class="empty-result">
                            Your cart is currently empty.
                        </div>
                    <?php }
                ?>


            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>