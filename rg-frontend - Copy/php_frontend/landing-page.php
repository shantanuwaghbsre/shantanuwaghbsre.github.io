<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- Bootstrap Icons CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
 
  </head>
  <body>

    <?php include 'navbar.php' ?>

<div class="container mt-5 p-5 jumbotron bg-dark text-white">
  <div class="row">
    <div class="col-md-6">
      <h1 class="display-4">Ayurveda isssss a <span class="text-info">Science</span> of ancient Rishis</h1>
      <p>To preserve the health of healthy person To cure the disease of diseased person</p>
      <button class="btn btn-danger">Explore</button>
    </div>
    <div class="col-md-6">
      <img src="..rgav/rg-frontend - Copy/images/Rishi.png" width="300px" class="img-fluid">
    </div>
  </div>
</div>

<?php include 'about.php'; ?>
<?php include 'blog_file.php'; ?>
<?php include 'choose.php'; ?>
<?php include 'choose-healthy.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>