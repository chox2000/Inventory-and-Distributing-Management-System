<?php
session_start();
$_SESSION['index_visit'] = true;

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
            $_SESSION["state"] = $row["state"];
            $_SESSION['route_id'] = $row["route_id"];

            // Redirect to a secure page after successful login
            header("Location:option.php");
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
    <link rel="stylesheet" type="text/css" href="index.css">

    </style>
</head>

<body>

    <div class="card">
        <div class="img-avatar">
            <svg viewBox="0 0 100 100">

            </svg>
        </div>
        <div class="card-text">
            <div class="portada">

            </div>
            <div class="title-total">
                <div class="title">
                    <h2>Login</h2>
                </div>

                <div class="desc">
                    <form method="POST" action="<?php $_PHP_SELF ?>">
                        <div class="form-group">
                            <?php
                            // Display error message if set
                            if (isset($error_message)) {
                                echo '<div class="alert alert-danger">' . $error_message . '</div><br>';
                            }
                            ?>
                            <label for="username" style="font-size: 11pt; font-weight: bold;">Username</label>
                            <input type="text" name="username" class="form-control" required style="width: 230px; " placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" style="font-size: 11pt; font-weight: bold;">Password</label>
                            <input type="password" name="password" class="form-control" required style="width: 230px; ">
                        </div>
                        <button type="submit" style="width: 230px;">Login</button>
                        <button type="button" style=" background-color:transparent; " class="fodpass" onclick="redirect()">Fogot Password</button>
                    </form>
                </div>
            </div>

        </div>



    </div>

    <script type="text/javascript">
        function redirect() {
            window.location.href = 'password_validation.php';
        }
    </script>
</body>

</html>