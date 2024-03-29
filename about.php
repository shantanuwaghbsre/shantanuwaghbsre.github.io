<?php include 'config.php';  // Include the configuration file to access database settings.

// Initialize the database connection.
$db = new Database();

?>

<?php 
// Include the header file for displaying header content.
include 'header.php';
 
?>

<!DOCTYPE html>
<html>
<head>
<title>About Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
   /* CSS styles for the about us page */
  .w3-content {
    max-width: 900px;
    margin: auto;
    padding: 20px;
  }
  .w3-row-padding {
    margin: 0 -16px;
  }
  .w3-half {
    width: 50%;
    padding: 0 16px;
  }
</style>
</head>
<body>

<div class="w3-content">
  <h2 class="w3-center">About Us</h2>
    <!-- First section about the team -->
  <div class="w3-row-padding w3-margin-top">
    <div class="w3-half">
      <img src="images/tech.png" alt="Team" style="width:100%">
    </div>
    <div class="w3-half">
      <h3>Who We Are</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis libero eget ipsum posuere volutpat. Nullam auctor, felis a cursus placerat, ex tellus vestibulum est, a consectetur nisi tellus ac nulla. Quisque quis est dui. Nulla facilisi. Nam non turpis ut lorem imperdiet ultricies.</p>
      <p>Suspendisse potenti. Mauris bibendum, ligula sit amet gravida commodo, dui urna suscipit nisi, ac vehicula risus mi vitae ex. Nam efficitur odio id nisi mollis, nec sodales lectus finibus. Curabitur eget pulvinar est, nec fermentum metus.</p>
    </div>
  </div>
   <!-- Second section about our mission -->
  <div class="w3-row-padding w3-margin-top">
    <div class="w3-half">
      <h3>Our Mission</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis libero eget ipsum posuere volutpat. Nullam auctor, felis a cursus placerat, ex tellus vestibulum est, a consectetur nisi tellus ac nulla.</p>
      <p>Quisque quis est dui. Nulla facilisi. Nam non turpis ut lorem imperdiet ultricies. Suspendisse potenti. Mauris bibendum, ligula sit amet gravida commodo, dui urna suscipit nisi, ac vehicula risus mi vitae ex.</p>
    </div>
    <div class="w3-half">
      <img src="images/tree.png" alt="Mission" style="width:100%">
    </div>
  </div>
</div>

</body>
</html>


<?php include 'footer.php'; ?>