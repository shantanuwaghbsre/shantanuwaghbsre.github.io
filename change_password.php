<?php
include 'config.php'; // Including configuration file
session_start(); // Starting session
// Checking if user is logged in and has user role
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
include 'header.php'; // Including header file ?>
<div id="user_profile-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?php
                //if(isset($_GET['user'])) {
                // Retrieving user information
                    $user = $_SESSION['user_id'];
                    $db = new Database();

                    $db->select('user','username',null,"user_id = '{$user}'",null,null);
                    $result = $db->getResult();
                    if (count($result) > 0) {
                        ?>

                        <div class="@signup_form" style="padding:30px; background-color:#f9f9f9;">
                            <h2>Change Password</h2>
                              <!-- Form for changing password -->
                            <!-- Form -->
                            <form id="modify-password" method="POST">
                                <?php foreach($result as $row) { ?>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" disabled
                                               value="<?php echo $row['username']; ?>" requried/>
                                    </div>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_pass" class="form-control old_pass"
                                               placeholder="Enter Old Password" requried/>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_pass" class="form-control new_pass"
                                               placeholder="Enter Old Password" requried/>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit"/><br><br>
                                <?php } ?>
                            </form>
                            <!-- /Form -->
                        </div>
                    <?php
                    }
                //}else{
                 //   header("location: {$hostname}/user_profile.php");
                  //  ob_flush();
                //}
                    ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';
}
?>