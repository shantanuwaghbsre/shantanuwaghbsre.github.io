<?php
// include header file
include 'header.php'; ?>
<!-- Admin Content Container -->
    <div class="admin-content-container">
          <!-- Admin Heading -->
        <h2 class="admin-heading">Dashboard</h2>
          <!-- Row -->
        <div class="row">
                  <!-- Column 1 -->
            <div class="col-md-12">
                <?php
                   // Select products with quantity less than 1
                    $db = new Database();
                    $db->select('products','product_id',null,'qty < 1',null,0);
                    $qty = $db->getResult();
                    if(!empty($qty)){  ?>
                        <!-- Table for Products Out of Stock -->
                        <table class="table table-bordered">
                            <thead>
                                <tr class="active"><td colspan="2">OUT OF Stock</td></tr>
                            </thead>
                            <tbody>
                                <?php foreach($qty as $q){ ?>
                                    <tr>
                                    <td>Product Code</td>
                                    <td><?php echo 'PDR00'.$q['product_id']; ?></td>
                                </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
            </div>
             <!-- Column 2 -->
            <div class="col-md-4">
                <?php
                    $db = new Database();
                        // Count total number of products
                    $db->select('products','COUNT(product_id) as p_count',null,null,null,0);
                    $products = $db->getResult();
                ?>
                <!-- Display Product Count -->
                <div class="detail-box">
                    <span class="count"><?php echo $products[0]['p_count']; ?></span>
                    <span class="count-tag">Products</span>
                </div>
            </div>
                <!-- Column 3 -->
            <div class="col-md-4">
                <?php
                    $db = new Database();
                      // Count total number of categories
                    $db->select('categories','COUNT(cat_id) as c_count',null,null,null,0);
                    $category = $db->getResult();
                ?>
                 <!-- Display Category Count -->
                <div class="detail-box">
                    <span class="count"><?php echo $category[0]['c_count']; ?></span>
                    <span class="count-tag">Categories</span>
                </div>
            </div>
             <!-- Column 4 -->
            <div class="col-md-4">
                 <!-- Count total number of sub-categories -->
                <div class="detail-box">
                    <?php
                        $db = new Database();
                        $db->select('sub_categories','COUNT(sub_cat_id) as sub_count',null,null,null,0);
                        $sub_category = $db->getResult();
                    ?> <!-- Display Sub Category Count -->
                    <span class="count"><?php echo $sub_category[0]['sub_count']; ?></span>
                    <span class="count-tag">Sub Categories</span>
                </div>
            </div>
              <!-- Column 5 -->
            <div class="col-md-4">
                <div class="detail-box">
                         <!-- Count total number of brands -->
                    <?php
                        $db = new Database();
                        $db->select('brands','COUNT(brand_id) as b_count',null,null,null,0);
                        $brands = $db->getResult();
                    ?> <!-- Display Brand Count -->
                    <span class="count"><?php echo $brands[0]['b_count']; ?></span>
                    <span class="count-tag">Brands</span>
                </div>
            </div>
              <!-- Column 6 -->
            <div class="col-md-4">
                            <!-- Count total number of orders -->

                <div class="detail-box">
                    <?php
                        $db = new Database();
                        $db->select('order_products','COUNT(order_id) as o_count',null,null,null,0);
                        $orders = $db->getResult();
                    ?>  <!-- Display Order Count -->
                    <span class="count"><?php echo $orders[0]['o_count']; ?></span>
                    <span class="count-tag">Orders</span>
                </div>
            </div>  <!-- Column 7 -->
            <div class="col-md-4">
                <!-- Count total number of users -->
                <div class="detail-box">
                    <?php
                        $db = new Database();
                        $db->select('user','COUNT(user_id) as u_count',null,null,null,0);
                        $users = $db->getResult();
                    ?> <!-- Display User Count -->
                    <span class="count"><?php echo $users[0]['u_count']; ?></span>
                    <span class="count-tag">Users</span>
                </div>
            </div>
        </div>
    </div>
<?php
//    include footer file
    include "footer.php";

?>
