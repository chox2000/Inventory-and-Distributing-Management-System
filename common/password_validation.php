<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/common/email_sms.php");
include($_SERVER['DOCUMENT_ROOT'] . "/common/db_connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/common/den_fun.php");
if (!isset($_SESSION['index_visit'])) {
  acess_denie();
  exit();
} else {
  $_SESSION['email_valid_visit'] = true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the email from the POST data
  $email = $_POST['email'];

  // Validate the user credentials
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_num_rows($result) > 1) {
    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $code = generateRandomCode();

    // Set session variables
    $_SESSION['code'] = $code;
    $_SESSION["email"] = $row["email"];
    $_SESSION["firstName"] = $row["firstName"];
    $_SESSION['user_id'] = $row["user_id"];
    $user = $row["email"];
    $firstname = $row["firstName"];

    $Subject = "Password Change Request";
    $body = "Vertify your Email address\n\nEnter Below Vertification Code for Continue Change Password \n\nVertification code is :  " . $code . "\n\nDo Not Share with Others\nThank You...!\n\nRegards,\nLotus Electicals (PVT)LTD";


    sendmail($Subject, $body, $user, $firstname);

    // Redirect to the OTP validation page
    header("Location:/common/otp_validation.php");
    //exit();
  } else {
    // Display an error message if credentials are invalid
    $error_message = "Invalid Email Address.";
  }
}
function generateRandomCode($length = 5)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = '';

  for ($i = 0; $i < $length; $i++) {
    $randomIndex = mt_rand(0, strlen($characters) - 1);
    $code .= $characters[$randomIndex];
  }
  return $code;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1, user-scalable=no">
  <title>Email Vertification</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/style/mobile.css">
  <link rel="stylesheet" type="text/css" href="/style/style.css">
  <style>
    h3 {
      text-align: center;
      color: #333;
    }
  </style>
</head>

<body>

  <!-- Simulate a smartphone / tablet -->
  <div class="mobile-container">

    <!-- Top Navigation Menu -->
    <div class="topnav">
      <a href="javascript:void(0);" onclick="back()" class="back-link" style="float:left;font-size:25px; "><i class="fa fa-angle-left"></i></a>
    </div>

    <div class="container">
      <h3>Validation</h3>

      <?php
      // Display error message if set
      if (isset($error_message)) {
        echo '<div class="alert alert-danger">' . $error_message . '</div>';
      }
      ?>

      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="z-index:9999;">

        <div class="form-group">

          <label for="email" id="elabel">E-Mail Address </label>
          <input type="email" name="email" id="email" class="form-control" placeholder="noreply@gmail.com" style="margin-bottom: 2%;">
          <label for="email" id="tlabel">Telephone Number </label>
          <input type="text" name="number" id="mobile" class="form-control" placeholder="XXXXXXXXXX" style="margin-bottom: 2%;" maxlength="10">
          <a href="" onclick="toggleCustomfields()" style="color:green;font-size:14px;margin-top:0%;font-weight:bold;margin-left: 0;margin-right: 0;">Try Another Way</a>
        </div>

        <button type="submit" style="margin-top:2%;">Get Code</button>
      </form>

    </div>
  </div>

  <script>
    function closepanel() {
      document.getElementById("mySidepanel").style.width = "0";
    }

    function back() {
      window.history.back();
    }

    function toggleCustomfields() {
      var paymentMethod = document.getElementById('payment_method');
      var customPaymentFields = document.getElementById('custom_payment_fields');
      if (paymentMethod.value === 'custom') {
        customPaymentFields.style.display = 'block';
      } else {
        customPaymentFields.style.display = 'none';
      }
    }
  </script>

</body>

</html>