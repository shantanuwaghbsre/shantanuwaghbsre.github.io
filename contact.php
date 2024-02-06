<?php include 'config.php';  //include config
// set dynamic title
$db = new Database();
$db->select('options','site_title',null,null,null,null);
$result = $db->getResult();

if(!empty($result)){ 
    $title = $result[0]['site_title']; 
}else{ 
    $title = "Shopping Project";
}
// include header 
include 'header.php'; ?>

<!-- contact form start's here -->

<!-- Start Hero Section -->
			<div class="hero bg-white">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-4">
							<div class="hero-img-wrap">
								<img src="images/contact.gif" width="400px" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		
		<!-- Start Contact Form -->
		<div class="untree_co-section">
      <div class="container">

        <div class="block">
          <div class="row justify-content-center">


            <div class="col-md-8 col-lg-8 pb-4">


              <div class="row mb-5">
                <div class="col-lg-4 p-4">
                  <div  class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                    <div class="service-icon color-1 mb-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                      </svg>
                    </div> <!-- /.icon -->
                    <div class="service-contents m-3">
                      <p>JAY NARAYAN ESTATE, NR. DASHRATHGREEN, INDIRA NAGAR ROAD, DASHRATH VILLAGE, VADODARA, Gujarat, 391740</p>
                    </div> <!-- /.service-contents-->
                  </div> <!-- /.service -->
                </div>

                <div class="col-lg-4 p-4">
                  <div  class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                    <div class="service-icon color-1 mb-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                      </svg>
                    </div> <!-- /.icon -->
                    <div class="service-contents m-3">
                      <p>bsah@gmail.com</p>
                    </div> <!-- /.service-contents-->
                  </div> <!-- /.service -->
                </div>

                <div class="col-lg-4 p-4">
                  <div  class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                    <div class="service-icon color-1 mb-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                      </svg>
                    </div> <!-- /.icon -->
                    <div class="service-contents m-3">
                      <p>+91 79 9077 3529</p>
                    </div> <!-- /.service-contents-->
                  </div> <!-- /.service -->
                </div>
              </div>

              <form action="" method="POST">
              	<div class="container text-center mt-5 mb-5">
			     <h1>Fill the Feedback</h1>
		        </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="fname">First name</label>
                      <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="lname">Last name</label>
                      <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="text-black" for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group mb-5">
                  <label class="text-black" for="message">Message</label>
                  <textarea name="message" class="form-control" id="message" cols="30" rows="5"></textarea>
                </div>

                <button type="submit" name="save_btn" class="btn btn-primary-hover-outline" style="border:1px solid #0a0a0a;">Send Message</button>
              </form>

            </div>

          </div>

        </div>

      </div>


    </div>
  </div>

  <!-- End Contact Form -->

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "shopping_db";

  $con = mysqli_connect($servername,$username,$password,$dbname);

  if (isset($_POST['save_btn'])) {
  	$firstname = $_POST['firstname'];
  	$lastname = $_POST['lastname'];
  	$email = $_POST['email'];
  	$message = $_POST['message'];

  	$insert = "INSERT INTO contact(firstname,lastname,email,message) VALUES('$firstname','$lastname','$email','$message')";
  	$query = mysqli_query($con,$insert);
  	if ($query) {
  		?>

  		<script type="text/javascript">
  			alert("Response recorded successfully !");
  		</script>

  		<?php
  	}
  }

  ?>


<!-- contact form end's here -->

<?php include 'footer.php'; ?>