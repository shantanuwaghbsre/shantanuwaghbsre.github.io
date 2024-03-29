 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
    console.log("reached here");
        $(document).ready(function(){
  // Fade in effect on page load
  $('#content').fadeIn(1500); // Adjust the duration as needed
});
    </script>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- <h3><?php echo $footer[0]['site_name']; ?></h3>
                <p><?php echo $footer[0]['site_desc']; ?></p> -->
                <h3>Rishigyan.</h3>
                <p>Ayurvedic Lifestyle Wisdom: Embrace the art of balanced living with insights from Ayurvedic lifestyle practices. From daily routines (Dinacharya) to seasonal adjustments (Ritucharya), unlock the secrets to a harmonious life in tune with nature's rhythms.</p>
            </div>
            <div class="col-md-3">
                <h3>Group of Companies</h3>
                <!-- <ul class="menu-list">
                    <?php
                    $db = new Database();
                    $db->select('sub_categories','*',null,'cat_products > 0 AND show_in_footer ="1"',null,null);
                    $result = $db->getResult();
                    if(count($result) > 0){
                        foreach($result as $res){ ?>
                            <li><a href="category.php?cat=<?php echo $res['sub_cat_id']; ?>"><?php echo $res['sub_cat_title']; ?></a></li>
                        <?php    }
                    } ?>
                </ul> -->
                <ul>
                    <li>Bapa Sitaram Renewable Energy</li>
                    <li>Bapa Sitaram Inovation & Technology</li>
                    <li>Bapa Sitaram Credit Society</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Useful Links</h3>
                <ul class="menu-list">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="latest_products.php">Latest Products</a></li>
                    <li><a href="popular_products.php">Popular Products</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Contact Us</h3>
                <ul class="menu-list">
                    <?php if(!empty($footer[0]['contact_address'])){ ?>
                        <li><i class="fa fa-home" ></i><span>: <?php echo $footer[0]['contact_address']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_phone'])){ ?>
                        <li><i class="fa fa-phone" ></i><span>: <?php echo $footer[0]['contact_phone']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_email'])){ ?>
                        <li><i class="fa fa-envelope" ></i><span>: <?php echo $footer[0]['contact_email']; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-12">
                <span><a href="">&copy; Copyright by | Bapa Sitaram Healthcare and Ayurveda Pvt. Ltd.</a></span>
            </div>
        </div>
    </div>
</div>
<script src="js\jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\actions.js"></script>
<!--okzoom Plugin-->
<script src="js/okzoom.min.js" type="text/javascript"></script>
<!--owl carousel plugin-->
<script type="text/javascript" src="js/owl.carousel.js"></script>

<script>
    // Document ready function to ensure the DOM is fully loaded before executing the code
    $(document).ready(function(){
 // Initialize the okzoom plugin for image zooming
        $('#product-img').okzoom({
            width: 200, // Set the initial width of the zoomed image
            height: 200, // Set the initial height of the zoomed image
            scaleWidth: 800 // Set the maximum width of the zoomed image
        });
 // Initialize Owl Carousel for the banner carousel
        $('.banner-carousel').owlCarousel({
            loop: true, // Enable infinite loop
            margin: 0, // Set the margin between items
            responsiveClass: true, // Enable responsive design
            navText : ["",""], // Set navigation text to empty strings (no text)
            responsive: {             // Responsive breakpoints and configurations for different screen sizes

                0: {
                    items: 1, // Number of items to display at screen width 0px and above
                    nav: true // Enable navigation arrows

                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false, // Disable loop at screen width 1000px and above
                    margin: 10 // Set margin between items
                }
            }
        });
         // Initialize Owl Carousel for the popular products carousel
        $('.popular-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 4,
                    nav: true
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });
 // Initialize Owl Carousel for the latest products carousel
        $('.latest-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 5
                }
            }
        });
    });

</script>

</body>
</html>