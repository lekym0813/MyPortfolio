<?php include "register.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
</head>
<body>
  <div class="login-page" style="background: linear-gradient(135deg, #002a55 0%, #003d7a 50%, #005fa3 100%);">
    <div class="login-card" style="width: 500px;">
      <div class="login-logo">
        <img src="images/prime.jpg" alt="PrimeWater" style="height: 60px; border-radius: 8px; margin-bottom: 8px;">
        <h2>PrimeWater</h2>
        <p>Create Your Account</p>
      </div>
      <form method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Account Name</label>
            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
          </div>
          <div class="form-group col-md-6">
            <label>Account Number</label>
            <input type="text" class="form-control" name="accountnum" placeholder="Account #" required>
          </div>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" name="address" placeholder="Complete Address" required>
        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" class="form-control" name="users_Pnumber" placeholder="Contact Number" required>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <div class="form-group col-md-6">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password2" placeholder="Repeat Password" required>
          </div>
        </div>
        <button type="submit" name="register" class="btn btn-primary btn-block btn-pw btn-pw-orange">
          <i class="fas fa-user-plus"></i> Register
        </button>
      </form>
      <div class="login-footer">
        <p>Already have an account? <a href="login.php">Login Here</a></p>
        <p>No account number? <a href="guest_login.php"><i class="fas fa-user-friends"></i> Sign in with Google</a></p>
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