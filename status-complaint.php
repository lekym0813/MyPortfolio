<?php 
include('db.php');
session_start();
if (!isset($_SESSION['email'])){
	header('Location: usermain.php');
}
?>
<!DOCTYPE HTML>
<!--
	Linear by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>PrimeWater Quezon Metro</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="admin.php">Homepage</a></li>
						<li><a href="applicationList.php">Application List</a></li>
						<li class="active"><a href="complaintList.php">Complaint List</a></li>
						<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">PrimeWater</a></h1>
					<span class="tag">Quezon Metro</span>
				</div>
			</div>
		</div>
	<!-- Header --> 
	<?php
  {
	$id=$_GET['id'];
	$sql=("select * from complaint where user_id='$id'");
	$result=$conn->query($sql);
	while($rows=$result->fetch())
	{
  ?>
	<!-- Main -->
		<div id="main">
			<div class="container">
			<form method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Account Name</label>
      <input type="text" class="form-control" name="accountname"id="inputEmail4" readonly value="<?php echo  $rows['name']; ?>" >
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Account Number</label>
      <input type="text" class="form-control" id="inputPassword4"  name="accountnum" readonly value="<?php echo  $rows['accountnumber']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" name="address" readonly value="<?php echo  $rows['address']; ?>">
  </div>
  <div class="form-group">
    <label for="inputAddress">Contact No.</label>
    <input type="text" class="form-control" id="inputAddress" name="contact" readonly value="<?php echo  $rows['contact']; ?>">
  </div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01" name="complaint">Complaint</label>
	<input type="text" class="form-control" id="inputAddress" name="address" readonly value="<?php echo  $rows['complaint']; ?>">
  </div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01" name="status">Status</label>
	<input type="text" class="form-control" id="inputAddress" name="address" readonly value="<?php echo  $rows['status']; ?>">
  </div>
  <style>
	  .text-center{
		  margin-top: 20px;
	  }
	  .form-control1{
		  width: 250px;
	  }
	  </style>
</div>

<?php
  }
}
  ?>
  
  
</form>
			<div class="container">
            </div>
            </div>
		</div>
				<div class="row">

					
								
									
					
				</div>
			</div>
		</div>
	<!-- /Main -->

	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;The PrimeWater Mission To provide potable, reliable, and sustainable water to Filipino communities. <br> The PrimeWater Vision</strong> To be one of the country’s premier water utility companies.&rdquo;</blockquote>
				</section>
			</div>
		</div>
	<!-- /Tweet -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
					<header>
						<h2>Get in touch</h2>
						<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
					</header>
					<ul class="contact">
						<li><a href="#" class="fa fa-twitter"><span>Twitter</span></a></li>
						<li class="active"><a href="#" class="fa fa-facebook"><span>Facebook</span></a></li>
						<li><a href="#" class="fa fa-dribbble"><span>Pinterest</span></a></li>
						<li><a href="#" class="fa fa-tumblr"><span>Google+</span></a></li>
					</ul>
				</section>
			</div>
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>


	</body>
</html>