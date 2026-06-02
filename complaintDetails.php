<!DOCTYPE html>
<?php
include('db.php');
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: adminLogin.php');
  exit();
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Complaint Details - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <?php
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM complaint WHERE id=?");
  $stmt->execute([$id]);
  $rows = $stmt->fetch();
  if (!$rows) { echo '<div class="container mt-5"><div class="alert alert-danger">Complaint not found.</div></div>'; exit(); }
  ?>

  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links"><a href="index.php"><i class="fas fa-home"></i> PrimeWater</a></div>
      <div class="right-links"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
    </div>
  </div>

  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="admin.php"><span class="brand-text"><strong><i class="fas fa-tint text-primary-pw"></i> PrimeWater</strong><small>Admin Panel</small></span></a>
        <div class="nav-icons ml-auto">
          <span class="user-info"><?php echo $_SESSION['user']; ?></span>
          <a href="complaintList.php"><i class="fas fa-arrow-left"></i></a>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header">
    <div class="container">
      <h2><i class="fas fa-exclamation-circle"></i> Complaint Details</h2>
      <p>View complaint information</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-custom">
            <div class="card-header primary">Complaint #<?php echo str_pad($id, 4, '0', STR_PAD_LEFT); ?></div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6"><strong>Account Name:</strong><br><?php echo htmlspecialchars($rows['name']); ?></div>
                <div class="col-md-6"><strong>Account Number:</strong><br><?php echo htmlspecialchars($rows['accountnumber']); ?></div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6"><strong>Address:</strong><br><?php echo htmlspecialchars($rows['address']); ?></div>
                <div class="col-md-6"><strong>Contact No.:</strong><br><?php echo htmlspecialchars($rows['contact']); ?></div>
              </div>
              <hr>
              <div class="row mb-3">
                <div class="col-md-6"><strong>Complaint Type:</strong><br><?php echo htmlspecialchars($rows['complaint']); ?></div>
                <div class="col-md-6"><strong>Status:</strong><br>
                  <?php
                  $s = $rows['status'] ?: 'Pending';
                  $cls = 'badge-pending';
                  if ($s == 'Accomplished') $cls = 'badge-accomplished';
                  elseif ($s == 'On Process') $cls = 'badge-process';
                  elseif ($s == 'Schedule for Maintenance') $cls = 'badge-maintenance';
                  echo '<span class="badge-pw ' . $cls . '">' . htmlspecialchars($s) . '</span>';
                  ?>
                </div>
              </div>
              <?php if (!empty($rows['remarks'])): ?>
              <div class="row mb-3">
                <div class="col-12">
                  <strong>Remarks:</strong><br>
                  <div style="background:var(--bg-light);padding:12px 16px;border-radius:8px;margin-top:4px;font-size:14px;"><?php echo nl2br(htmlspecialchars($rows['remarks'])); ?></div>
                  <?php if (!empty($rows['remarks_date'])): ?>
                    <small class="text-muted">Added on <?php echo date('F d, Y h:i A', strtotime($rows['remarks_date'])); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <?php endif; ?>
              <div class="text-center mt-4">
                <a href="complaint-update.php?id=<?php echo $id; ?>" class="btn-pw btn-pw-orange"><i class="fas fa-edit"></i> Update Status</a>
                <a href="complaintList.php" class="btn-pw btn-pw-outline"><i class="fas fa-arrow-left"></i> Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6"><h5><i class="fas fa-tint"></i> PrimeWater Admin</h5></div>
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