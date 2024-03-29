<?php

include 'database.php'; // Include the database configuration file


    if(isset($_POST['update'])){
        // echo json_encode(array('error'=>'Options ID is missing.')); exit;
        // Check if the 's_no' field is set and not empty
        if(!isset($_POST['s_no']) || empty($_POST['s_no'])){
            echo json_encode(array('error'=>'Options ID is missing.')); exit;
        } // Check if the 'site_name' field is set and not empty
        elseif(!isset($_POST['site_name']) || empty($_POST['site_name'])){
            echo json_encode(array('error'=>'Site Name Field is Empty.')); exit;
        }// Check if the 'site_title' field is set and not empty
        elseif(!isset($_POST['site_title']) || empty($_POST['site_title'])){
            echo json_encode(array('error'=>'Site Title Field is Empty.')); exit;
        } // Check if the 'footer_text' field is set and not empty
        elseif(!isset($_POST['footer_text']) || empty($_POST['footer_text'])){
            echo json_encode(array('error'=>'Footer text Field is Empty.')); exit;
        }// Check if the 'currency_format' field is set and not empty
        elseif(!isset($_POST['currency_format']) || empty($_POST['currency_format'])){
            echo json_encode(array('error'=>'Currency Format Field is Empty.')); exit;
        } // Check if the 'site_desc' field is set and not empty
        elseif(!isset($_POST['site_desc']) || empty($_POST['site_desc'])){
            echo json_encode(array('error'=>'Description Field is Empty.')); exit;
        }// Check if the 'contact_email' field is set and not empty
        elseif(!isset($_POST['contact_email']) || empty($_POST['contact_email'])){
            echo json_encode(array('error'=>'Email Field is Empty.')); exit;
        }// Check if the 'contact_phone' field is set and not empty
        elseif(!isset($_POST['contact_phone']) || empty($_POST['contact_phone'])){
            echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
        } // Check if the 'contact_address' field is set and not empty
        elseif(!isset($_POST['contact_address']) || empty($_POST['contact_address'])){
            echo json_encode(array('error'=>'Address Field is Empty.')); exit;
        }else if(empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])){
            echo json_encode(array('error'=>'Site Logo Field is Empty.')); exit;
        }else{
            // Check conditions for handling different scenarios related to logo update
            if(!empty($_POST['old_logo'])  && empty($_FILES['new_logo']['name'])){
                // If only old logo exists and no new logo is provided
                $file_name = $_POST['old_logo'];

            }else if(!empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                  // If both old and new logos are provided
                $errors= array();
                 /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size =$_FILES['new_logo']['size'];
                $file_tmp =$_FILES['new_logo']['tmp_name'];
                $file_type=$_FILES['new_logo']['type'];
                 // Remove commas and spaces from the file name
                $file_name = str_replace(array(',',' '),'',$file_name);
                 // Get the file extension
                $file_ext=explode('.',$file_name);
                $file_ext=strtolower(end($file_ext));
                // Allowed extensions
                $extensions= array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
                // Check if the file size exceeds the limit

                if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
                }
                 // Remove the old logo from the images directory
                if(file_exists('images/'.$_POST['old_logo'])){
                unlink('images/'.$_POST['old_logo']);
}

                // Generate a unique file name using the current timestamp
                $file_name = time().str_replace(array(' ','_'), '-', $file_name);

            }else if(empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
                // If only new logo is provided
                $errors= array();
                 /* get details of the uploaded file */
                $file_name = $_FILES['new_logo']['name'];
                $file_size =$_FILES['new_logo']['size'];
                $file_tmp =$_FILES['new_logo']['tmp_name'];
                $file_type=$_FILES['new_logo']['type'];
                // Remove commas and spaces from the file name
                $file_name = str_replace(array(',',' '),'',$file_name);

                // Get the file extension
                $file_ext=explode('.',$file_name);
                $file_ext=strtolower(end($file_ext));
                 // Allowed extensions
                $extensions= array("jpeg","jpg","png");
                // Check if the file extension is allowed
                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
                // Check if the file size exceeds the limit
                if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
                }
                // Generate a unique file name using the current timestamp
                $file_name = time().str_replace(array(' ','_'), '-', $file_name);
            }
            // If there are errors in the file upload process
            // echo json_encode(array('1'=>'1')); exit;
            if(!empty($errors)){
             // Return the errors in JSON format and exit
               echo json_encode($errors); exit;
            }else{
                
                // If there are no errors in the file upload process
                $db = new Database();
                // Prepare parameters for updating options in the database
                $params = [
                    'site_name' => $db->escapeString($_POST['site_name']),
                    'site_title' => $db->escapeString($_POST['site_title']),
                    'site_logo' => $db->escapeString($file_name),
                    'footer_text' => $db->escapeString($_POST['footer_text']),
                    'currency_format' => $db->escapeString($_POST['currency_format']),
                    'site_desc' => $db->escapeString($_POST['site_desc']),
                    'contact_phone' => $db->escapeString($_POST['contact_phone']),
                    'contact_email' => $db->escapeString($_POST['contact_email']),
                    'contact_address' => $db->escapeString($_POST['contact_address'])
                ];
                 // Update options in the database
                $db->update('options',$params,"s_no='{$_POST['s_no']}'");
                   // Get the result of the update operation
                $response = $db->getResult();
                   // If the update operation was successful
                if(!empty($response)){
                    // If a new logo was provided, move the uploaded file to the images directory
                    if(!empty($_FILES['new_logo']['name'])){
                        /* directory in which the uploaded file will be moved */
                        move_uploaded_file($file_tmp,"../../images/".$file_name);
                    }
                     // Return success message in JSON format and exit
                    echo json_encode(array('success'=>$response[0])); exit;
                }
            }
        }
    }

?>