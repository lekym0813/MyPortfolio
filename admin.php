<!DOCTYPE html>
<?php
include('db.php');
session_start();
if (!isset($_SESSION['user'])) { header('Location: adminLogin.php'); exit(); }
$stmt = $conn->query("SELECT COUNT(*) AS cnt FROM customer"); $total_customers = $stmt->fetch()['cnt'];
$stmt = $conn->query("SELECT COALESCE(SUM(amount),0) AS total FROM customer"); $total_bills_amount = $stmt->fetch()['total'];
$stmt = $conn->query("SELECT COUNT(*) AS cnt FROM complaint"); $total_complaints = $stmt->fetch()['cnt'];
$stmt = $conn->query("SELECT COUNT(*) AS cnt FROM complaint WHERE status='On Process' OR status IS NULL OR status=''"); $pending_complaints = $stmt->fetch()['cnt'];
$stmt = $conn->query("SELECT COUNT(*) AS cnt FROM application"); $total_applications = $stmt->fetch()['cnt'];
$recent_complaints = $conn->query("SELECT * FROM complaint ORDER BY id DESC LIMIT 5");
$recent_customers = $conn->query("SELECT * FROM customer ORDER BY cust_id DESC LIMIT 5");
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard - PrimeWater Quezon Metro</title>
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
        <a class="navbar-brand" href="admin.php">
          <img src="images/prime.jpg" alt="PrimeWater" style="height: 40px; border-radius: 4px; margin-right: 10px;">
          <span class="brand-text"><strong>PrimeWater</strong><small>Admin Panel</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link active" href="admin.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="admin_bills.php">Bills</a></li>
            <li class="nav-item"><a class="nav-link" href="complaintList.php">Complaints</a></li>
            <li class="nav-item"><a class="nav-link" href="applicationList.php">Applications</a></li>
          </ul>
          <div class="nav-icons">
            <span class="user-info">Welcome, <strong><?php echo $_SESSION['user']; ?></strong></span>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header">
    <div class="container">
      <h2><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>
      <p>PrimeWater Quezon Metro - Management Panel</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-4"><div class="stat-card bg-primary"><i class="fas fa-users icon"></i><div class="number"><?php echo $total_customers; ?></div><div class="label">Total Customers</div></div></div>
        <div class="col-md-4"><div class="stat-card bg-orange"><i class="fas fa-peso-sign icon"></i><div class="number">&#8369;<?php echo number_format($total_bills_amount, 2); ?></div><div class="label">Total Billable Amount</div></div></div>
        <div class="col-md-4"><div class="stat-card bg-warning"><i class="fas fa-exclamation-triangle icon"></i><div class="number"><?php echo $total_complaints; ?></div><div class="label">Total Complaints</div></div></div>
        <div class="col-md-4"><div class="stat-card bg-danger"><i class="fas fa-clock icon"></i><div class="number"><?php echo $pending_complaints; ?></div><div class="label">Pending Complaints</div></div></div>
        <div class="col-md-4"><div class="stat-card bg-info"><i class="fas fa-file-alt icon"></i><div class="number"><?php echo $total_applications; ?></div><div class="label">Total Applications</div></div></div>
        <div class="col-md-4"><div class="stat-card bg-secondary"><i class="fas fa-calendar icon"></i><div class="number"><?php echo date('Y'); ?></div><div class="label">Current Year</div></div></div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card-custom">
            <div class="card-header primary"><i class="fas fa-exclamation-circle"></i> Recent Complaints</div>
            <div class="card-body p-0">
              <table class="table-custom">
                <thead><tr><th>Name</th><th>Type</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                  <?php if ($recent_complaints->rowCount() > 0): ?>
                    <?php while ($c = $recent_complaints->fetch()): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($c['name']); ?></td>
                      <td><?php echo htmlspecialchars($c['complaint']); ?></td>
                      <td><?php $s = $c['status'] ?: 'Pending'; $cls = $s=='Accomplished'?'badge-accomplished':($s=='On Process'?'badge-process':'badge-pending'); echo '<span class="badge-pw '.$cls.'">'.htmlspecialchars($s).'</span>'; ?></td>
                      <td><?php echo htmlspecialchars($c['date']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr><td colspan="4" class="text-center text-muted py-3">No complaints yet.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer bg-white border-top px-3 py-2"><a href="complaintList.php" class="btn-pw btn-pw-primary btn-pw-sm">View All</a></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-custom">
            <div class="card-header primary"><i class="fas fa-users"></i> Recent Customers</div>
            <div class="card-body p-0">
              <table class="table-custom">
                <thead><tr><th>Name</th><th>Account</th><th>Amount</th><th>Month</th></tr></thead>
                <tbody>
                  <?php if ($recent_customers->rowCount() > 0): ?>
                    <?php while ($c = $recent_customers->fetch()): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($c['cust_name']); ?></td>
                      <td><?php echo htmlspecialchars($c['cust_account']); ?></td>
                      <td>&#8369;<?php echo number_format($c['amount'], 2); ?></td>
                      <td><?php echo htmlspecialchars($c['billing_month']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr><td colspan="4" class="text-center text-muted py-3">No customers yet.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer bg-white border-top px-3 py-2"><a href="admin_bills.php" class="btn-pw btn-pw-primary btn-pw-sm">Manage Bills</a></div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-3"><a href="admin_bills.php" class="quick-link"><i class="fas fa-file-invoice-dollar text-success"></i> Manage Bills</a></div>
        <div class="col-md-3"><a href="complaintList.php" class="quick-link"><i class="fas fa-exclamation-circle text-warning"></i> View Complaints</a></div>
        <div class="col-md-3"><a href="applicationList.php" class="quick-link"><i class="fas fa-file-signature text-info"></i> View Applications</a></div>
        <div class="col-md-3"><a href="logout.php" class="quick-link"><i class="fas fa-sign-out-alt text-danger"></i> Logout</a></div>
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
        <div class="col-md-6"><h5><img src="images/prime.jpg" alt="" style="height:24px;border-radius:4px;margin-right:6px;"> PrimeWater Admin</h5><p style="font-size:13px;color:rgba(255,255,255,0.5);">Management Panel - Quezon Metro</p></div>
        <div class="col-md-3"><h5>Links</h5><a href="admin.php">Dashboard</a><a href="logout.php">Logout</a></div>
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