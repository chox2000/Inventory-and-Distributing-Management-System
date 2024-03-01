<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include("db_connection.php");

    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user credentials
    $query = "select * from login where username = '$username' and password = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Check if a matching record is found
        if (mysqli_num_rows($result) == 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["state"]=$row["state"];
           $_SESSION['route_id']=$row["route_id"];

            // Redirect to a secure page after successful login
            header("Location: option.php");
            exit();
        } else {
            // Display an error message if credentials are invalid
            $error_message = "Invalid username or password.";
        }
    } else {
        // Display an error message for database query issues
        $error_message = "Database query failed.";
    }

    // Close the database connection
    mysqli_close($connection);
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        .fodpass{
            color: #4caf50;
        }
        .fodpass:hover{
            color:darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php
        // Display error message if set
        if (isset($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        ?>

        <form method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit">Login</button>
            <br>
            <br>
            <button type="button" style=" background-color:transparent; " class="fodpass" onclick="redirect()">Fogot Password</button>
        </form>
    </div>
    <script type="text/javascript">
        function redirect() {
    window.location.href = 'PasswordValidation.php';
  }
    </script>
</body>
</html>