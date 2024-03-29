<?php
// include header file
include 'header.php'; ?>

    <div class="admin-content-container">
        <h2 class="admin-heading">Add New Brand</h2>
        <div class="row">
        <?php 
        // Check if the form was submitted
        if (isset($_POST['save'])) {
            // Include the database configuration file
                include 'config.php';
                // Check if 'title' and 'product_cat' are set in the POST data
                if (isset($_POST['title']) && isset($_POST['product_cat'])) {
                    // Escape user inputs to prevent SQL injection
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $product_cat = mysqli_real_escape_string($conn, $_POST['product_cat']);
                    // Check if title and product category are not empty
                    if ($title != "" && $product_cat != "") {
                        /*sql to select a record*/
                        $sql = "SELECT brand_title FROM brands where brand_title='{$title}' && brand_cat='{$product_cat}'";
                        // Execute the query
                        $result = mysqli_query($conn, $sql);
                           // Check if any record was found
                        if (mysqli_num_rows($result) > 0) {
                            echo "<p style = 'color:red;text-align:center;margin: 10px 0';> Category already used.</p>";
                        } else {
                            /*sql to insert a record*/
                            $sql = "INSERT INTO brands (brand_title,brand_cat)
                                    VALUES ('{$title}','{$product_cat}')";
                            /*   echo "$sql"; exit; */
                            if (mysqli_query($conn, $sql)) {
                                header("location:{$hostname}/admin/brands.php");
                            }
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger">Please fill all the fields</div>
                    <?php }
                } else { ?>
                    <div class="alert alert-danger">Please fill all the fields</div>
                <?php
                }
                mysqli_close($conn);
            } ?>
            <!-- Form -->
            <!-- Form for creating a new brand -->
            <form id="createBrand" class="add-post-form col-md-6" method="POST"
                  autocomplete="off">
                      <!-- Input field for the brand name -->
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name"/>
                </div>
                <!-- Dropdown menu for selecting the brand category -->
                <div class="form-group">
                    <label for="">Brand Category</label>
                    <?php
                    // Create a new Database object
                    $db = new Database();
                     // Select all categories from the database
                    $db->select('categories','*',null,null,null,null);
                      // Get the result of the database query
                    $result = $db->getResult(); ?>
                     <!-- Dropdown menu -->
                    <select class="form-control brand_category" name="brand_cat">
                         <!-- Default option -->
                        <option value="" selected disabled>Select Category</option>
                                    <!-- Loop through each category retrieved from the database -->

                        <?php if (count($result) > 0) { ?>
                            <?php foreach($result as $row) { ?>
                                 <!-- Display each category as an option in the dropdown menu -->
                                <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                  <!-- Submit button for the form -->
                <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
            </form>
            <!-- /Form -->
        </div>
    </div>
<?php
//    include footer file
    include "footer.php";
?>
            