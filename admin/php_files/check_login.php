<?php
 // database class
    include 'database.php';

if(isset($_POST['login'])){
    // Check if the 'name' field is set and not empty
   
    if(!isset($_POST['name']) || empty($_POST['name'])){
        // If 'name' is not set or empty, return an error message and exit
        echo json_encode(array('error'=>'name_empty')); exit;
    }// Check if the 'pass' field is set and not empty
    elseif(!isset($_POST['pass']) || empty($_POST['pass'])){
        // If 'pass' is not set or empty, return an error message and exit
        echo json_encode(array('error'=>'pass_empty')); exit;
    }else{
        
        $db = new Database();  // Create a new Database instance

        // Escape and sanitize the 'name' and 'pass' values to prevent SQL injection
        $username = $db->escapeString($_POST["name"]);
        $password = md5($db->escapeString($_POST["pass"])); 

         // Select records from the 'admin' table where username and password match
        $db->select('admin','admin_name',null,"username = '$username' AND password = '$password'",null,0); 
         // Get the result of the SELECT query
        $result = $db->getResult();

        if(!empty($result)){
            /* Start the session */
            session_start();
            /* Set session variables */
            $_SESSION["admin_name"] = $result[0]['admin_name'];
            $_SESSION["admin_role"] = 'admin'; /* for admin */
            echo json_encode(array('success'=>'true')); exit;
        }else{
            echo json_encode(array('error'=>'flase')); exit;
        }
    }
}


if(isset($_POST['changePass'])){
    // Check if the 'old_pass' field is set and not empty
    if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
        // If 'old_pass' is not set or empty, return an error message and exit
        echo json_encode(array('error'=>'Old password is empty.')); exit;
    } // Check if the 'new_pass' field is set and not empty
    else if(!isset($_POST['new_pass']) || empty($_POST['old_pass'])){
        // If 'new_pass' is not set or empty, return an error message and exit
        echo json_encode(array('error'=>'New password is empty.')); exit;
    }else{

        $db = new Database();  // Create a new Database instance
         // Escape and sanitize the 'old_pass' and 'new_pass' values to prevent SQL injection
        $old = md5($db->escapeString($_POST["old_pass"]));
        $new = md5($db->escapeString($_POST["new_pass"]));
        // Update the password in the 'admin' table where the old password matches
        $db->update('admin',array('password'=>$new),"password = '{$old}'");
            // Get the result of the UPDATE query
        $response = $db->getResult();
         // If the update was successful, return a success message and exit
        if(!empty($response)){
            echo json_encode(array('success'=>'1')); exit;
        }
    }
}



?>
