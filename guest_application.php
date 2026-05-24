<!DOCTYPE html>
<?php
require_once 'guest_session.php';
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'guest') {
  header('Location: guest_login.php');
  exit();
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Application - Guest Portal - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
  <style>
    .guest-badge { background: #6c63ff; color: #fff; padding: 2px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px; }
  </style>
</head>
<body>
  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links"><a href="index.php"><i class="fas fa-home"></i> PrimeWater</a></div>
      <div class="right-links"><a href="guest_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
    </div>
  </div>

  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="guest_main.php">
          <img src="images/prime.jpg" alt="PrimeWater" style="height: 40px; border-radius: 4px; margin-right: 10px;">
          <span class="brand-text"><strong>PrimeWater</strong><small>Quezon Metro</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="guest_main.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link active" href="guest_application.php">Apply</a></li>
          </ul>
          <div class="nav-icons">
            <span class="user-info"><?php echo htmlspecialchars($_SESSION['guest_name'] ?? $_SESSION['guest_email']); ?></span>
            <a href="guest_logout.php"><i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header" style="background: linear-gradient(135deg, #6c63ff, #4834d4);">
    <div class="container">
      <h2><i class="fas fa-file-invoice"></i> New Connection Application</h2>
      <p>Apply for a new water connection as a guest</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-custom">
            <div class="card-header primary"><i class="fas fa-edit"></i> Application Form</div>
            <div class="card-body">
              <form method="POST" action="guest_appdata.php" enctype="multipart/form-data" class="form-custom">
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

  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6"><h5><img src="images/prime.jpg" alt="" style="height:24px;border-radius:4px;margin-right:6px;"> PrimeWater</h5><p style="font-size:13px;color:rgba(255,255,255,0.5);">Providing potable, reliable, and sustainable water.</p></div>
        <div class="col-md-3"><h5>Links</h5><a href="guest_main.php">Dashboard</a><a href="guest_logout.php">Logout</a></div>
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
