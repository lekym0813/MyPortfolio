<?php
include_once('db.php');
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Update Application - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM application WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  $rows = $stmt->fetch();
  if (!$rows) { echo '<div class="container mt-5"><div class="alert alert-danger">Application not found.</div></div>'; exit(); }

  if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $query = "UPDATE application SET status = ? WHERE id = ?";
    $query_run = $conn->prepare($query)->execute([$status, $id]);
    if ($query_run) {
      echo '<script>alert("Status Updated"); window.location="applicationList.php";</script>';
    } else {
      echo '<script>alert("Status Not Updated");</script>';
    }
  }
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
          <a href="applicationList.php"><i class="fas fa-arrow-left"></i></a>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header">
    <div class="container">
      <h2><i class="fas fa-edit"></i> Update Application Status</h2>
      <p>Change the status of this application</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-custom">
            <div class="card-header orange"><i class="fas fa-file-signature"></i> Application #<?php echo str_pad($id, 4, '0', STR_PAD_LEFT); ?></div>
            <div class="card-body">
              <form method="POST" class="form-custom">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['fname']); ?>" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['lname']); ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['address']); ?>" readonly>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['contact']); ?>" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Occupation</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['occupation']); ?>" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Birthday</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['bday']); ?>" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Classification</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['class']); ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label>Connection Type</label>
                  <input type="text" class="form-control" value="<?php echo htmlspecialchars($rows['conntype']); ?>" readonly>
                </div>
                <div class="form-group">
                  <label>New Status</label>
                  <select name="status" class="form-control" required>
                    <option value="">Choose...</option>
                    <option value="For Inspection">For Inspection</option>
                    <option value="For additional Requirements">For Additional Requirements</option>
                    <option value="For Payment">For Payment</option>
                    <option value="Installed">Installed</option>
                  </select>
                </div>
                <div class="text-center mt-4">
                  <button type="submit" name="update" class="btn-pw btn-pw-orange btn-pw-lg"><i class="fas fa-save"></i> Update Status</button>
                  <a href="applicationList.php" class="btn-pw btn-pw-outline btn-pw-lg"><i class="fas fa-times"></i> Cancel</a>
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