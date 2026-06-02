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
  <title>Bill Details - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
  <style>@media print { .no-print { display: none !important; } }</style>
</head>
<body>
  <?php
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM customer WHERE cust_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  $rows = $stmt->fetch();
  if (!$rows) { echo '<div class="container mt-5"><div class="alert alert-danger">Bill not found.</div></div>'; exit(); }
  ?>

  <div class="utility-bar no-print clearfix">
    <div class="container">
      <div class="left-links"><a href="index.php"><i class="fas fa-home"></i> PrimeWater</a></div>
      <div class="right-links"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
    </div>
  </div>

  <header class="main-header no-print">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="usermain.php">
          <img src="images/prime.jpg" alt="PrimeWater" style="height: 40px; border-radius: 4px; margin-right: 10px;">
          <span class="brand-text"><strong>PrimeWater</strong><small>Quezon Metro</small></span>
        </a>
        <div class="nav-icons ml-auto">
          <span class="user-info"><?php echo $_SESSION['email']; ?></span>
          <a href="mybill.php"><i class="fas fa-arrow-left"></i></a>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header no-print">
    <div class="container">
      <h2><i class="fas fa-file-invoice-dollar"></i> Billing Statement</h2>
      <p>Bill reference: #<?php echo str_pad($id, 6, '0', STR_PAD_LEFT); ?></p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="receipt-wrapper" id="receipt">
        <div class="receipt-header">
          <h3><img src="images/prime.jpg" alt="" style="height:30px;border-radius:4px;margin-right:8px;"> PrimeWater Quezon Metro</h3>
          <p>Official Billing Statement</p>
        </div>
        <div class="receipt-body">
          <div class="info-row"><span class="label">Account Name</span><span class="value"><?php echo htmlspecialchars($rows['cust_name']); ?></span></div>
          <div class="info-row"><span class="label">Account No.</span><span class="value"><?php echo htmlspecialchars($rows['cust_account']); ?></span></div>
          <div class="info-row"><span class="label">Address</span><span class="value"><?php echo htmlspecialchars($rows['cust_address']); ?></span></div>
          <div class="info-row"><span class="label">Billing Month</span><span class="value"><?php echo htmlspecialchars($rows['billing_month']); ?></span></div>
          <div class="info-row"><span class="label">Meter Reading</span><span class="value"><?php echo number_format($rows['PrReading'],2); ?> - <?php echo number_format($rows['CReading'],2); ?> = <?php echo number_format($rows['TReading'],2); ?> m&sup3;</span></div>
          <div class="info-row"><span class="label">Due Date</span><span class="value"><?php echo htmlspecialchars($rows['due_date']); ?></span></div>
          <div class="info-row"><span class="label">Status</span><span class="value"><?php echo $rows['status'] ?? 'Unpaid'; ?></span></div>
          <div class="total-row"><span>Total Amount Due</span><span>&#8369;<?php echo number_format($rows['amount'], 2); ?></span></div>
        </div>
      </div>
      <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn-pw btn-pw-primary btn-pw-lg mr-2"><i class="fas fa-print"></i> Print</button>
        <a href="mybill.php" class="btn-pw btn-pw-outline btn-pw-lg"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
    </div>
  </div>

  <!-- Announcements -->
  <div class="announcement-section no-print">
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

  <footer class="main-footer no-print">
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