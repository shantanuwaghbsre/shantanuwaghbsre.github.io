<?php
	include '../config.php'; // Including configuration file.
	// echo '1'; exit;
	// Check if the form is submitted.
	if(isset($_POST['create'])){
		// Check if first name is provided.
		if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		}    // Check if last name is provided.
		else if(!isset($_POST['l_name']) || empty($_POST['l_name'])){
			echo json_encode(array('error'=>'Last Name Field Empty.')); exit;
		} // Check if username is provided.
		else if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Field Empty.')); exit;
		} // Validate the provided email address.
		else if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
		  	echo json_encode(array('error'=>'Please Enter Correct Email Address.')); exit;
		} // Check if password is provided.
		else if(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Password Field Empty.')); exit;
		}    // Check if mobile number is provided.

		else if(!isset($_POST['mobile']) || empty($_POST['mobile'])){
			echo json_encode(array('error'=>'Mobile Number Field Empty.')); exit;
		}// Check if address is provided.

		else if(!isset($_POST['address']) || empty($_POST['address'])){
			echo json_encode(array('error'=>'Address Field Empty.')); exit;
		}   // Check if city is provided.
		else if(!isset($_POST['city']) || empty($_POST['city'])){
			echo json_encode(array('error'=>'City Field Empty.')); exit;
		}else{   // Initialize database connection.
			$db = new Database();
 // Escape and assign form input values.
			$params = [
				'f_name' => $db->escapeString($_POST['f_name']),
				'l_name' => $db->escapeString($_POST['l_name']),
				'username' => $db->escapeString($_POST['username']),
				'password' => md5($db->escapeString($_POST['password'])),
				'mobile' => $db->escapeString($_POST['mobile']),
				'address' => $db->escapeString($_POST['address']),
				'city' => $db->escapeString($_POST['city'])
			];
  // Check if the username already exists in the database.
			$db->select('user','username',null,"username = '{$params["username"]}'",null,null);
			$exist = $db->getResult();
			if(!empty($exist)){
				echo json_encode(array('error'=>'Username Already Exists.')); exit;
			}else{ // Insert user data into the database.
				$db->insert('user',$params);
				$response = $db->getResult();
				if(is_numeric($response[0])){
					// Start session for the newly registered user.
					session_start();
					$_SESSION["user_id"] = $response[0]; /* userid of the user */
	            	$_SESSION["username"] = $params['f_name'];
	            	$_SESSION["user_role"] = 'user'; /* for user */
					echo json_encode(array('success'=>'Registered Successfully')); exit;
				}else{
					echo json_encode(array('error'=>$response)); exit;
				}
			}
		}
	}

	if(isset($_POST['login'])){
		 // Check if username is provided.
		if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Foeld is Empty.')); exit;
		} // Check if password is provided.
		elseif(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Passowrd Foeld is Empty.')); exit;
		}else{
			 // Initialize database connection.
			$db = new Database();
// Escape and hash password.
			$username = $db->escapeString($_POST['username']);
			$password = md5($db->escapeString($_POST['password']));
			
    // Query the database for user credentials.
			$db->select('user','user_id,username,f_name,l_name',null,"username = '{$username}' AND password = '{$password}'",null,null);
			$response = $db->getResult();
			if(!empty($response)){
				if(count($response[0]) > 1){
					/* Start the session */
		            session_start();
		            /* Set session variables */
		            foreach($response as $row){
		            	$_SESSION["user_id"] = $row['user_id']; /* userid of the user */
		            	$_SESSION["username"] = $row['f_name'];
		            	$_SESSION["user_role"] = 'user'; /* for user */
		            }
		            
		            echo json_encode(array('success'=>'Logged In Successfully.')); exit;
				}else{
					echo json_encode(array('error'=>'Username and Password not matched.')); exit;
				}
			}else{
				echo json_encode(array('error'=>'Username and Password not matched.')); exit;
			}
		}
	}


	if(isset($_POST['user_logout'])){
	    /* Start the session */
	    session_start();
	    /* remove all session variables */
	    session_unset();
	    /* destroy the session */
	    session_destroy();

	    echo 'true'; exit;
	}

	if(isset($_POST['update'])){
		 // Check if first name is provided.
		if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		} // Check if last name is provided.
		else if(!isset($_POST['l_name']) || empty($_POST['l_name'])){
			echo json_encode(array('error'=>'Last Name Field Empty.')); exit;
		}    // Check if mobile number is provided.
		else if(!isset($_POST['mobile']) || empty($_POST['mobile'])){
			echo json_encode(array('error'=>'Mobile Number Field Empty.')); exit;
		} // Check if address is provided.
		else if(!isset($_POST['address']) || empty($_POST['address'])){
			echo json_encode(array('error'=>'Address Field Empty.')); exit;
		} // Check if city is provided.
		else if(!isset($_POST['city']) || empty($_POST['city'])){
			echo json_encode(array('error'=>'City Field Empty.')); exit;
		}else{
			 // Initialize database connection.
			$db = new Database();
// Escape and assign form input values.
			$params = [
				'f_name' => $db->escapeString($_POST['f_name']),
				'l_name' => $db->escapeString($_POST['l_name']),
				'mobile' => $db->escapeString($_POST['mobile']),
				'address' => $db->escapeString($_POST['address']),
				'city' => $db->escapeString($_POST['city'])
			];

   // Start session if not already started.
			if(!session_id()){
				session_start();
			}
			$user_id = $_SESSION['user_id'];
			   // Update user data in the database.
			$db->update('user',$params,"user_id = '{$user_id}'");
			$response = $db->getResult();
			if(!empty($response)){
				echo json_encode(array('success'=>$response)); exit;
			}
			
		}
	}

	if(isset($_POST['modifyPass'])){
		// echo '1'; exit;
		 // Check if old password is provided.
		if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
			echo json_encode(array('error'=>'Old Passowrd field Empty')); exit;
		}// Check if new password is provided.
		elseif(!isset($_POST['new_pass']) || empty($_POST['new_pass'])){
			echo json_encode(array('error'=>'New Passowrd field Empty')); exit;
		}else{
			// Initialize database connection.
			$db = new Database();
        // Hash old and new passwords.

			$old = md5($db->escapeString($_POST['old_pass']));
			$new = md5($db->escapeString($_POST['new_pass']));
// Start session if not already started.
			if(!session_id()){ session_start(); }

			$user_id = $_SESSION['user_id'];
 // Check if old password matches the one in the database.
			$db->select('user','user_id',null,"user_id = '{$user_id}' AND password = '{$old}'",null,null);
			$exist = $db->getResult();

			if(!empty($exist)){
				 // Update the password in the database.
				$response = $db->update('user',array('password'=>$new),"user_id = '{$user_id}' AND password = '{$old}'");
				if(!empty($response)){
					echo json_encode(array('success'=>'success')); exit;
				}else{
					echo json_encode(array('error'=>'Password not changed.')); exit;
				}

			}else{
				echo json_encode(array('error'=>'Old Password is not matched.')); exit;
			}
		}
	}


?>