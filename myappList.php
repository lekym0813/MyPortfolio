<?php
include('db.php');
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: adminLogin.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Application Status - PrimeWater Quezon Metro</title>
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
            <li class="nav-item"><a class="nav-link" href="application.php">Apply</a></li>
            <li class="nav-item"><a class="nav-link" href="complaint.php">Complaint</a></li>
            <li class="nav-item"><a class="nav-link active" href="myappList.php">App Status</a></li>
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
      <h2><i class="fas fa-tasks"></i> Application Status</h2>
      <p>Check the progress of your water service applications</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="card-custom">
        <div class="card-header primary"><i class="fas fa-list"></i> My Applications</div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table-custom">
              <thead>
                <tr><th>First Name</th><th>Last Name</th><th>Date Applied</th><th>Connection Type</th><th>Status</th></tr>
              </thead>
              <tbody>
                <?php
$sql = $conn->query("SELECT fname, lname, date, conntype, status FROM application WHERE user_id='".$_SESSION['user_id']."'");
if ($sql && $sql->rowCount() > 0) {
  while ($rows = $sql->fetch()) {
                ?>
                <tr>
                  <td><?php echo htmlspecialchars($rows['fname']); ?></td>
                  <td><?php echo htmlspecialchars($rows['lname']); ?></td>
                  <td><?php echo htmlspecialchars($rows['date']); ?></td>
                  <td><?php echo htmlspecialchars($rows['conntype']); ?></td>
                  <td><?php
                    $s = $rows['status'];
                    if ($s == "For Inspection") echo '<span class="badge-pw badge-inspection">For Inspection</span>';
                    elseif ($s == "For Payment") echo '<span class="badge-pw badge-payment">For Payment</span>';
                    elseif ($s == "For additional Requirements") echo '<span class="badge-pw badge-requirements">For Additional Requirements</span>';
                    elseif ($s == "Installed") echo '<span class="badge-pw badge-installed">Installed</span>';
                    else echo '<span class="badge-pw badge-pending">'.htmlspecialchars($s ?: 'Pending').'</span>';
                  ?></td>
                </tr>
                <?php
                  }
                } else {
                  echo '<tr><td colspan="5" class="text-center text-muted py-4">No applications found.</td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Announcements -->
  <div class="announcement-section">
    <div class="container">
      <div class="section-title"><h2>Announcements</h2><p>Latest news and updates from PrimeWater Quezon Metro</p></div>
      <div class="row">
        <div class="col-md-3"><div class="announcement-card"><div class="card-img" style="background-image:url('images/pic01.jpg');"><div class="img-overlay"><span class="date-badge">New</span></div></div><div class="card-body"><h5>Service Upgrade Notice</h5><p>We are upgrading our facilities to serve you better.</p></div></div></div>
        <div class="col-md-3"><div class="announcement-card"><div class="card-img" style="background-image:url('images/pic02.jpg');"><div class="img-overlay"><span class="date-badge">Update</span></div></div><div class="card-body"><h5>Water Conservation Tips</h5><p>Learn how to save water and reduce your monthly bill.</p></div></div></div>
        <div class="col-md-3"><div class="announcement-card"><div class="card-img" style="background-image:url('images/pic03.jpg');"><div class="img-overlay"><span class="date-badge">Event</span></div></div><div class="card-body"><h5>Community Outreach</h5><p>Join our upcoming community event for free water quality testing.</p></div></div></div>
        <div class="col-md-3"><div class="announcement-card"><div class="card-img" style="background-image:url('images/pic04.jpg');"><div class="img-overlay"><span class="date-badge">Advisory</span></div></div><div class="card-body"><h5>Scheduled Maintenance</h5><p>There will be a scheduled water service interruption on selected areas.</p></div></div></div>
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