<?php
require_once 'guest_session.php';
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'guest') {
  header('Location: guest_login.php');
  exit();
}

$user_id = $_SESSION['guest_id'];
$apps = [];
try {
  $stmt = $conn->prepare("SELECT id, fname, lname, conntype, date, status FROM public.application WHERE user_id = ? ORDER BY date DESC");
  $stmt->execute([$user_id]);
  $apps = $stmt->fetchAll();
} catch (PDOException $e) {
  // table may not exist yet
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Guest Dashboard - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
  <style>
    .guest-badge { background: #6c63ff; color: #fff; padding: 2px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px; }
    .badge-status { display: inline-block; padding: 3px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-inspection { background: #dbeafe; color: #1e40af; }
    .badge-payment { background: #e0e7ff; color: #3730a3; }
    .badge-requirements { background: #fce4ec; color: #9b1c1c; }
    .badge-installed { background: #d1fae5; color: #065f46; }
  </style>
</head>
<body>
  <div class="utility-bar clearfix">
    <div class="container">
      <div class="left-links">
        <a href="index.php"><i class="fas fa-home"></i> PrimeWater</a>
        <span class="guest-badge">GUEST</span>
      </div>
      <div class="right-links">
        <a href="guest_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
  </div>

  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="guest_main.php">
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
            <li class="nav-item"><a class="nav-link active" href="guest_main.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="guest_application.php">Apply</a></li>
          </ul>
          <div class="nav-icons">
            <div class="dropdown-user">
              <a href="#" data-toggle="dropdown"><i class="fas fa-user-circle" style="font-size: 24px;"></i></a>
              <div class="dropdown-menu">
                <span class="px-3 py-2 d-block text-muted" style="font-size: 15px;">
                  <strong><?php echo htmlspecialchars($_SESSION['guest_name'] ?? $_SESSION['guest_email']); ?></strong>
                  <br><span class="guest-badge">GUEST</span>
                </span>
                <div class="dropdown-divider"></div>
                <a href="guest_logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="page-header" style="background: linear-gradient(135deg, #6c63ff, #4834d4);">
    <div class="container">
      <h2><i class="fas fa-user-friends"></i> Guest Portal</h2>
      <p>Welcome! Submit a new water connection application</p>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <a href="guest_application.php" class="card-custom d-block p-5 text-center" style="transition: transform 0.2s, box-shadow 0.2s;">
            <i class="fas fa-file-invoice" style="font-size: 60px; color: var(--primary);"></i>
            <h4 class="mt-4 font-weight-bold">New Application</h4>
            <p class="text-muted mb-0">Apply for a new water connection.<br>No existing account number required.</p>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php if (count($apps) > 0): ?>
  <div class="section">
    <div class="container">
      <div class="section-title">
        <h2><i class="fas fa-clipboard-list"></i> My Applications</h2>
        <p>Track the status of your submitted applications</p>
      </div>
      <div class="card-custom">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Connection Type</th>
                  <th>Date Submitted</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($apps as $a): ?>
                <?php
                  $s = $a['status'] ?? 'Pending';
                  $cls = 'badge-pending';
                  if ($s == 'For Inspection') $cls = 'badge-inspection';
                  elseif ($s == 'For Payment') $cls = 'badge-payment';
                  elseif ($s == 'For additional Requirements') $cls = 'badge-requirements';
                  elseif ($s == 'Installed') $cls = 'badge-installed';
                ?>
                <tr>
                  <td><?php echo htmlspecialchars(($a['fname'] ?? '') . ' ' . ($a['lname'] ?? '')); ?></td>
                  <td><?php echo htmlspecialchars($a['conntype'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($a['date'] ?? ''); ?></td>
                  <td><span class="badge-status <?php echo $cls; ?>"><?php echo htmlspecialchars($s); ?></span></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

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
        <div class="col-md-6">
          <h5><img src="images/prime.jpg" alt="" style="height: 24px; border-radius: 4px; margin-right: 6px;"> PrimeWater</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">Providing potable, reliable, and sustainable water.</p>
        </div>
        <div class="col-md-3">
          <h5>Links</h5>
          <a href="guest_main.php">Dashboard</a>
          <a href="guest_logout.php">Logout</a>
        </div>
        <div class="col-md-3">
          <h5>Contact</h5>
          <p style="font-size: 13px; color: rgba(255,255,255,0.5);">(02) 1234-5678</p>
        </div>
      </div>
      <div class="footer-bottom text-center">&copy; <?php echo date('Y'); ?> PrimeWater Quezon Metro.</div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
