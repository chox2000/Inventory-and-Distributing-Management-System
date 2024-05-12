 <?php
session_start();
$un=$_SESSION['email'];
//var_dump($_SESSION);
//var_dump($_SESSION);
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product_Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/productdetails.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" /> -->
  </head>
  <body >
<?php
include 'Navibar.php';
?>

<!-- <div class="products-container"> -->

<?php
$productid=$_GET['categoryid'];

 $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'retail_website';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM product WHERE product_id=$productid";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row["product_id"];
                $main_cat = $row["main_cat"];
                $sub_cat = $row["sub_cat"];
                $stock=$row["stock"];
                $quantity = $row["stock"];
                $price = $row["cashPrice"];
                $description = $row["productType"];
                $img = $row["image"];
                $discount = $row["Discount"];

                $_SESSION['product_id'] = $product_id; // Store product ID in session
                $_SESSION['stock'] = $stock;

                echo '<div class="card-wrapper" >
                        <div class="card">
                            <div class="about" id="About"> 
                                <div class="about_main">
                                    <div class="about_image">
                                        <div class="image_contaner">
                                            <img src="data:image;base64,' . base64_encode($img) . '" id="imagebox">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h2 class="product-title">' . $sub_cat . '</h2>';
                                
                if ($discount != '' && $discount != NULL) { 
                    $p = ($discount * $price) / 100;
                    $newprice = $price - $p;
                    echo '<div class="last-product-price">
                            <p class="last-price">Old Price: <span>Rs. ' . $price . '</span></p>
                          </div>
                          <div class="new-product-price">
                            <p class="new-price">Price: <span>Rs. ' . $newprice . '</span></p>
                          </div>';
                } else {
                    echo '<div class="new-product-price">
                            <p class="new-price">Price: <span>Rs. ' . $price . '</span></p>

                          </div>';
                }

                echo '<div>
                        <h4>'.$description.'</h4>
                      </div>'; // Close the divs properly
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Query failed: " . $conn->error;
    }

    $conn->close(); // Close the database connection
// Close the database connection
?>
   <div class = "product-detail">
                          
                        </div>
                        <form action=" " method="post" id="form">
                        <div class = "purchase-info">
                           <input type="number" min="0" max="<?php echo $stock; ?>" value="0" name="quantity" id="quantity"><br>
                           <input type="hidden" name="product_id" value="<?php echo $product_id?>">

                           <a href="SignIn.php"><button type="submit" name="btn" class="btn">Add to Cart <i class="fas fa-shopping-cart"></i></button></a>
                         </div></form>
                        </div></div></div>

<?php
if(isset($_POST['btn'])){
    $host='localhost';
    $username='root';
    $password="";
    $database="retail_website";

    $link=mysqli_connect($host,$username,$password,$database);

        if(!$link){
            die('could connect'.mysqli_error($link));
        }
       // echo 'connected successfully';
    $quantity = $_POST['quantity'];
    $userid=$_SESSION['user_id'];


        $stmt = $link->prepare("CALL add_to_cart(?, ?, ?, @status)");

    // Assign values to variables
    echo $userid;
    echo $product_id;
    echo $quantity;

    $stmt->bind_param("ssi", $userid, $product_id, $quantity);

    $stmt->execute();

    $stmt->close();
    $result = $link->query("SELECT @status AS status");
    $row = $result->fetch_assoc();
    $status = $row['status'];
     echo "<script type='text/javascript'>window.location.href='Cart.php';</script>";
    // switch ($status) {
    //     case 0:
    //         // echo "Student inserted successfully."; 
    //     echo '<script>window.alert("User inserted successfully.");
    //     window.location.href="Cart.php";
    //     exit();</script>'; 
        
    //         break;
    //     case 1:
    //         echo'<script>window.alert("Error occurred while inserting student.");
    //         event.preventDefault();
    //         return false;
    //         </script>';
    //         break;
    //     case 2:
    //         echo'<script>window.alert("Email already exists in the database.");
    //         event.preventDefault();
    //         return false;
    //         </script>';
    //         break;
    //     default:
    //         echo'<script>window.alert("Unknown status returned.")
    //         event.preventDefault();
    //         return false;
    //         </script>';
    //         break;
    // }
 }
include 'Sameproducts.php';
?> 
</body>
 
</html>
