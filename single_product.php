<?php 
// Include the configuration file
include 'config.php';  //config file
// Get the product ID from the URL parameters
$p_id = $_GET['pid'];
// Create a new instance of the Database class
$db = new Database();
// Update the product views count in the database
$db->sql("UPDATE products SET product_views=product_views+1 WHERE product_id=".$p_id);
$res = $db->getResult();
// Retrieve information about the single product from the database
$db->select('products','*',null,"product_id= '{$p_id}'",null,null);
$single_product = $db->getResult();
// Check if the single product information exists
if(count($single_product) > 0){ 
    // Set the dynamic header title
   $title = $single_product[0]['product_title'];   //set dynamic header
    // include header
    include 'header.php'; ?>
<div class="single-product-container">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-7">
                <?php
                // Create a new instance of the Database class
                $db = new Database();
                // Retrieve information about the sub-category of the single product from the database
                $db->select('sub_categories','*',null,"sub_cat_id='{$single_product[0]['product_sub_cat']}'",null,null);
                $category = $db->getResult();
                ?>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="category.php?cat=<?php echo $category[0]['sub_cat_id']; ?>"><?php echo $category[0]['sub_cat_title']; ?></a></li>
                    <li class="active"><?php echo substr($title,0,30).'.....'; ?></li>
                </ol>
            </div> 
        </div>
        <div class="row">
        <?php foreach($single_product as $row){ ?>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="product-image">
                        <img id="product-img" src="product-images/<?php echo $row['featured_image'] ?>" alt="" style="width:400px; margin-left:-200px;" class="img-fluid" />
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="product-content">
                        <h3 class="title"><?php echo $row['product_title']; ?></h3>
                        <span class="price"style="display:flex; justify-content:flex-start;">MRP : <div>&#8377;</div>  <?php echo $row['product_price']; ?></span>
                        <h4>Product Description</h4>
                        <p class="description" id="remaningText" style="overflow: hidden; height:160px;"><?php echo html_entity_decode($row['product_desc']); ?></p>
                       <!-- style="background-color:transparent;padding:0px; width:600px; height:160px;" -->
                    </div>
                    <button type="button" class="btn btn-danger" onclick="toggleText()">Read More</button>
                     <a class="add-to-cart btn btn-primary" data-id="<?php echo $row['product_id']; ?>" href="" onclick="addtoCart('<?php echo $title; ?>')">Add to cart</a>
                        <a class="add-to-wishlist btn btn-primary" data-id="<?php echo $row['product_id']; ?>" href="" onclick="addtoWishlist('<?php echo $title; ?>')">Add to Wislist</a>
                </div>
                <div class="col-md-2"></div>
    <?php   } ?>
        </div>
    </div><br><br><br>
    <?php include 'review.php'; ?>
</div>
<?php include 'footer.php'; 
}else{
    echo 'Page Not Found';

}
?>

<script type="text/javascript">
    // Function to display an alert when a product is successfully added to the cart
    function addtoCart(title)
    {
        alert(title +"\nProduct Successfully Added to Cart");
    }
    // Function to display an alert when a product is successfully added to the wishlist
    function addtoWishlist(title)
    {
        alert(title+"\nProduct Successfully Added to Wishlist");
    }
</script>
<script type="text/javascript">
    // Function to toggle the visibility of text content
    function toggleText()
    {// Get the element with ID 'remaningText'
        console.log(document.getElementById('remaningText').style);
           // Check if the overflow is currently set to hidden
        if (document.getElementById('remaningText').style.overflow === 'hidden') {
            // Change overflow and height to display full text
            document.getElementById('remaningText').style.overflow = 'inherit';
            document.getElementById('remaningText').style.height = 'auto';
        }
        else {
              // Change overflow and height to hide extra text
            document.getElementById('remaningText').style.overflow = 'hidden';
            document.getElementById('remaningText').style.height = '150px';
        }
    }
</script>