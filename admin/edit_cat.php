<?php
// include header file
include 'header.php'; ?>
    <div class="admin-content-container">
        <h3 class="admin-heading">update category</h3>
        <?php
         // Get category ID from the URL
            $cat_id = $_GET['id'];
            $db = new Database();
             // Select category data for the given ID
            $db->select('categories','*',null,"cat_id ='{$cat_id}'",null,null);
            $result = $db->getResult();
            if ($result > 0) {
                foreach($result as $row){?>
                <div class="row">
                    <!-- Form -->
                     <!-- Update Category Form -->
                    <form id="updateCategory" class="add-post-form col-md-6" method ="POST">
                        <!-- Hidden input field to store category ID -->
                        <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>">
                        <div class="form-group">
                            <label>Category Name</label>
                                <!-- Input field for category name -->
                            <input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_title']; ?>"  placeholder="Category Name" required />
                        </div>
                        <!-- Submit button -->
                        <input type="submit" name="sumbit" class="btn add-new" value="Update" />
                    </form>
                    <!-- /Form -->
                </div>
                <?php
                }
            } else { ?>
                <!-- Display message if no result found -->
                <div class="not-found">!!! Result Not Found !!!</div>
          <?php  } ?>
    </div>
<?php
//    include footer file
    include "footer.php";
?>
          
   

