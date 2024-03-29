<?php 
// Include configuration file and start session
include 'config.php';
// Start session
session_start(); ?>
<?php
// Check if payment request ID matches session and payment status is credit
if(($_GET['payment_request_id'] == $_SESSION['TID']) && $_GET['payment_status'] == 'Credit'){
	// Set title for successful payment
	$title = 'Payment Successful';
		// Define response message for successful payment
	$response = '<div class="panel-body">
				  	<i class="fa fa-check-circle text-success"></i>
				    <h3>Payment Successful</h3>
				    <p>Your Product Will be Delivered within 4 to 7 days.</p>
				  	<a href="'.$hostname.'" class="btn btn-md btn-primary">Continue Shopping</a>
				  </div>';

	  // reduce purchased quantity from products
				  // Initialize database connection
	    $db = new Database();
	    // Select product ID and quantity from order_products table based on payment request ID
	    $db->select('order_products','product_id,product_qty',null,"pay_req_id ='{$_GET['payment_request_id']}'",null,null);
	    // Retrieve result from database
	    $result = $db->getResult();
	    // Filter and explode product IDs and quantities
	    $products = array_filter(explode(',',$result[0]['product_id']));
	    $qty = array_filter(explode(',',$result[0]['product_qty']));
	     // Loop through each product
	    for($i=0;$i<count($products);$i++){
	    	// Update product quantity in the database
	    	$db->sql("UPDATE products SET qty = qty - '{$qty[$i]}' WHERE product_id = '{$products[$i]}'");
	    }
	    // Get result after database operation
	    $res = $db->getResult();


	  // remove cart items
	  	if(isset($_COOKIE['user_cart'])){
	  		 // Delete cart cookies if they exist
	        setcookie('cart_count','',time() - (180),'/','','',TRUE);
			setcookie('user_cart','',time() - (180),'/','','',TRUE);
	    }
}else{
	// If payment is unsuccessful
	$title = 'Payment UnSuccessful';
	$response = '<div class="panel-body">
				  	<i class="fa fa-times-circle text-danger"></i>
				    <h3>Payment Unsuccessful</h3>
				  	<a href="'.$hostname.'" class="btn btn-md btn-primary">Continue Shopping</a>
				  </div>';
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="payment-response">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="panel panel-default">
					  <?php echo $response; // Displaying the response message based on the payment status ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


