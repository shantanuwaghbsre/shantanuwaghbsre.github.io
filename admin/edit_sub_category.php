<?php
// include header file
    include 'header.php'; ?>
        <div class="admin-content-container">
            <h3 class="admin-heading">Update Sub Category</h3>
            <?php  
             // Get sub category ID from the URL
                $sub_cat_id = $_GET['id'];
                $db = new Database();
                  // Select sub category data for the given ID
                $db->select('sub_categories','*',null,"sub_cat_id ='{$sub_cat_id}'",null,null);
                $result = $db->getResult();
                   // Check if any result found
                if (count($result) > 0) {
                    foreach($result as $row) {?>
                    <div class="row">
                         <!-- Form to update sub category -->
                        <!-- Form -->
                        <form id="updateSubCategory" class="add-post-form col-md-6" method ="POST">
                                                    <!-- Hidden input field to store sub category ID -->

                            <input type="hidden" name="sub_cat_id" value="<?php echo $row['sub_cat_id']; ?>" >
                            <div class="form-group">
                                  <!-- Label for sub category title -->
                                <label>Sub Category Title</label>
                                <!-- Input field for sub category title -->
                                <input type="text" name="sub_cat_name" class="form-control sub_category" value="<?php echo $row['sub_cat_title']; ?>"  placeholder="" required>
                            </div>
                            <div class="form-group">
                                 <!-- Label for category -->
                                <label>Category</label>
                                <?php
                                   // Select all categories
                                $db->select('categories','*',null,null,null,null);
                                $result2 = $db->getResult(); ?>
                                 <!-- Dropdown to select category -->
                                <select name="parent_cat" class="form-control parent_cat">
                                    <option value="">Select Category</option>
                                    <?php if (count($result2) > 0) {  ?>
                                        <?php foreach($result2 as $row2) { ?>
                                            <!-- Set selected option based on sub category's parent category -->
                                            <option <?php if($row2['cat_id'] == $row['cat_parent']) echo 'selected="selected"';  ?> value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                             <!-- Submit button to update sub category -->
                            <input type="submit" name="sumbit" class="btn add-new" value="Update" />
                        </form>
                        <!-- /Form -->
                    </div>
                    <?php
                    }
                } else { ?>
                     <!-- Display message if no result found -->
                    <div class="empty-result">!!! Result Not Found !!!</div>
            <?php } ?>
        </div>
<?php
//    include footer file
include "footer.php";
?>
   

