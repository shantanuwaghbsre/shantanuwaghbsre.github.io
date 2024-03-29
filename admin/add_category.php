<?php
// include header file
include 'header.php'; ?>
<!-- Admin content container -->
<div class="admin-content-container">
     <!-- Admin heading -->
    <h2 class="admin-heading">Add New Category</h2>
    
    <!-- Form -->
    <div class="row">
         <!-- Category creation form -->
        <form id="createCategory" class="add-post-form col-md-6" method="POST">
               <!-- Category name input -->
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="cat" class="form-control category" placeholder="Category Name"  required/>
            </div>
               <!-- Submit button -->
            <input type="submit" name="save" class="btn add-new" value="Submit">
        </form>
           <!-- /Category creation form -->
    </div>
    <!-- /Form -->
</div>
<?php
//    include footer file
    include "footer.php";
?>