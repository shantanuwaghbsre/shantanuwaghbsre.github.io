<?php 
include 'config.php';
// Starting the session
session_start();
// Getting the username from the session
$user = $_SESSION['username'];
// Creating a new instance of the Database class
$db = new Database();

// Initializing cURL
$ch = curl_init();
// Setting cURL options
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_f95508c7ff3dc44e5240321ee4c",
                  "X-Auth-Token:test_6a29ac898bb6e073597e3c1ed8a"));
// Setting payload data for the Instamojo payment request
$payload = Array(
    'purpose' => 'Payment to '.$site_name[0]['site_name'],
    'amount' => $_POST['product_total'],
    // 'phone' => '',
    'buyer_name' => $user,
    'redirect_url' => $hostname.'/success.php',
    // 'send_email' => true,
    // 'webhook' => 'http://www.example.com/webhook/',
    // 'send_sms' => true,
    // 'email' => 'rainkapil@gmail.com',
    'allow_repeated_payments' => false
);
// Setting cURL options to perform a POST request with the payload data
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
// Executing the cURL request and storing the response
$response = curl_exec($ch);
// Closing the cURL session
curl_close($ch);
// Decoding the JSON response into a PHP object
$response = json_decode($response); 
 //echo '<pre>';
 //print_r($response);
//exit;
// Storing the payment request ID in the session
$_SESSION['TID'] = $response->payment_request->id;
// Creating parameters for transaction logging or processing
$params1 = [
    'item_number' => $_POST['product_id'],
    'txn_id' => $response->payment_request->id,
    'payment_gross' => $_POST['product_total'],
    'payment_status' => 'credit',
];
// Creating parameters for inserting payment details into the database
$params2 = [
    'product_id' => $_POST['product_id'],
    'product_qty' => $_POST['product_qty'],
    'total_amount' => $_POST['product_total'],
    'product_user' => $_SESSION['user_id'],
    'order_date' => date('Y-m-d'),
    'pay_req_id' => $response->payment_request->id
];
// Creating a new instance of the Database class
$db = new Database();
// Inserting payment details into the 'payments' table
$db->insert('payments',$params1);
// Inserting order details into the 'order_products' table
$db->insert('order_products',$params2);
// Getting the result of the database operation
$db->getResult();
// Redirecting the user to the payment gateway's long URL
header('Location: '.$response->payment_request->longurl);

?>