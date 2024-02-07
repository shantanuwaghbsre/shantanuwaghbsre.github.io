<?php include 'config.php';  //include config
// set dynamic title
$db = new Database();
$db->select('options','site_title',null,null,null,null);
$result = $db->getResult();

// include header 
include 'header.php'; ?>

<!-- contact form start's here -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .textarea-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="w3-container w3-teal w3-center w3-padding-24">
    <h2>Contact Us</h2>
</div>

<div class="w3-container container">
    <form action="submit_contact_form.php" method="POST">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" class="w3-input input-field" required>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" class="w3-input input-field" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="w3-input input-field" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" class="w3-input textarea-field" required></textarea>

        <button type="button" class="w3-button w3-green button">Submit</button>
    </form>
</div>

</body>
</html>


<!-- contact form end's here -->

<?php include 'footer.php'; ?>

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "shopping_db";

  $con = mysqli_connect($servername,$username,$password,$dbname);

  if (isset($_POST['save_btn'])) {
  	$firstname = $_POST['firstname'];
  	$lastname = $_POST['lastname'];
  	$email = $_POST['email'];
  	$message = $_POST['message'];

  	$insert = "INSERT INTO contact(firstname,lastname,email,message) VALUES('$firstname','$lastname','$email','$message')";
  	$query = mysqli_query($con,$insert);
  	if ($query) {
  		?>

  		<script type="text/javascript">
  			alert("Response recorded successfully !");
  		</script>

  		<?php
  	}
  }

  ?>
