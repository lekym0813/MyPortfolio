<?php
include('db.php');
session_start();
if (!isset($_SESSION['user'])){
	header('Location: adminLogin.php');
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Primewater Quezon Metro</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="active"><a href="admin.php">Homepage</a></li>
						<li><a href="applicationList.php">Application List</a></li>
						<li><a href="complaintList.php">Complaint List</a></li>
						<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Primewater </a></h1>
					<span class="tag">Quezon Metro</span>
				</div>
			</div>
		</div>

	<!-- Featured -->
		<div id="featured">
			<div class="container">
				<header>
					<h2>Welcome to Primewater Quezon Metro</h2>
				</header>
				<p><strong>The PrimeWater Mission</strong> To provide potable, reliable, and sustainable water to Filipino communities. <br> <strong>The PrimeWater Vison</strong> To be one of the country’s premier water utility companies.</p>
				<hr />
				<table class="table">
                <div class="container-fluid jumbotron">
             <form action="#" method="post">
                 <div class="row">
                     <div class="col-md-4">
                         <input type="date" class="form-control" name="start_date">
                    </div>
                    <div class="col-md-4">
                         <input type="date" class="form-control" name="last_date">
                    </div>
                    <div class="col-md-4">
                         <input type="submit" class="form-control" name="search">
                    </div>

        

    </div>			
  <thead>
    <tr>
      
      <th scope="col">Name</th>
	  
      
      <th scope="col">Complaint</th>
	  <th scope="col">Date</th>
	  <th scope="col">Details</th>
    </tr>
  </thead>
  <?php
  {
	$sql=("select address, id, name, accountnumber, date, complaint from complaint");
	$result=$conn->query($sql);
	while($rows=$result->fetch())
	{
  ?>
  <tbody>
    <tr>
     
      <td><?php echo  $rows['name']; ?></td> 
	  
      <td><?php echo $rows['complaint']; ?></td>
	  <td><?php echo $rows['date']; ?></td>
	  <td><a href="complaintDetails.php?id=<?php echo  $rows['id']; ?>">View</a></td>
	  <td><a href="complaint-update.php?id=<?php echo  $rows['id']; ?>">Update</a></td>
	  
    </tr>
  <?php
  }
}
  ?>
  </tbody>
</table>
				</div>
			</div>
		</div>

	
        </form>
	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat.&rdquo;</blockquote>
				</section>
			</div>
		</div>

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

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>

	</body>
</html>