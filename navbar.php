<!DOCTYPE html>  <!-- Declares the document type -->
<html> <!-- Starts the HTML document -->
<head> <!-- Begins the head section -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head> <!-- Ends the head section -->
<body> <!-- Begins the body of the document -->

<!-- Navbar -->
<div class="w3-bar w3-black" style="padding:20px;"> <!-- Creates a black navigation bar with padding -->
  <a href="index.php" class="w3-bar-item w3-button w3-mobile">Home</a><!-- Home link -->
  <div class="w3-dropdown-hover w3-mobile"> <!-- Creates a dropdown menu -->
    <button class="w3-button">Products <i class="fa fa-caret-down"></i></button>  <!-- Button to toggle the dropdown -->
    <div class="w3-dropdown-content w3-bar-block w3-card-4" style="z-index:99;"> <!-- Dropdown content container -->
      <a href="all_products.php" class="w3-bar-item w3-button">All Products</a>  <!-- Link to all products page -->
      <a href="latest_products.php" class="w3-bar-item w3-button">Latest Products</a> <!-- Link to latest products page -->
      <a href="popular_products.php" class="w3-bar-item w3-button">Popular Products</a> <!-- Link to popular products page -->
    </div> <!-- Ends the dropdown content container -->
  </div> <!-- Ends the dropdown menu -->
  <a href="about.php" class="w3-bar-item w3-button w3-mobile">About</a> <!-- About link -->
  <a href="#" class="w3-bar-item w3-button w3-mobile">Blogs</a> <!-- Blogs link -->
  <a href="contact.php" class="w3-bar-item w3-button w3-mobile">Contact</a> <!-- Contact link -->
</div>  <!-- Ends the navigation bar -->

</body>  <!-- Ends the body of the document -->
</html> <!-- Ends the HTML document -->
