<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">All Brands</h2>
    <a class="add-new pull-right" href="add_brand.php">Add New</a>
    <?php
     // Set limit for pagination
    $limit = 10;
       // Create a new Database object
    $db = new Database();
       // Select brands along with their categories
    $db->select('brands','brands.brand_id,brands.brand_title,brands.brand_cat,categories.cat_title','categories ON brands.brand_cat=categories.cat_id',null,'brands.brand_id DESC',$limit);
    // Get the result
    $result = $db->getResult();
      // Check if there are brands
    if (count($result) > 0) { ?>
         <!-- Brands Table -->
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['brand_title']; ?></td>
                    <td><?php echo $row['cat_title']; ?></td>
                    <td>
                        <a href="edit_brand.php?id=<?php echo $row['brand_id'];  ?>"><i class="fa fa-edit"></i></a>
                        <a class="delete_brand" href="javascript:void();" data-id="<?php echo $row['brand_id'];  ?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?> <!-- No Brands Found -->
        <div class="not-found">!!! No Barnds Found !!!</div>
    <?php    } ?>    <!-- Pagination -->
    <div class="pagination-outer">
        <?php echo $db->pagination('brands','categories ON brands.brand_cat=categories.cat_id',null,$limit); ?>
    </div>
</div>

<?php
//    include footer file
    include "footer.php";
?>
