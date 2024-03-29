<?php
	include 'database.php'; // Include the database configuration file

    if( isset($_POST['create']) ){
    	// Check if the 'cat' field is set and not empty
    	if(!isset($_POST['cat']) || empty($_POST['cat'])){
    		// If 'cat' is not set or empty, return an error message
    		echo json_encode(array('error'=>'Category Field is Empty.'));
    	}else{
    		// Create a new Database instance
    		$db = new Database();

            // Escape the 'cat' value to prevent SQL injection
    		$category = $db->escapeString($_POST['cat']);
            
            // Check if the category already exists in the database
    		$db->select('categories','cat_title',null,"cat_title = '{$category}'",null,null);
    		// Get the result of the SELECT query
    		$exist = $db->getResult();
    		 // If the category already exists, return an error message
    		if(!empty($exist)){
    			echo json_encode(array('error'=>'Category Already exists.'));
    			// If the category does not exist, insert it into the database
    		}else{
    			// Insert the new category into the 'categories' table
				$db->insert('categories',array('cat_title'=>$category));
				// Get the result of the INSERT query
				$response = $db->getResult();
                 // If the insertion was successful, return a success message
				if(!empty($response)){
					echo json_encode(array('success'=>$response));
				}
    		}
    	}
    } 


    if( isset($_POST['update']) ){
    	// Check if the 'cat_id' field is set and not empty
    	if(!isset($_POST['cat_id']) || empty($_POST['cat_id'])){
    		// If 'cat_id' is not set or empty, return an error message and exit
    		echo json_encode(array('error'=>'ID is Empty.')); exit;
    	}  // Check if the 'cat_name' field is set and not empty
    	if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
    		  // If 'cat_name' is not set or empty, return an error message and exit
    		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
    	}else{
    		$db = new Database();  // Create a new Database instance
            // Escape the 'cat_id' and 'cat_name' values to prevent SQL injection
    		$cat_id = $db->escapeString($_POST['cat_id']);
    		$cat_name = $db->escapeString($_POST['cat_name']);
             // Update the 'categories' table with the new category name where 'cat_id' matches
    		$db->update('categories',array('cat_title'=>$cat_name),"cat_id = '{$cat_id}'");
    		// Get the result of the UPDATE query
    		$response = $db->getResult();
            // If the update was successful, return a success message and exit
    		if(!empty($response)){
    			echo json_encode(array('success'=>$response)); exit;
    		}
    	}
    }

    if(isset($_POST['delete_id'])){

		$db = new Database(); // Create a new Database instance
        
        // Escape the 'delete_id' value to prevent SQL injection
		$id = $db->escapeString($_POST['delete_id']);
        
        // Delete the record from the 'categories' table where 'cat_id' matches
		$db->delete('categories',"cat_id ='{$id}'");
		// Get the result of the DELETE query
		$response = $db->getResult();
		// If the deletion was successful, return a success message and exit
		if(!empty($response)){
			echo json_encode(array('success'=>$response)); exit;
		}
	} 

?>  
