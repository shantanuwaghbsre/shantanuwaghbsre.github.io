<?php
     // Include the database configuration file
    include '../config.php';
    // Get the order_id from the URL parameters
    $order_id = $_GET["id"];
    /*sql to delete a record*/
    // SQL to delete a record from the order_products table where order_id matches
    $sql = "DELETE FROM order_products WHERE order_id ='{$order_id}'";
     // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        header("location:{$hostname}/admin/orders.php");
    } 
     // Close the database connection
    mysqli_close($conn);
?>