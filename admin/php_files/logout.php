<?php

     // Include the configuration file
    include 'config.php';
    /* Start the session */
    session_start();
    /* remove all session variables */
    session_unset(); 
    /* destroy the session */
    session_destroy();

// Redirect to the index.php page
header("location:{$base_url}/");
?>