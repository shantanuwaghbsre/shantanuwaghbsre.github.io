<?php
// Including configuration file and starting session
include 'config.php';
session_start();
// Redirecting to homepage if user is not logged in or is not a regular user
if(!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'user') {
    header("Location: " . $hostname);
}
// Including header file
include 'header.php'; ?>
<!-- User profile content -->
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 class="section-head">My Profile</h2>
                    <?php
                    // Retrieving user details from the database
                        $user_id = $_SESSION["user_id"]; // Getting the user ID from the session
                        $db = new Database(); // Creating a new instance of the Database class
                        $db->select('user','*',null,"user_id = '{$user_id}'",null,null); // Selecting user details from the database based on the user ID
                        $result = $db->getResult(); // Getting the result of the database query
                        if (count($result) > 0) {
                            // Checking if there are any user details retrieved
                            $table = '<table>'; // Initializing a table HTML structure
                            foreach($result as $row) { // Iterating through each row of the user details ?>
                                <table class="table table-bordered table-responsive" id="userProfile_table">
                                    <tr>
                                        <td><b>First Name :</b></td>
                                        <td><?php echo $row["f_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Name :</b></td>
                                        <td><?php echo $row["l_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username :</b></td>
                                        <td><?php echo $row["username"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile :</b></td>
                                        <td><?php echo $row["mobile"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address :</b></td>
                                        <td><?php echo $row["address"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>City :</b></td>
                                        <td><?php echo $row["city"]; ?></td>
                                    </tr>
                                </table>
                            <?php }
                        }
                        ?>
                        <!-- This line creates a link to the "edit_user.php" page with the user ID appended as a query parameter, allowing the user to modify their details. -->
                        <a class="modify-btn btn" href="edit_user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                        <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';


?>
  