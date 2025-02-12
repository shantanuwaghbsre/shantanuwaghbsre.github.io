<?php
// include header file
include 'header.php'; ?>
<!-- Start admin-content-container -->
<div class="admin-content-container">
    <!-- Heading for All Subcategories -->
    <h2 class="admin-heading">All SubCategory</h2>
     <!-- Link to add a new subcategory -->
    <a class="add-new pull-right" href="add_sub_category.php">Add New</a>
    <?php
    // Define limit for pagination
    $limit = 10;
       // Initialize Database object
    $db = new Database();
     // Select subcategory details along with category information
    $db->select('sub_categories','sub_categories.sub_cat_id,sub_categories.sub_cat_title,sub_categories.cat_parent,sub_categories.show_in_header,sub_categories.show_in_footer,categories.cat_title','categories ON sub_categories.cat_parent=categories.cat_id',null,'sub_categories.sub_cat_id DESC',$limit);
    // Get the result of the query
    $result = $db->getResult();
    // Check if there are any subcategories
    if (count($result) > 0) { ?>
        <!-- Display subcategories in a table -->
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Category</th>
            <th>Show in Header</th>
            <th>Show in Footer</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['sub_cat_title']; ?></td>
                    <td><?php echo $row['cat_title']; ?></td>
                    <td>
                    <?php if($row['show_in_header'] == '1'){ ?>
                        <input type="checkbox" class="toggle-checkbox showCat_Header" data-id="<?php echo $row['sub_cat_id'];  ?>" checked />
                    <?php }else{ ?>
                        <input type="checkbox" class="toggle-checkbox showCat_Header" data-id="<?php echo $row['sub_cat_id'];  ?>" />
                    <?php } ?>
                    </td>
                    <td>
                    <?php if($row['show_in_footer'] == '1'){ ?>
                        <input type="checkbox" class="toggle-checkbox showCat_Footer" data-id="<?php echo $row['sub_cat_id'];  ?>" checked />
                    <?php }else{ ?>
                        <input type="checkbox" class="toggle-checkbox showCat_Footer" data-id="<?php echo $row['sub_cat_id'];  ?>" />
                    <?php } ?>
                    </td>
                    <td>
                        <!-- Link to edit subcategory and delete subcategory -->
                        <a href="edit_sub_category.php?id=<?php echo $row['sub_cat_id'];  ?>"><i class="fa fa-edit"></i></a>
                        <a class="delete_subCategory" href="javascript:void();" data-id="<?php echo $row['sub_cat_id'];  ?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
         <!-- Display message if no subcategories found -->
        <div class="not-found">!!! No Sub Categories Available !!!</div>
    <?php    }  ?>
    <!-- Pagination section -->
    <div class="pagination-outer">
        <?php echo $db->pagination('sub_categories','categories ON sub_categories.cat_parent=categories.cat_id',null,$limit); ?>
    </div>
</div>
<?php
//    include footer file
    include "footer.php";
?>