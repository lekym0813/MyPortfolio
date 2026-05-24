<!DOCTYPE html>
<?php
include_once('appdata.php');
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}
if (isset($_POST['apply'])){
  $file_name = $_FILES['files']['name'];
  $file_type = $_FILES['files']['type'];
  $file_size = $_FILES['files']['size'];
  $file_tem_loc = $_FILES['files']['tmp_name'];
  $file_store = "upload/" . $file_name;
  move_uploaded_file($file_tem_loc, $file_store);
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Application - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links"><a href="index.php"><i class="fas fa-home"></i> PrimeWater</a></div>
      <div class="right-links"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
    </div>
  </div>

  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="usermain.php">
          <img src="images/prime.jpg" alt="PrimeWater" style="height: 40px; border-radius: 4px; margin-right: 10px;">
          <span class="brand-text"><strong>PrimeWater</strong><small>Quezon Metro</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="usermain.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link active" href="application.php">Apply</a></li>
            <li class="nav-item"><a class="nav-link" href="complaint.php">Complaint</a></li>
            <li class="nav-item"><a class="nav-link" href="myappList.php">App Status</a></li>
            <li class="nav-item"><a class="nav-link" href="mycomplaint.php">Complaint Status</a></li>
            <li class="nav-item"><a class="nav-link" href="mybill.php">My Bills</a></li>
          </ul>
          <div class="nav-icons">
            <span class="user-info"><?php echo $_SESSION['email']; ?></span>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header">
    <div class="container">
      <h2><i class="fas fa-file-invoice"></i> Application Form</h2>
      <p>Apply for a new water connection</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-custom">
            <div class="card-header primary"><i class="fas fa-edit"></i> New Connection Application</div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data" class="form-custom">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="fname" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="address" required>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" name="contact" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Occupation</label>
                    <input type="text" class="form-control" name="occupation" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Birthday</label>
                    <input type="date" class="form-control" name="bday" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Classification</label>
                    <select name="classification" class="form-control" required>
                      <option value="">Choose...</option>
                      <option>Residential</option>
                      <option>Commercial</option>
                      <option>Bulk</option>
                      <option>Public Faucet</option>
                      <option>Government</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Type of Connection</label>
                  <select name="connection" class="form-control" required>
                    <option value="">Choose...</option>
                    <option>New Connection</option>
                    <option>Sub-Connection</option>
                    <option>Transfer of Tapping</option>
                    <option>Seperation Of Line</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Requirements (Upload File)</label>
                  <input type="file" class="form-control-file" name="files">
                </div>
                <div class="text-center mt-4">
                  <button type="submit" name="apply" class="btn-pw btn-pw-orange btn-pw-lg">
                    <i class="fas fa-paper-plane"></i> Submit Application
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
            <div class="card-body"><h5>Service Upgrade Notice</h5><p>We are upgrading our facilities to serve you better.</p></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic02.jpg');">
              <div class="img-overlay"><span class="date-badge">Update</span></div>
            </div>
            <div class="card-body"><h5>Water Conservation Tips</h5><p>Learn how to save water and reduce your monthly bill.</p></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic03.jpg');">
              <div class="img-overlay"><span class="date-badge">Event</span></div>
            </div>
            <div class="card-body"><h5>Community Outreach</h5><p>Join our upcoming community event for free water quality testing.</p></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="announcement-card">
            <div class="card-img" style="background-image: url('images/pic04.jpg');">
              <div class="img-overlay"><span class="date-badge">Advisory</span></div>
            </div>
            <div class="card-body"><h5>Scheduled Maintenance</h5><p>There will be a scheduled water service interruption on selected areas.</p></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6"><h5><img src="images/prime.jpg" alt="" style="height:24px;border-radius:4px;margin-right:6px;"> PrimeWater</h5><p style="font-size:13px;color:rgba(255,255,255,0.5);">Providing potable, reliable, and sustainable water.</p></div>
        <div class="col-md-3"><h5>Links</h5><a href="usermain.php">Dashboard</a><a href="logout.php">Logout</a></div>
        <div class="col-md-3"><h5>Contact</h5><p style="font-size:13px;color:rgba(255,255,255,0.5);">(02) 1234-5678</p></div>
      </div>
      <div class="footer-bottom text-center">&copy; <?php echo date('Y'); ?> PrimeWater Quezon Metro.</div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>