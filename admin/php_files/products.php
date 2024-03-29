<?php
 include 'database.php';

 // get sub category and brands 
 // ==========================
 if(isset($_POST['p_cat'])){
    // Retrieve the parent category ID from the POST data
    $cat = $_POST['p_cat'];
    // Create a new Database instance
    $db = new Database();
      // Select sub categories based on the parent category
    $db->select('sub_categories','*',null,"cat_parent = $cat",null,null);
    $sub_category = $db->getResult();
       // Prepare output array
    $output = [];
    // Check if sub categories file_exists
    if ($sub_category > 0) {
        $output['sub_category'] = $sub_category;
    }
      // Select brands based on the parent category
    $db->select('brands','*',null,"brand_cat = $cat",null,null);
    $brands = $db->getResult();
       // Check if brands exist
    if ($sub_category > 0) {
        $output['brands'] = $brands;
    }
      // Encode the output array as JSON and send the response
    echo json_encode($output);
}


// product insert script
// ============================
if(isset($_POST['create'])){
    // Check if required fields are set and not empty
	if(!isset($_POST['product_title']) || empty($_POST['product_title'])){
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
		echo json_encode(array('error'=>'Status Field is Empty.')); exit;
	}elseif(!isset($_FILES['featured_img']['name']) || empty($_FILES['featured_img']['name'])){
		echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{
        // Initialize an array to store validation errors
		$errors= array();
        /* get details of the uploaded file */
        $file_name = $_FILES['featured_img']['name'];
        $file_size = $_FILES['featured_img']['size'];
        $file_tmp = $_FILES['featured_img']['tmp_name'];
        $file_type = $_FILES['featured_img']['type'];
         // Remove commas and spaces from the file name
        $file_name = str_replace(array(',',' '),'',$file_name);
         // Get the file extension
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));
        // Allowed extensions
        $extensions = array("jpeg","jpg","png");
        // Check if the file extension is allowed
        if(in_array($file_ext,$extensions)=== false){
            $errors[]='<div class="alert alert-danger"> extension not allowed, please choose a JPEG or PNG file.</div>';
        } // Check if the file size exceeds the limit
        if($file_size > 2097152){
            $errors[]='<div class="alert alert-danger">File size must be exactely 2 MB</div>';
        }
        // check image errors
            // If there are any errors, return them in JSON format and exit
        if(!empty($errors)){
        	echo json_encode($errors); exit;
        } 
        // Generate a unique file name using the current timestamp
        else{
        	
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);
            // Check if product brand is set, otherwise set it to '0'
            if(isset($_POST['product_brand']) && !empty($_POST['product_brand'])){
    			$product_brand = $_POST['product_brand'];
	    	}else{
				$product_brand = '0';
	    	}
		    	
            // Create a new Database instance
            $db = new Database();
            // Prepare parameters for inserting a new product
        	$params = [
                'product_title' => $db->escapeString($_POST['product_title']),
                'product_code' => uniqid(),
        		'product_cat' => $db->escapeString($_POST['product_cat']),
        		'product_sub_cat' => $db->escapeString($_POST['product_sub_cat']),
        		'product_brand' => $db->escapeString($product_brand),
        		'featured_image' => $db->escapeString($file_name),
        		'product_desc' => $db->escapeString($_POST['product_desc']),
        		'product_price' => $db->escapeString($_POST['product_price']),
                'qty' => $db->escapeString($_POST['product_qty']),
        		'product_status' => $db->escapeString($_POST['product_status'])
        	];
            // Check if a product with the same title already exists
        	$db->select('products','product_title',null,"product_title = '{$params['product_title']}'",null,null);
        	$exist = $db->getResult();

        	if(!empty($exist)){
                // If the product title already exists, return an error message
        		echo json_encode(array('error'=>'Title is Already Exists.')); exit;
        	}else{
                // Insert the new product into the database
        		$db->insert('products',$params);

                // Update the product count for the sub-category
        		$db->sql("UPDATE sub_categories SET cat_products = cat_products + 1 WHERE sub_cat_id = {$params['product_sub_cat']}");
                // Get the result of the insertion
        		$response = $db->getResult();
        		if(!empty($response)){
        			/* directory in which the uploaded file will be moved */
                    // If the insertion was successful, move the uploaded file to the product images directory
            		move_uploaded_file($file_tmp,"../../product-images/".$file_name);
                    // Return a success message
            		echo json_encode(array('success'=>$response)); exit;
        		}
        	}
        }
    }
}




// product update script
// ============================
// Check if the update request is received
if(isset($_POST['update'])){
    // Check if the product ID is missing or empty
	if(!isset($_POST['product_id']) || empty($_POST['product_id'])){
		echo json_encode(array('error'=>'Product ID is missing.')); exit;
	}elseif(!isset($_POST['product_title']) || empty($_POST['product_title'])){
        // Check if the title field is empty
		echo json_encode(array('error'=>'Title Field is Empty.')); exit;
	}elseif(!isset($_POST['product_cat']) || empty($_POST['product_cat'])){
        // Check if the category field is empty
		echo json_encode(array('error'=>'Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_sub_cat']) || empty($_POST['product_sub_cat'])){
        // Check if the sub-category field is empty
		echo json_encode(array('error'=>'Sub Category Field is Empty.')); exit;
	}elseif(!isset($_POST['product_desc']) || empty($_POST['product_desc'])){
         // Check if the description field is empty
		echo json_encode(array('error'=>'Description Field is Empty.')); exit;
	}elseif(!isset($_POST['product_price']) || empty($_POST['product_price'])){
          // Check if the price field is empty
		echo json_encode(array('error'=>'Price Field is Empty.')); exit;
	}elseif(!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        // Check if the quantity field is empty
        echo json_encode(array('error'=>'Quantity Field is Empty.')); exit;
    }elseif(!isset($_POST['product_status']) || empty($_POST['product_status'])){
         // Check if the status field is empty
		echo json_encode(array('error'=>'Status Field is Empty.')); exit;
	}else if(empty($_POST['old_image']) && empty($_FILES['new_image']['name'])){
        // Check if both the old and new image fields are empty
        echo json_encode(array('error'=>'Image Field is Empty.')); exit;
    }else{

        // Check conditions for handling image files
        if(!empty($_POST['old_image'])  && empty($_FILES['new_image']['name'])){
             // If the old image exists and no new image is uploaded, use the old image filename
            $file_name = $_POST['old_image'];
        
        }else if(!empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
             // If both old and new images exist, handle the new image upload
            $errors= array();
             /* get details of the uploaded file */
            $file_name = $_FILES['new_image']['name'];
            $file_size =$_FILES['new_image']['size'];
            $file_tmp =$_FILES['new_image']['tmp_name'];
            $file_type=$_FILES['new_image']['type'];
            // Remove special characters and spaces from the file name
            $file_name = str_replace(array(',',' '),'',$file_name);
            $file_ext=explode('.',$file_name);
            $file_ext=strtolower(end($file_ext));
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                // Check if the file extension is allowed
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                // Check if the file size exceeds 2MB
                $errors[]='File size must be excately 2 MB';
            }// Delete the old image file if it exists
            if(file_exists('../../product-images/'.$_POST['old_image'])){
                unlink('../../product-images/'.$_POST['old_image']);
            }// Generate a unique file name based on current time
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);

        }else if(empty($_POST['old_image']) && !empty($_FILES['new_image']['name'])){
             // If no old image exists and a new image is uploaded, handle the new image upload
            $errors= array();
             /* get details of the uploaded file */
            $file_name = $_FILES['new_image']['name'];
            $file_size =$_FILES['new_image']['size'];
            $file_tmp =$_FILES['new_image']['tmp_name'];
            $file_type=$_FILES['new_image']['type'];
                // Remove special characters and spaces from the file name
            $file_name = str_replace(array(',',' '),'',$file_name);
            $file_ext=explode('.',$file_name);
            $file_ext=strtolower(end($file_ext));
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                // Check if the file extension is allowed
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                // Check if the file size exceeds 2MB
                $errors[]='File size must be excately 2 MB';
            }// Generate a unique file name based on current time
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);
        }

        if(!empty($errors)){
             // If there are errors, encode them as JSON and exit
    	   echo json_encode($errors); exit;
        }else{
                // If there are no errors, proceed with database operations
               // Determine the product brand value

            if(isset($_POST['product_brand']) && !empty($_POST['product_brand'])){
    			$product_brand = $_POST['product_brand'];
	    	}else{
				$product_brand = '0'; // Default to '0' if product brand is not set
	    	}
        	// Initialize Database object
            $db = new Database();
            // Prepare parameters for updating the product
        	$params = [
        		'product_title' => $db->escapeString($_POST['product_title']),
        		'product_cat' => $db->escapeString($_POST['product_cat']),
        		'product_sub_cat' => $db->escapeString($_POST['product_sub_cat']),
        		'product_brand' => $db->escapeString($product_brand),
        		'featured_image' => $db->escapeString($file_name),
        		'product_desc' => $db->escapeString($_POST['product_desc']),
        		'product_price' => $db->escapeString($_POST['product_price']),
                'qty' => $db->escapeString($_POST['product_qty']),
        		'product_status' => $db->escapeString($_POST['product_status'])
        	];
             // Update the product in the database
    		$db->update('products',$params,"product_id='{$_POST['product_id']}'");
    		// Get the result of the update operation
    		$response = $db->getResult();
    		if(!empty($response)){
                 // If the update was successful, move the uploaded file and return success response
    			if(!empty($_FILES['new_image']['name'])){
    				/* directory in which the uploaded file will be moved */
                    move_uploaded_file($file_tmp,"../../product-images/".$file_name);
                }
                // Return success message
        		echo json_encode(array('success'=>$response[0])); exit;
    		}
        }
    }
}
 
if(isset($_POST['delete_id'])){
    // Create a new Database object
	$db = new Database();
    // Escape the values obtained from $_POST to prevent SQL injection
	$id = $db->escapeString($_POST['delete_id']);
	$sub_cat = $db->escapeString($_POST['p_subcat']);
    // Delete the product from the 'products' table where product_id matches $id
	$db->delete('products',"product_id ='{$id}'");
    // Decrement the count of products associated with the subcategory in the 'sub_categories' table
	$db->sql("UPDATE sub_categories SET cat_products = cat_products - 1 WHERE sub_cat_id = {$sub_cat}");
    // Get the result of the database operation
	$response = $db->getResult();
    // If the operation was successful, return success response
	if(!empty($response)){
		echo json_encode(array('success'=>$response)); exit;
	}
}

?>