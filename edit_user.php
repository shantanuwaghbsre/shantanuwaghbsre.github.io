<?php
// Include the configuration file and start the session
include 'config.php';
session_start();
// Check if the user is logged in and has the role of 'user'
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
 // Include the header
include 'header.php'; ?>
<div id="user_profile-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?php
                // Get the user ID from the URL parameter
                $user = $_GET['user'];
                $db = new Database();
                // Select user data from the database based on the user ID
                $db->select('user','*',null,"user_id= '{$user}'",null,null);
                $result = $db->getResult();
                 // Check if user data exists
                if(count($result) > 0) { ?>
                    <!-- Modify Profile Form -->
                    <!-- Form -->
                    <form id="modify-user" method="POST">
                        <div class="@signup_form" style="background-color:#f9f9f9; padding:30px;">
                            <h2>Modify Profile</h2>
                            <?php foreach($result as $row){ ?>
                                <div class="form-group">
                                <label>Username/Email</label>
                                <input type="text" class="form-control" placeholder="Username"
                                       value="<?php echo $row['username']; ?>" disabled requried>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control first_name"
                                       placeholder="First Name" value="<?php echo $row['f_name']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name"
                                       value="<?php echo $row['l_name']; ?>" requried>
                            </div>
                            
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile"
                                       value="<?php echo $row['mobile']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control address" placeholder="Address"
                                       value="<?php echo $row['address']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control city" placeholder="City" value="<?php echo $row['city']; ?>" requried>
                            </div>
                            <input type="submit" name="signup" class="btn btn-primary" value="Modify"/>
                              <!-- /Modify Profile Form -->
                        <?php  } ?>
                        </div>
                    </form>
                    <!-- /Form -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';
}
?>