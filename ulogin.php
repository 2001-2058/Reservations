<!DOCTYPE html>
<html>
<head>
    <title>Log In | Online Reservation</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
   
</head>
<body>
<div id="header">
    <div>
        <div class="logo">
            <a href="index.php">Nepa: Futsal and Recreation Center</a>
        </div>
        <ul id="navigation">
            <li><a class="homeblack" href="index.php">Home</a></li>
            <li><a class="homered" href="clogin.php">Users Login</a></li>
            <li><a class="homeblack" href="alogin.php">Admin Login</a></li>
        </ul>
    </div>
</div>
    <div class="divider">

    </div>
    <div class="section">
    <div class="loginbox">
    <?php
require("db.php");  //connecting to the database

// Initialize error variable
$error = "";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set in $_POST array
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        // Assign values from $_POST array
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format. ";
        }

        // Validate password length
        if (strlen($password) < 6) {
            $error .= "Password must be at least 6 characters. ";
        }

        // Validate password and confirm password match
        if ($password !== $_POST["confirm_password"]) {
            $error .= "Password and Confirm password do not match. ";
        }

        // If there are any errors, display them
        if (!empty($error)) {
            echo "<div class='error'>$error</div>";
        } else {
            // No errors, proceed to insert data into the database
            $sql = "INSERT INTO details (username, email, password)
                    VALUES ('$username', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Successfully Registered!</div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // If the form is submitted but required fields are not set, display an error
        echo "<div class='error'>All fields are required.</div>";
    }
}

$conn->close();
?>
 

        <img src="assets/avatar.png" class="avatar">
        <div class="form-container">
        <h1>Signup Form</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
        <i class="fa-solid fa-user fa-beat"></i>
                <input type="text"  name="username" placeholder="Enter Username" required>

                <i class="fa-solid fa-envelope fa-beat"></i>
                <input type="email"  name="email" placeholder="Enter Email" required>
                
                <i class="fa-solid fa-lock fa-beat"></i>
                <input type="password"  name="password" placeholder="Create Password" required>
                
                <i class="fa-solid fa-lock fa-beat"></i>
                <input type="password" name="confirm_password" placeholder="Retype Password" required>

                <input type="submit"  value="Sign Up" name = "submit"/>
                

        </form>

<form action="clogin.php" method="POST">
<input type="submit" name="Login" value="Go Back">

</div>
<style>

body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url('nepa.png'); /* Change the URL to your desired background image */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; /* Full height of viewport */
        }

        #header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px 0;
        }

        #header > div {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: #fff;
            font-size: 24px;
            text-decoration: none;
            font-weight: bold;
        }

        #navigation {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        #navigation li {
            margin-right: 20px;
        }

        #navigation li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
            padding: 10px;
            border-radius: 5px;
        }
        

        #navigation li a:hover {
            background-color: #45a049;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        .divider {
            height: 1px;
            background-color: #ccc;
            margin-top: 0 px;
            margin-bottom: 20px;
        }

        .loginbox {
            background-color: #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 40px 90px;
            text-align: center;
    
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .loginbox h1 {
            margin: 0;
            margin-bottom: 20px;
            color: #333;

        }

        .loginbox p {
            margin: 0;
            margin-bottom: 10px;
            text-align: left;
            color: #333;
        }

        .loginbox input[type="text"],
        .loginbox input[type="email"],
        .loginbox input[type="password"]
         {
            width: calc(100% - 50px);
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .loginbox input[type="submit"]
        {
            width: calc(100%);
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px; 
            align-items: left;
             
        }

        .loginbox input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .loginbox input[type="submit"]:hover {
            background-color: #45a049;
        }

       
 
        <!-- Animation  -->
  /* Fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .section {
        animation: fadeIn 1s ease-out;
    }
    /* Fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .section {
        animation: fadeIn 1s ease-out;
    }

  
    </style>
</body>
</html>
