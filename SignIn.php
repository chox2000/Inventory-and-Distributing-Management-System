<head>
    <title>
        Sign In
    </title>
    <style>
        #div1 {
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            min-height: 550px;
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
            height: 80px;
            width: 80px;
        }

        #social-container {
            margin: 20px 0;
        }

        #social-container a {
            border: 0px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        #googlelogo {
            height: 35px;
            width: 36px;
        }

        #fblogo {
            height: 35px;
            width: 35px;
        }

        #instalogo {
            height: 35px;
            width: 35px;
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
            <br>
            <table id="table">
                <tr>
                    <td><img src="./Images/lotus.png" alt="logo" id="img"></td>
                    <td>
                        <h1 style="color: green;">Lotus</h1>
                    </td>
                </tr>
            </table>


            <h2 style="color: black;" >Sign In</h1>

                <input type="text" placeholder="User Name" id="text"><br></td>

                <input type="password" placeholder="Password" id="text"><br>
                <a href=" ">Forgot Your Password ?</a>

                <div id="social-container">
                    <a href="#" class="social"><img src="./Images/google.png" alt="logo" id="googlelogo"></a>

                    <a href="#" class="social"><img src="./Images/facebook.png" alt="logo" id="fblogo"></a>

                    <a href="#" class="social"><img src="./Images/instagram.png" alt="logo" id="instalogo"></a>
                </div>

                <button type="submit" value="Sign in" id="button">Sign in</button><br>

                <table id="table">
                    <tr>
                        <td> Don't have an account ?</td>
                        <td> <a href="SignUp.php">Sign Up</a></td>
                    </tr>
                </table>

        </form>
    </div>

</body>