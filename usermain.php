<?php
require_once('logindata.php');
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links">
        <a href="index.php"><i class="fas fa-home"></i> PrimeWater</a>
        <a href="#">About Us</a>
      </div>
      <div class="right-links">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </div>

  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="usermain.php">
          <img src="images/prime.jpg" alt="PrimeWater" style="height: 40px; border-radius: 4px; margin-right: 10px;">
          <span class="brand-text">
            <strong>PrimeWater</strong>
            <small>Quezon Metro</small>
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link active" href="usermain.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="application.php">Apply</a></li>
            <li class="nav-item"><a class="nav-link" href="complaint.php">Complaint</a></li>
            <li class="nav-item"><a class="nav-link" href="myappList.php">App Status</a></li>
            <li class="nav-item"><a class="nav-link" href="mycomplaint.php">Complaint Status</a></li>
            <li class="nav-item"><a class="nav-link" href="mybill.php">My Bills</a></li>
          </ul>
          <div class="nav-icons">
            <div class="dropdown-user">
              <a href="#" data-toggle="dropdown"><i class="fas fa-user-circle" style="font-size: 24px;"></i></a>
              <div class="dropdown-menu">
                <span class="px-3 py-2 d-block text-muted" style="font-size: 15px;">
                  <strong><?php echo $_SESSION['email']; ?></strong>
                </span>
                <div class="dropdown-divider"></div>
                <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero Carousel -->
  <div id="heroCarousel" class="carousel slide hero-carousel" data-ride="carousel" data-interval="5000">
    <ol class="carousel-indicators">
      <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#heroCarousel" data-slide-to="1"></li>
      <li data-target="#heroCarousel" data-slide-to="2"></li>
      <li data-target="#heroCarousel" data-slide-to="3"></li>
      <li data-target="#heroCarousel" data-slide-to="4"></li>
      <li data-target="#heroCarousel" data-slide-to="5"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-image: url('images/header.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php">Home</a></li><li class="breadcrumb-item active">Dashboard</li></ol></nav>
          <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
          <p>Manage your water account services</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('images/header2.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <h1>Track Your Complaints</h1>
          <p>Stay updated on the status of your reported concerns.</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('images/header4.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <h1>View Your Bills</h1>
          <p>Check your billing history and statements online.</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('images/header5.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <h1>Apply for Connection</h1>
          <p>Submit a new water service application easily.</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('images/header6.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <h1>Report a Concern</h1>
          <p>Report leaks, no water, or other service issues.</p>
        </div>
      </div>
      <div class="carousel-item" style="background-image: url('images/header7.jpg');">
        <div class="carousel-overlay"></div>
        <div class="carousel-caption">
          <h1>Stay Connected</h1>
          <p>We are here to serve you better every day.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
  </div>

  <!-- Video Section -->
  <div class="section" style="background: #fff; padding: 40px 0;">
    <div class="container">
      <div class="text-center mb-4">
        <h2 class="text-primary-pw font-weight-bold">How It Works</h2>
        <p class="text-muted">Learn more about PrimeWater services</p>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="embed-responsive embed-responsive-16by9" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.12);">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0oqw_eHKOKA" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Dashboard Content -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <a href="application.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-file-invoice" style="font-size: 40px; color: var(--primary);"></i>
            <h5 class="mt-3 font-weight-bold">Apply for Connection</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Submit a new water service application</p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="complaint.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-exclamation-triangle" style="font-size: 40px; color: var(--orange);"></i>
            <h5 class="mt-3 font-weight-bold">Report Complaint</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Report leaks, no water, or other issues</p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="mybill.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-file-invoice-dollar" style="font-size: 40px; color: #28a745;"></i>
            <h5 class="mt-3 font-weight-bold">View Bills</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Check billing history and statements</p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="mycomplaint.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-clipboard-list" style="font-size: 40px; color: #17a2b8;"></i>
            <h5 class="mt-3 font-weight-bold">Complaint Status</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Track your reported complaints</p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="myappList.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-tasks" style="font-size: 40px; color: #6f42c1;"></i>
            <h5 class="mt-3 font-weight-bold">Application Status</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Check your application progress</p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="logout.php" class="card-custom d-block p-4 text-center">
            <i class="fas fa-sign-out-alt" style="font-size: 40px; color: #dc3545;"></i>
            <h5 class="mt-3 font-weight-bold">Logout</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">Sign out of your account</p>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php include 'bill_calculator.php'; ?>

  <!-- Announcements -->
  <div class="announcement-section">
    <div class="container">
      <div class="section-title">
        <h2>Announcements</h2>
        <p>Latest news and updates from PrimeWater Quezon Metro</p>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic01.jpg');">
              <div class="img-overlay"><span class="date-badge">New</span></div>
            </div>
            <div class="card-body">
              <h5>Service Upgrade Notice</h5>
              <p>We are upgrading our facilities to serve you better. Stay tuned for improved water service.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic02.jpg');">
              <div class="img-overlay"><span class="date-badge">Update</span></div>
            </div>
            <div class="card-body">
              <h5>Water Conservation Tips</h5>
              <p>Learn how to save water and reduce your monthly bill.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic03.jpg');">
              <div class="img-overlay"><span class="date-badge">Event</span></div>
            </div>
            <div class="card-body">
              <h5>Community Outreach</h5>
              <p>Join our upcoming community event for free water quality testing.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic04.jpg');">
              <div class="img-overlay"><span class="date-badge">Advisory</span></div>
            </div>
            <div class="card-body">
              <h5>Scheduled Maintenance</h5>
              <p>There will be a scheduled water service interruption on selected areas.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5><img src="images/prime.jpg" alt="" style="height: 24px; border-radius: 4px; margin-right: 6px;"> PrimeWater</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">Providing potable, reliable, and sustainable water to Filipino communities.</p>
        </div>
        <div class="col-md-3">
          <h5>Quick Links</h5>
          <a href="index.php">Home</a>
          <a href="logout.php">Logout</a>
        </div>
        <div class="col-md-3">
          <h5>Contact</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">
            <i class="fas fa-phone"></i> (02) 1234-5678<br>
            <i class="fas fa-envelope"></i> support@primewater.ph
          </p>
        </div>
      </div>
      <div class="footer-bottom text-center">
        &copy; <?php echo date('Y'); ?> PrimeWater Quezon Metro. All rights reserved.
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>