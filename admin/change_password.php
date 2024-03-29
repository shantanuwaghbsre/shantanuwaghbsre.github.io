<!-- include header file -->
<?php include 'header.php'; ?>
<!-- Admin Content Container -->
<div class="admin-content-container">
       <!-- Admin Heading -->
    <h2 class="admin-heading">Set New Password</h2>
    <!-- Form -->
    <div class="row">
        <form id="changePassword" class="add-post-form col-md-6" method="POST">
             <!-- Old Password Input -->
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="old_pass" class="form-control old_pass" placeholder="Old Password"  required/>
            </div>
              <!-- New Password Input -->
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_pass" class="form-control new_pass" placeholder="New Password"  required/>
            </div>
              <!-- Submit Button -->
            <input type="submit" name="save" class="btn add-new" value="Submit">
        </form>
    </div>
    <!-- /Form -->
</div>
<?php include "footer.php";   ?>