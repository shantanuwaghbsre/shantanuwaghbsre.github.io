<?php
include 'database.php'; // Include the database configuration file

// Check if the 'create' form was submitted
if( isset($_POST['create']) ){
    // Check if the 'sub_cat_name' field is empty
    if(!isset($_POST['sub_cat_name']) || empty($_POST['sub_cat_name'])){
        echo json_encode(array('error'=>'Title Field is Empty.')); // Return an error message if it's empty
    }
    // Check if the 'parent_cat' field is empty
    elseif(!isset($_POST['parent_cat']) || empty($_POST['parent_cat'])){
        echo json_encode(array('error'=>'Parent Category Field is Empty.')); // Return an error message if it's empty
    }
    else{
        // Create a new Database object
        $db = new Database();

        // Escape the values obtained from $_POST to prevent SQL injection
        $title = $db->escapeString($_POST['sub_cat_name']);
        $parent_cat = $db->escapeString($_POST['parent_cat']);

        // Check if the subcategory with the same title and parent category exists
        $db->select('sub_categories','sub_cat_title',null,"sub_cat_title = '{$title}' AND  cat_parent = '{$parent_cat}'",null,null);
        $exist = $db->getResult();

        // If a subcategory with the same title and parent category exists, return an error message
        if(!empty($exist)){
            echo json_encode(array('error'=>'This Title Already exists.'));
        }else{
            // Insert the new subcategory into the 'sub_categories' table
            $db->insert('sub_categories',array('sub_cat_title'=>$title,'cat_parent'=>$parent_cat));

            // Get the result of the database operation
            $response = $db->getResult();

            // If the operation was successful, return success response
            if(!empty($response)){
                echo json_encode(array('success'=>$response));
            }
        }
    }
} 



    if( isset($_POST['update']) ){
         // Check if the 'sub_cat_id' field is empty
    	if(!isset($_POST['sub_cat_id']) || empty($_POST['sub_cat_id'])){
    		echo json_encode(array('error'=>'ID is Empty.')); exit;
    	}// Check if the 'sub_cat_name' field is empty
        elseif(!isset($_POST['sub_cat_name']) || empty($_POST['sub_cat_name'])){
            echo json_encode(array('error'=>'Title Field is Empty.'));
        } // Check if the 'parent_cat' field is empty
        elseif(!isset($_POST['parent_cat']) || empty($_POST['parent_cat'])){
            echo json_encode(array('error'=>'Parent Category Field is Empty.'));
        }else{
    		$db = new Database();

    		$cat_id = $db->escapeString($_POST['sub_cat_id']);
    		$cat_name = $db->escapeString($_POST['sub_cat_name']);
            $parent_cat = $db->escapeString($_POST['parent_cat']);
            // Update the 'sub_categories' table with the new subcategory title and parent category
    		$db->update('sub_categories',array('sub_cat_title'=>$cat_name,'cat_parent'=>$parent_cat),"sub_cat_id = '{$cat_id}'");
    		$response = $db->getResult();
              // If the update operation was successful, return success response
    		if(!empty($response)){
    			echo json_encode(array('success'=>$response)); exit;
    		}
    	}
    }

    if(isset($_POST['delete_id'])){

		$db = new Database();

		$id = $db->escapeString($_POST['delete_id']);
          // Check if the subcategory has a parent category
        $db->select('sub_categories','cat_parent',null,"sub_cat_id = '{$id}'",null,null);
        $count = $db->getResult();
        // If the subcategory has a parent category, return an error message
        if($count[0]['cat_parent'] > '0'){
            echo json_encode(array('error'=>'not delete')); exit;
        }else{
             // Delete the subcategory from the 'sub_categories' table
            $db->delete('sub_categories',"sub_cat_id ='{$id}'");
            $response = $db->getResult();
             // If the deletion was successful, return success response
            if(!empty($response)){
                echo json_encode(array('success'=>$response)); exit;
            }
        }

		
	} 

    if(isset($_POST['showInHeader'])){
        // Get the status and ID from the POST data
        $status = $_POST['showInHeader'];
        $id = $_POST['id'];
          // Create a new Database object
        $db = new Database();
         // Update the 'show_in_header' field in the 'sub_categories' table
        $db->update('sub_categories',array('show_in_header'=>$status),"sub_cat_id = '{$id}'");
        $result = $db->getResult();
        
    // If the update was successful, return 'true'
        if(!empty($result)){
            echo 'true'; exit;
        }
    }

    if(isset($_POST['showInFooter'])){
        // Get the status and ID from the POST data
        $status = $_POST['showInFooter'];
        $id = $_POST['id'];
        // Create a new Database object
        $db = new Database();
        // Update the 'show_in_footer' field in the 'sub_categories' table
        $db->update('sub_categories',array('show_in_footer'=>$status),"sub_cat_id = '{$id}'");
        $result = $db->getResult();
        // If the update was successful, return 'true'
        if(!empty($result)){
            echo 'true'; exit;
        }
    }

?>  
