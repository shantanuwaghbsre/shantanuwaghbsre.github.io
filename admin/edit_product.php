<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">Edit Product</h2>
    <?php
     // Get product ID from the URL
    $id = $_GET['id'];
    $db = new Database();
     // Select product data for the given ID
    $db->select('products','*',null,"product_id = $id",null,null);
    $result = $db->getResult();
    if ($result > 0) {
        foreach($result as $row) { ?>
            <form id="updateProduct" class="add-post-form row" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Product Title</label>
                         <!-- Hidden input field to store product ID -->
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                         <!-- Input field for product title -->
                        <input type="text" class="form-control product_title" name="product_title"
                               value="<?php echo $row['product_title']; ?>" placeholder="Product Title"/>
                    </div>
                    <div class="form-group category">
                        <label for="">Product Category</label>
                        <?php
                        // Select all categories
                        $db->select('categories','*',null,null,null,null);
                        $result2 = $db->getResult();
                        if ($result2 > 0) { ?>
                             <!-- Dropdown for product category -->
                            <select class="form-control product_category" name="product_cat">
                                <?php foreach($result2 as $row2) {
                                    // Check if current category is selected
                                    if($row['product_cat'] == $row2['cat_id']){ ?>
                                        <option selected value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                                  <?php  } ?>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group sub_category">
                        <label for="">Product Sub-Category</label>
                        <?php
                         // Select sub-categories for the product's category
                        $db->select('sub_categories','*',null,"cat_parent = '{$row['product_cat']}'",null,null);
                        $result3 = $db->getResult();
                            
                        if ($result3 > 0) { ?>
                         <!-- Dropdown for product sub-category -->
                        <select class="form-control product_sub_category" name="product_sub_cat">
                            <?php foreach($result3 as $row3) {
                                // Check if current sub-category is selected
                                if($row['product_sub_cat'] == $row3['sub_cat_id']){ ?>
                                    <option selected value="<?php echo $row3['sub_cat_id']; ?>"><?php echo $row3['sub_cat_title']; ?></option>
                        <?php   }else{ ?>
                                    <option value="<?php echo $row3['sub_cat_id']; ?>"><?php echo $row3['sub_cat_title']; ?></option>
                            <?php    }
                            } ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div class="form-group brand">
                        <label for="">Product Brand</label>
                        <?php
                          // Select brands for the product's category
                        $db->select('brands','*',null,"brand_cat = '{$row['product_cat']}'",null,null);
                        $result4 = $db->getResult();
                        if ($result4 > 0) { ?>
                             <!-- Dropdown for product brand -->
                        <select class="form-control product_brands" name="product_brand">
                            <option value="">Select Brand</option>
                            <?php foreach($result4 as $row4) {
                                 // Check if current brand is selected
                                if($row['product_brand'] == $row4['brand_id']){ ?>
                                    <option selected value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                <?php   }else{ ?>
                                    <option value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                <?php    }
                            } ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                         <!-- Textarea for product description -->
                        <textarea class="form-control product_description" name="product_desc" rows="8"
                                  cols="80"><?php echo $row['product_desc']; ?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Featured Image</label>
                        <input type="file" class="product_image" name="new_image">
                          <!-- Hidden input field to store the old image -->
                        <input type="hidden" class="old_image" name="old_image" value="<?php echo $row['featured_image']; ?>">
                         <!-- Display the current featured image -->
                        <img id="image" src="../product-images/<?php echo $row['featured_image']; ?>" alt="" width="100px"/>
                    </div>
                    <div class="form-group">
                        <label for="">Product Price</label>
                         <!-- Input field for product price -->
                        <input type="text" class="form-control product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Available Quantity</label>
                           <!-- Input field for available quantity -->
                        <input type="number" class="form-control product_qty" name="product_qty" value="<?php echo $row['qty']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                         <!-- Dropdown for product status -->
                        <select class="form-control" name="product_status">
                            <!-- Option for published status -->
                            <option <?php if($row['product_status'] == '1') echo 'selected'; ?> value="1">Published</option>
                            <!-- Option for draft status -->
                            <option <?php if($row['product_status'] == '0') echo 'selected'; ?> value="0">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                          <!-- Submit button -->
                        <input type="submit" class="btn add-new" name="submit" value="Update">
                    </div>
                </div>
            </form>
        <?php
        }
    }
    ?>
</div>
<?php
//    include footer file
    include "footer.php";
?>