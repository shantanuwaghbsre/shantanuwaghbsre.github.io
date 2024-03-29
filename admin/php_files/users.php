<?php

	include 'database.php';
    // Check if the 'user_view' parameter is set in the POST data
	if(isset($_POST['user_view'])){
		// Create a new Database object
		$db = new Database();
            // Escape the ID obtained from the POST data to prevent SQL injection
		$id = $db->escapeString($_POST['user_view']);
        // Select user data from the 'user' table based on the provided ID
		$db->select('user','f_name,l_name,username,email,mobile,address,city,user_role',null,"user_id = '{$id}'",null,null);
		$result = $db->getResult();
		   // Encode the result as JSON and echo it
		echo json_encode($result); exit;
	}

	if(isset($_POST['status_id'])){
		   // Extract user ID and status ID from POST data
		$id = $_POST['user_id'];
		$status_id = $_POST['status_id'];
         // Create a new Database object
		$db = new Database();
		 // Update the user role based on the status ID
		if($status_id == '1'){
			$db->update('user',array('user_role'=>'0'),"user_id = '{$id}'");
		}else{
			$db->update('user',array('user_role'=>'1'),"user_id = '{$id}'");
		}
		  // Get the result of the database operation
		$response = $db->getResult();
		 // If the response is not empty, encode success message as JSON and echo it
		if(!empty($response)){
			echo json_encode(array('sucess'=>'success'));
		}

	}


	if(isset($_POST['delete_id'])){
        // Create a new Database object
		$db = new Database();
         // Escape and extract the user ID from the POST data
		$id = $db->escapeString($_POST['delete_id']);
		 // Delete the user with the specified ID from the 'user' table
        $db->delete('user',"user_id ='{$id}'");
            // Get the result of the database operation
        $response = $db->getResult();
         // If the response is not empty, encode success message as JSON and exit
        if(!empty($response)){
            echo json_encode(array('success'=>$response)); exit;
        }

		
	} 


?>