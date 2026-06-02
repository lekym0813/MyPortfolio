<!DOCTYPE html>
<?php
include('db.php');
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: usermain.php');
  exit();
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Complaint Status - PrimeWater Quezon Metro</title>
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
            <li class="nav-item"><a class="nav-link" href="myappList.php">App Status</a></li>
            <li class="nav-item"><a class="nav-link active" href="mycomplaint.php">Complaint Status</a></li>
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
      <h2><i class="fas fa-clipboard-list"></i> Complaint Status</h2>
      <p>Track the progress of your reported complaints</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="card-custom">
        <div class="card-header primary"><i class="fas fa-list"></i> My Complaints</div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table-custom">
              <thead>
                <tr><th>Name</th><th>Address</th><th>Account No.</th><th>Complaint</th><th>Status</th><th>Remarks</th></tr>
              </thead>
              <tbody>
                <?php
                $sql = $conn->query("SELECT address, name, accountnumber, complaint, status, remarks, remarks_date FROM complaint WHERE user_id='".$_SESSION['user_id']."' ORDER BY date DESC");
                if ($sql && $sql->rowCount() > 0) {
                  while ($rows = $sql->fetch()) {
                ?>
                <tr>
                  <td><?php echo htmlspecialchars($rows['name']); ?></td>
                  <td><?php echo htmlspecialchars($rows['address']); ?></td>
                  <td><?php echo htmlspecialchars($rows['accountnumber']); ?></td>
                  <td><?php echo htmlspecialchars($rows['complaint']); ?></td>
                  <td><?php
                    $s = $rows['status'];
                    if ($s == "On Process") echo '<span class="badge-pw badge-process">On Process</span>';
                    elseif ($s == "Schedule for Maintenance") echo '<span class="badge-pw badge-maintenance">Schedule for Maintenance</span>';
                    elseif ($s == "Accomplished") echo '<span class="badge-pw badge-accomplished">Accomplished</span>';
                    else echo '<span class="badge-pw badge-pending">Pending</span>';
                  ?></td>
                  <td style="max-width:200px;">
                    <?php if (!empty($rows['remarks'])): ?>
                      <span title="<?php echo htmlspecialchars($rows['remarks']); ?>"><?php echo htmlspecialchars(substr($rows['remarks'], 0, 60)) . (strlen($rows['remarks']) > 60 ? '...' : ''); ?></span>
                      <?php if (!empty($rows['remarks_date'])): ?>
                        <br><small class="text-muted"><?php echo date('M d, Y', strtotime($rows['remarks_date'])); ?></small>
                      <?php endif; ?>
                    <?php else: ?>
                      <span class="text-muted">—</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php
                  }
                } else {
                  echo '<tr><td colspan="6" class="text-center text-muted py-4">No complaints found.</td></tr>';
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