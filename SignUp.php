<head>
    <title>
        Sign Up
    </title>
    <style>
        #div1 {
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            top: 50%;
            bottom: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
         /*overflow: hidden;*/
            width: 600px;
            height:900px;
            max-width: 100%;
            margin-top: 100px;
           position: relative;
            
        }

        #form {
            background-color: rgba(256, 256, 256, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        #text {
            background-color: #eee;
            border: none;
            border-radius: 20px;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        #button {
            border-radius: 20px;
            border: 1px solid #27ae60;
            background-color: #27ae60;
            color: black;
            font-size: 15px;
            font-weight: bold;
            padding: 10px 50px;
            letter-spacing: 1px;
            width: 300px;

        }

        #img {
            height: 120px;
            width: 120px;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>


<body>
    <div id="div1">
        <form action="" method="post" id="form">
            <table id="table">
                <tr>
                    <td><img src="./Images/lotus.png" alt="logo" id="img"></td>
                    <td>
                        <h1 style="color: green;">Lotus</h1>
                    </td>
                </tr>
            </table>

            <h2 style="color: black;" align="center">Sign Up</h1>

                <input type="text" placeholder="User Name" id="text" name="name">

                <input type="text" placeholder="YYYY-MM-DD" id="text" name="dob">

                <input type="email" placeholder="Address" id="text" name="address">

                <input type="text" placeholder="Contact NUmber" id="text" name="tnumber">

                <input type="text" placeholder="Email" id="text" name="email">

                <input type="text" placeholder="Postal code" id="text" name="postalcode">

                <input type="password" placeholder="Password" id="text" name="password">

                <input type="password" placeholder="Confirm Password" id="text"><br>

                <button type="submit" value="Sign Up" id="button" name="signUp">Sign Up</button><br>
                
                <table id="table">
                    <tr>
                        <td>Already have an account ? </td>
                        <td> <a href="SignIn.php">Sign In</a></td>
                    </tr>
                </table>

        </form>
        <br><br>
    </div>

</body>
</html>

<?php
if(isset($_POST['signUp']))
{
   
    $name =$_POST['name'];
    $dob =$_POST['dob'];
    $address = $_POST['address'];
    $tnumber = $_POST['tnumber'];
    $email = $_POST['email'];
    $postalcode = $_POST['postalcode'];
    $password = $_POST['password'];

    //connect to DB
    $host='localhost';
    $username='root';
    $password="";
    $database="retail_website";

    $link=mysqli_connect($host,$username,$password,$database);

        if(!$link){
            die('could connect'.mysqli_error($link));
        }
        echo 'connected successfully';

    $usrer_insert="INSERT INTO user_details(name,dob,address,number,email,postalcode,password) VALUES ('$name', '$dob', '$address','$tnumber','$email','$postalcode','$password')";


        if ($link->query($usrer_insert) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $usrer_insert . "<br>" . $link->error;
    }   
    
    mysqli_close($link);
} 
?> 