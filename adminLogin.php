<!DOCTYPE html>
<?php require_once('admindata.php'); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Login - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
  <style>
    .login-card { border-top: 4px solid var(--orange); }
  </style>
</head>
<body>
  <div class="login-page">
    <div class="login-card">
      <div class="login-logo">
        <img src="images/prime.jpg" alt="PrimeWater" style="height: 60px; border-radius: 8px; margin-bottom: 8px;">
        <h2 style="margin-top: 8px;">Admin Login</h2>
        <p>PrimeWater Quezon Metro</p>
      </div>
      <form method="POST">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="user" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="loginAdmin" class="btn btn-primary btn-block btn-pw btn-pw-primary">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
      </form>
      <div class="login-footer">
        <a href="login.php"><i class="fas fa-user"></i> Customer Login</a>
        <hr>
        <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>