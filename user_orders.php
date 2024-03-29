<?php
// Including the configuration file to establish a database connection
include 'config.php';
// Starting a session to maintain user data across multiple pages
session_start();
// Checking if the user is logged in and has the role of a regular user
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
// Including the header file to display the user interface
    include 'header.php'; ?>
    <div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <!-- Displaying a section header for the "My Orders" section -->
                    <h2 class="section-head">My Orders</h2>
                    <?php
                    // Retrieving the user ID from the session
                        $user = $_SESSION['user_id'];
                        // Creating a new instance of the Database class
                        $db = new Database();
                        // Executing an SQL query to fetch order details
                        $db->sql('SELECT order_products.product_id,order_products.order_id,order_products.total_amount,order_products.product_qty,order_products.delivery,order_products.product_user,order_products.order_date,products.featured_image,user.f_name,user.address,user.city,payments.payment_status,GROUP_CONCAT(DISTINCT products.product_title ORDER BY products.product_id SEPARATOR "$$") as product_titles,GROUP_CONCAT(DISTINCT products.featured_image ORDER BY products.product_id) as product_images,GROUP_CONCAT(DISTINCT products.product_price ORDER BY products.product_id) as product_prices FROM order_products LEFT JOIN products ON FIND_IN_SET(products.product_id,order_products.product_id) > 0
                     LEFT JOIN user ON order_products.product_user=user.user_id LEFT JOIN payments ON payments.txn_id = order_products.pay_req_id WHERE product_user = '.$user.' GROUP BY order_products.order_id ORDER BY order_products.order_id DESC');
                        // Getting the result of the query
                        $result = $db->getResult();
                        // Checking if there are any orders associated with the user
                        if(count($result) > 0){ ?>
                            <?php foreach($result as $row){  
                                    for($i=0;$i<count($row);$i++){
                                    ?>
                                     <!-- Displaying a table to show order details -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="active">
                                        <th colspan="3"><h4><b>ORDER No. : <?php echo 'ODR00'.$row[$i]['order_id']; ?></b></h4></th>
                                        <th width="200px"><b>Order Placed : </b><?php echo date('d M, Y',strtotime($row[$i]['order_date'])); ?></th>
                                    </tr>
                                    <?php
                                    // Extracting product titles, prices, quantities, and images from the database result
                                    $product_titles = array_filter(explode('$$',$row[$i]['product_titles']));
                                    $product_prices = array_filter(explode(',',$row[$i]['product_prices']));
                                    $product_qty = array_filter(explode(',',$row[$i]['product_qty']));
                                    $product_images = array_filter(explode(',',$row[$i]['product_images']));
                                    // Looping through each product in the order
                                        for($p=0;$p<count($product_qty);$p++){
                                    ?>
                                    <tr>
                                        <td>
                                             <!-- Displaying the product image -->
                                            <img class="img-thumbnail" src="product-images/<?php echo $product_images[$p]; ?>" alt="" width="100px" />
                                        </td>
                                        <td> <!-- Displaying product details -->
                                            <span><b>Product Name :</b> <?php echo $product_titles[$p]; ?></span><br/>
                                            <span><b>Product Price :</b> <?php.' '.$product_prices[$p]; ?></span><br/>
                                            <span><b>Quantity :</b> <?php echo $product_qty[$p]; ?></span><br/>
                                        </td>
                                        <td>
                                        <?php
                                         // Determining the delivery status and setting appropriate label
                                         if($row[$i]['delivery'] == '1'){
                                                $status = '<label class="label label-success">Delivered</label>';
                                            }
                                            else{
                                                $status = '<label class="label label-primary">In - Process</label>';
                                            } ?>
                                              <!-- Displaying the delivery status -->
                                            <b>Status : </b><?php  echo $status; ?>
                                        </td>
                                        <td><!-- Displaying the expected delivery date range -->
                                            <span><b>Delivery Expected By :</b> <?php echo date('d',strtotime($row[$i]['order_date']. ' +4 day')); ?> - <?php echo date('d F, Y',strtotime($row[$i]['order_date']. ' +7 day')); ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3" align="right"><b>Total Amount</b></td>
                                        <td><b></b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php } 
                                }?>
                        <?php    }else{ ?>
                             <!-- Displaying a message if no orders are found -->
                                <div class="empty-result">
                        No Orders Found.
                    </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';

}else{
    header("Location: " . $hostname);
}
?>