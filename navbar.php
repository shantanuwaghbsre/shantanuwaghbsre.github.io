
<?php include 'boot_link.php' ?>
<div class="container-fluid">
<!-- Navbar start's here -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fs-3">
  <div class="container-fluid p-5" style="background-color:#f9f9f9;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu fs-3">
            <li><a class="dropdown-item" href="all_products.php">All Products</a></li>
            <li><a class="dropdown-item" href="latest_products.php">Latest Products</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="popular_products.php">Popular Products</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar end's here -->
</div>