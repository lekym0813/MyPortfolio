<?php
include('db.php');
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: adminLogin.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Complaint List - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <!-- Utility Bar -->
  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links"><a href="index.php"><i class="fas fa-home"></i> PrimeWater</a></div>
      <div class="right-links"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
    </div>
  </div>

  <!-- Main Header -->
  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="admin.php">
          <span class="brand-text"><strong><i class="fas fa-tint text-primary-pw"></i> PrimeWater</strong><small>Admin Panel</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="admin.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="admin_bills.php">Bills</a></li>
            <li class="nav-item"><a class="nav-link active" href="complaintList.php">Complaints</a></li>
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

  <!-- Page Header -->
  <div class="page-header">
    <div class="container">
      <h2><i class="fas fa-exclamation-circle"></i> Complaint List</h2>
      <p>Manage and filter customer complaints</p>
    </div>
  </div>

  <!-- Content -->
  <div class="section">
    <div class="container">
      <!-- Filter -->
      <div class="filter-section">
        <form method="POST" class="form-custom">
          <div class="row">
            <div class="col-md-3">
              <label>Complaint Type</label>
              <select name="complaint" class="form-control">
                <option value="">All</option>
                <option value="High Consumption">High Consumption</option>
                <option value="Leaking Pipe">Leaking Pipe</option>
                <option value="Dirty Water">Dirty Water</option>
                <option value="No Water">No Water</option>
              </select>
            </div>
            <div class="col-md-3">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="">All</option>
                <option value="On Process">On Process</option>
                <option value="Accomplished">Accomplished</option>
                <option value="Schedule for Maintenance">Schedule for Maintenance</option>
              </select>
            </div>
            <div class="col-md-2">
              <label>From</label>
              <input type="date" class="form-control" name="from_date">
            </div>
            <div class="col-md-2">
              <label>To</label>
              <input type="date" class="form-control" name="to_date">
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="submit" name="submit" class="btn-pw btn-pw-primary btn-pw-sm w-100"><i class="fas fa-filter"></i> Filter</button>
            </div>
          </div>
        </form>
      </div>

      <!-- Table -->
      <div class="card-custom">
        <div class="card-header primary d-flex justify-content-between align-items-center">
          <span><i class="fas fa-list"></i> Complaints</span>
          <a href="export.php" class="btn-pw btn-pw-sm" style="background:#fff;color:var(--primary);" target="_blank"><i class="fas fa-file-excel"></i> Export</a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Name</th><th>Complaint</th><th>Date</th><th>Status</th><th>Remarks</th><th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!isset($_POST['submit'])) {
                  $query = "SELECT * FROM complaint";
                  $result = $conn->query($query);
                } else {
                  $complaint = $_POST['complaint'];
                  $status = $_POST['status'];
                  $start_date = $_POST['from_date'];
                  $last_date = $_POST['to_date'];
                  $conditions = [];
                  if (!empty($complaint)) $conditions[] = "complaint ='$complaint'";
                  if (!empty($status)) $conditions[] = "status ='$status'";
                  if (!empty($start_date) && !empty($last_date)) $conditions[] = "date BETWEEN '$start_date' AND '$last_date'";
                  $where = count($conditions) > 0 ? implode(" OR ", $conditions) : "1=1";
                  $query = "SELECT * FROM complaint WHERE $where";
                  $result = $conn->query($query);
                }
                if ($result && $result->rowCount() > 0) {
                  foreach ($result as $rows) {
                ?>
                <tr>
                  <td><?php echo htmlspecialchars($rows['name']); ?></td>
                  <td><?php echo htmlspecialchars($rows['complaint']); ?></td>
                  <td><?php echo htmlspecialchars($rows['date']); ?></td>
                  <td>
                    <?php
                    $s = $rows['status'] ?: 'Pending';
                    $cls = 'badge-pending';
                    if ($s == 'Accomplished') $cls = 'badge-accomplished';
                    elseif ($s == 'On Process') $cls = 'badge-process';
                    elseif ($s == 'Schedule for Maintenance') $cls = 'badge-maintenance';
                    echo '<span class="badge-pw ' . $cls . '">' . htmlspecialchars($s) . '</span>';
                    ?>
                  </td>
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
                  <td>
                    <a href="complaintDetails.php?id=<?php echo $rows['id']; ?>" class="btn-pw btn-pw-primary btn-pw-sm"><i class="fas fa-eye"></i></a>
                    <a href="complaint-update.php?id=<?php echo $rows['id']; ?>" class="btn-pw btn-pw-orange btn-pw-sm"><i class="fas fa-edit"></i></a>
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

  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5><i class="fas fa-tint"></i> PrimeWater Admin</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">Management Panel</p>
        </div>
        <div class="col-md-3">
          <h5>Links</h5>
          <a href="admin.php">Dashboard</a>
          <a href="logout.php">Logout</a>
        </div>
        <div class="col-md-3">
          <h5>Contact</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">(02) 1234-5678</p>
        </div>
      </div>
      <div class="footer-bottom text-center">
        &copy; <?php echo date('Y'); ?> PrimeWater Quezon Metro.
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>