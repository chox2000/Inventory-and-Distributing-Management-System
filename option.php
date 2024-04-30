<?php
session_start();
include("db_connection.php");
require_once('den_fun.php');
require 'notification_area.php';

if (!isset($_SESSION['index_visit']) || !$_SESSION['index_visit'] || !isset($_SESSION["user_id"]) || !isset($_SESSION["state"])) {

  acess_denie();
  exit();
} else {
  unset($_SESSION['new_sale_order_visit']);
  unset($_SESSION['paymenr_visit']);

  $user_idn = $_SESSION["user_id"];

  $_SESSION['option_visit'] = true;
}
$query = "SELECT * FROM users WHERE user_id = '$user_idn'";
$result = mysqli_query($connection, $query);

if ($result) {
  // Check if a matching record is found
  if (mysqli_num_rows($result) == 1) {
    // Fetch user data
    $row = mysqli_fetch_assoc($result);

    // Set session variables
    $_SESSION["user_log_fname"] = $row["firstName"];
    $_SESSION["user_log_lname"] = $row["LastName"];
    $_SESSION["user_log_email"] = $row["email"];
  }
}
unset($_SESSION['order_details']);
unset($_SESSION['totalAmount']);
unset($_SESSION['paymentAmount']);
unset($_SESSION['balance']);
unset($_SESSION['selected_payment_method']);
unset($_SESSION['selected_store']);
unset($_SESSION['process_payment']);
//unset($_SESSION['sales_recipt_download']);
unset($_SESSION['send_massage']);

// End the session
session_write_close();

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="mobile.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .options-container {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin-top: 5%;
    }

    .option {
      width: 75%;
      margin-bottom: 20px;
      background-color: #4caf50;
      /* background: linear-gradient(57deg, #35a844, #141514, #36a536);
            background-size: 180% 180%;
            animation: gradient-animation 6s ease infinite;*/
      color: #fff;
      text-align: center;
      padding: 15px;
      cursor: pointer;
      padding-right: 5px;
      border-radius: 0;
      border-bottom-left-radius: 15px;
      border-top-right-radius: 15px;
      background: linear-gradient(300deg, #3bb52d, #3bb52d, #3bb52d, #fcfcfc, #33a133, #33a133);
      background-size: 360% 360%;
      animation: gradient-animation 12s ease infinite;
      color: black;
      font-weight: bold;
      border-left: 1px solid green;
      border-bottom: 1px solid green;

    }

    @keyframes gradient-animation {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    a {
      text-decoration: none;
      color: white;
      text-align: center;


    }

    .option:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>

  <!-- Simulate a smartphone / tablet -->
  <div class="mobile-container">

    <!-- Top Navigation Menu -->
    <div class="topnav">

      <?php

      topnavigation();
      ?>

    </div>

    <div class="options-container">

      <a href="new_order.php" class="option" id="option1" style="display: none;">
        <div>Add Order</div>
      </a>
      <a href="manage_orders.php" class="option" id="option2" style="display: none;">
        <div>View Orders</div>
      </a>
      <a href="add_wholesalecustomer.php" class="option" id="option3" style="display: none;">
        <div>Add Customer</div>
      </a>
      <a href="report.php" class="option" id="option4" style="display: none;">
        <div>Generate Report</div>
      </a>
      <a href="summery.php" class="option" id="option5" style="display: none;">
        <div>Summary/Info</div>
      </a>
      <a href="handle_return.php" class="option" id="option10" style="display: none;">
        <div>Return Items</div>
      </a>
      <a href="Admin_feed.php" class="option" id="option6" style="display: none;">
        <div>Distribute Products</div>
      </a>
      <a href="create_order.php" class="option" id="option7" style="display: none;">
        <div>Pre Order</div>
      </a>
      <a href="my_order.php" class="option" id="option8" style="display: none;">
        <div>My Orders</div>
      </a>
      <a href="System_Manage.php" class="option" id="option9" style="display: none;">
        <div>System Manage</div>
      </a>
      <a href="Transaction_setelement.php" class="option" id="option11" style="display: none;">
        <div>Payment Settlement</div>
      </a>

    </div>
  </div>



  <script>
    function openNav() {
      document.getElementById("mySidepanel").style.width = "150px";
    }

    function closeNav() {
      document.getElementById("mySidepanel").style.width = "0";
    }
    document.addEventListener("DOMContentLoaded", function() {

      <?php if ($_SESSION["state"] === 'seller') : ?>
        document.getElementById("option1").style.display = "block";
        document.getElementById("option2").style.display = "block";
        document.getElementById("option3").style.display = "block";
        document.getElementById("option4").style.display = "block";
        document.getElementById("option5").style.display = "block";
        document.getElementById("option10").style.display = "block";
        document.getElementById("option11").style.display = "block";
      <?php elseif ($_SESSION["state"] === 'admin') : ?>
        document.getElementById("option4").style.display = "block";
        document.getElementById("option5").style.display = "block";
        document.getElementById("option6").style.display = "block";
        document.getElementById("option9").style.display = "block";
        document.getElementById("option5").style.display = "block";

      <?php elseif ($_SESSION["state"] === 'wholeseller') : ?>
        document.getElementById("option7").style.display = "block";
        document.getElementById("option8").style.display = "block";
      <?php endif; ?>

    });

    function toggleProfilePanel() {
      var profilePanel = document.getElementById('profilePanel');
      profilePanel.style.display = (profilePanel.style.display === 'block') ? 'none' : 'block';
      //fetchUserData()
    }

    function changePassword() {
      // Implement the logic to change the password here
      window.location.href = 'chng_pass.php';
    }

    function logout() {
      // AJAX request to a PHP script that handles session logout
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Redirect to login.php after successful logout
          window.location.href = "index.php";
        }
      };

      // Send a request to a PHP script that destroys the session
      xmlhttp.open("GET", "logout.php", true); //  logout.php is the script that destroys the session
      xmlhttp.send();
    }

    function showSuccess() {
      var overlay = document.getElementById('overlay');
      var successModal = document.getElementById('successModel');

      overlay.style.display = 'block';
      successModal.style.display = 'block';
    }

    function hideSuccess() {
      var overlay = document.getElementById('overlay');
      var successModal = document.getElementById('successModel');

      overlay.style.display = 'none';
      successModal.style.display = 'none';
    }

    function redirectToIndex() {
      hideSuccess();
      // Redirect to index.php
      window.location.href = 'index.php';
    }
  </script>

</body>

</html>