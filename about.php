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

<div class="container p-5">
	<div class="col-md-6">
		<img src="images/about-img.png" class="img-fluid">
	</div>
	<div class="col-md-6" id="about_intro">
		<h3>TECHNOLOGY AT RISHIGYAN</h3>
		<h1>INNOVATION</h1>
		<p id="p1">Rishigyan technology drives path-breaking, customer-focused innovation that makes high quality products accessible to Indian shoppers, besides making the online shopping experience convenient, intuitive and seamless.</p>
		<p id="p2">The future of e-commerce is sustainable, equitable and inclusive. As we continue to drive changes across key areas of our operations, our commitment is embedded in our vision to create a positive impact, for the planet and communities.</p>
		<br>
		<h1>RISHIGYAN CULTURE</h1>
        <p id="p3">Rishigyan culture is steeped in fostering trust, inclusion, support, recognition and genuine care that enables Flipsters to create, innovate, and bring their best selves to work</p>
		<button id="btn">Explore More</button>
	</div>
</div>

<?php include 'footer.php'; ?>