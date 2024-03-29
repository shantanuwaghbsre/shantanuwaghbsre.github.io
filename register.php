<?php
include 'config.php';  // Include the configuration file
session_start(); // Start the session
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
    // Check if the user is logged in and their role is 'user'
    include 'config.php';
    header("Location: " . $hostname."/user_profile.php"); // Redirect the user to the user profile page
}else{

include 'header.php'; // Include the header file ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-auto col-md-6" style="background-color:#ffffff; width:100%; padding:30px;">
           
            <!-- Form -->
            <form id="register_sign_up" method ="POST" autocomplete="off">
                <h2>Create an Account</h2>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="f_name" class="form-control first_name" placeholder="First Name" requried />
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name" requried />
                </div>
                <div class="form-group">
                    <label>Username / Email</label>
                    <input type="email" name="username" class="form-control user_name" placeholder="Email Address" requried />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control pass_word" placeholder="Password" requried />
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" requried />
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control address" placeholder="Address" requried>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control city" placeholder="City" requried>
                </div>
                <input type="submit" name="signup" class="btn btn-primary" value="sign up"/ style="width:100%;">
            </form>
            <!-- /Form -->
        </div>
    </div>
</div>
    <?php include 'footer.php';
}
?>