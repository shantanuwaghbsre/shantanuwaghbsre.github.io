<?php 
    $db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php if(isset($title)){ ?>
        <title><?php echo $title; ?></title>
    <?php }else{ ?>
        <title>OnlineShop</title>
    <?php } ?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="myStyle.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        #content
        {
            display:none;
        }
    </style>
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-2">
                <?php
                    if(empty($header[0][''])){ ?>
                        <a href="#" class="logo-img"><img src="images/h.png" alt="" class="img-fluid" style="width:100px; padding:5px;"></a>
                    <?php }else{ ?>
                        <a href="" class="logo"></a>
                    <?php } ?>
            </div>
            <div>
                <?php
                // Determine the current page
                $currentPage = explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI']))-1];
                $hideCategories = false;
                // Check if the current page is any of the specified pages and set hideCategories accordingly
                if ($currentPage === "about.php" || $currentPage === "contact.php" || $currentPage === "register.php" || $currentPage === "user_profile.php" || $currentPage === "change_password.php" || $currentPage === "user_orders.php" || $currentPage === "cart.php" || "edit_user.php") {
                    $hideCategories = true;
                }

                ?>
            </div>
            <!-- /LOGO -->
            <div class="col-md-7">
                <form action="search.php" method="GET">
                <div class="input-group search">
                    <input type="text" class="form-control" name="search" placeholder="Search for..." required>
                    <span class="input-group-btn">
                        <input class="btn btn-default"  type="submit" value="Search" />
                    </span>
                </div>
                </form>
            </div>
            <div class="col-md-3">
                <ul class="header-info">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <?php
                            // Start session if not already started
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            // Check if user is logged in
                            if(isset($_SESSION["user_role"])){ ?>
                                Hello <?php echo $_SESSION["username"]; ?><i class="caret"></i>
                            <?php  }else{ ?>
                                 <!-- Display a default user icon if user is not logged in -->
                                <i class="fa fa-user"></i>
                            <?php  } ?>

                        </a>
                        <ul class="dropdown-menu">
                            <!-- Trigger the modal with a button -->
                            <?php
                                if(isset($_SESSION["user_role"])){ ?>
                                    <li><a href="user_profile.php" class="" >My Profile</a></li>
                                    <li><a href="user_orders.php" class="" >My Orders</a></li>
                                    <li><a href="javascript:void()" class="user_logout" >Logout</a></li>
                            <?php  }else{ ?>
                                    <li><a data-toggle="modal" data-target="#userLogin_form" href="#">login</a></li>
                                    <li><a href="register.php">Register</a></li>
                              <?php  } ?>

                        </ul>
                    </li>
                    <li>
                        <a href="wishlist.php"><i class="fa fa-heart"></i>
                            <?php
                             // Check if the 'wishlist_count' cookie is set
                             if(isset($_COOKIE['wishlist_count'])){
                                  // Display the count wrapped in a span tag
                                    echo '<span>'.$_COOKIE["wishlist_count"].'</span>';
                                } ?>
                        </a>
                    </li>
                    <li>
                        <a href="cart.php"><i class="fa fa-shopping-cart"></i>
                            <?php 
                            // Check if the 'cart_count' cookie is set
                            if(isset($_COOKIE['cart_count'])){
                                 // Display the count wrapped in a span tag
                                    echo '<span>'.$_COOKIE["cart_count"].'</span>';
                                } ?>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body">
                            <!-- Form -->
                            <form  id="loginUser" method ="POST">
                                <div class="customer_login"> 
                                    <h2>login here</h2>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control username" placeholder="Username" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control password" placeholder="password" autocomplete="off" required>
                                    </div>
                                    <input type="submit" name="login" class="btn" value="login"/>
                                    <span>Don't Have an Account <a href="register.php">Register</a></span>
                                </div>
                            </form>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
        </div>
    </div>
</div>
<?php include 'navbar.php'; ?>
<!-- Check if $hideCategories is false -->
<?php if (!$hideCategories) { ?>
     <!-- Display header menu -->
    <div id="header-menu" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul class="menu-list">
                    <?php
                     // Create a new instance of the Database class
                    $db = new Database();
                     // Select sub-categories from the database meeting certain conditions
                    $db->select('sub_categories','*',null,'cat_products > 0 AND show_in_header = "1"',null,null);
                    // Get the result of the query
                    $result = $db->getResult();
                    // Check if there are any results
                    if(count($result) > 0){
                         // Loop through each result
                        foreach($result as $res){ ?>
                              <!-- Display each sub-category as a list item -->
                            <li><a href="category.php?cat=<?php echo $res['sub_cat_id']; ?>"><?php echo $res['sub_cat_title']; ?></a></li>
                        <?php    }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php } ?>


