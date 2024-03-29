<?php 
// Include the 'database.php' file which likely contains the database connection class and functions
include 'database.php';


// Check if the 'complete' parameter is set in the POST request
if(isset($_POST['complete'])){
     // Create a new Database instance
	$db = new Database();
	// Sanitize the 'complete' parameter to prevent SQL injection
	$order_id = $db->escapeString($_POST['complete']);
	 // Update the 'delivery' status of order products to '1' (complete) where 'order_id' matches
	$db->update('order_products',['delivery'=>'1'],"order_id='{$order_id}'");
	// Get the result of the update operation
	$result = $db->getResult();
	 // If the update operation was successful (result[0] equals '1')
	if($result[0] == '1'){
		  // Echo 'true' to indicate successful completion and exit the script
		echo 'true'; exit;
	}
}

 ?>
