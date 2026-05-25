<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Guest Login - PrimeWater Quezon Metro</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/primewater.css">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <style>
    .guest-badge { background: #6c63ff; color: #fff; padding: 2px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px; }
    .divider-text { display: flex; align-items: center; color: #999; font-size: 13px; margin: 20px 0; }
    .divider-text::before, .divider-text::after { content: ''; flex: 1; border-bottom: 1px solid #ddd; }
    .divider-text::before { margin-right: 12px; }
    .divider-text::after { margin-left: 12px; }
    .g_id_signin > div { margin: 0 auto; }
  </style>
</head>
<body>
  <div class="login-page">
    <div class="login-card">
      <div class="login-logo">
        <img src="images/prime.jpg" alt="PrimeWater" style="height: 60px; border-radius: 8px; margin-bottom: 8px;">
        <h2>PrimeWater</h2>
        <p>Quezon Metro - Guest Portal</p>
        <span class="guest-badge mt-2 d-inline-block">GUEST ACCESS</span>
      </div>

      <p style="font-size: 13px; color: #666; text-align: center; margin-bottom: 20px;">
        Sign in with Google to submit a new water connection application.<br>
        No existing account number required.
      </p>

      <div id="g_id_onload"
        data-client_id="19478160697-b7s161njn4n7lnfad4mrhdh6hpvfo27n.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-callback="handleGoogleCredential"
        data-auto_prompt="false">
      </div>

      <div class="g_id_signin"
        data-type="standard"
        data-shape="rectangular"
        data-theme="outline"
        data-text="signin_with"
        data-size="large"
        data-logo_alignment="left"
        data-width="300">
      </div>

      <div class="divider-text">or</div>

      <a href="login.php" class="btn btn-outline-secondary btn-block">
        <i class="fas fa-arrow-left"></i> Back to Customer Login
      </a>

      <div class="login-footer">
        <hr>
        <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
      </div>
    </div>
  </div>

  <div id="loadingOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.9); z-index:9999; text-align:center; padding-top:20%;">
    <div class="spinner-border text-primary" role="status" style="width:3rem;height:3rem;"></div>
    <p class="mt-3 text-muted">Signing in with Google...</p>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function handleGoogleCredential(response) {
      $('#loadingOverlay').show();

      $.ajax({
        url: 'google_oauth.php',
        method: 'POST',
        data: { credential: response.credential },
        dataType: 'json',
        success: function(res) {
          if (res.success) {
            window.location.href = 'guest_main.php';
          } else {
            $('#loadingOverlay').hide();
            alert('Login failed: ' + (res.error || 'Unknown error'));
          }
        },
        error: function() {
          $('#loadingOverlay').hide();
          alert('Server error. Please try again.');
        }
      });
    }
  </script>
</body>
</html>
