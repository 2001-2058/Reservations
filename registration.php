
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ONLINE RESERVATION</title>
</head>
<body>
<div id="header">
    <div>
        <div class="logo">
            <a href="index.php">Nepa: Futsal and Recreation Center</a>
        </div>
        <ul id="navigation">
            <li class="active">
                <a href="index.php">Home</a>
            </li>
            
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <li>
                <a href="clogin.php">Login</a>
            </li>
        </ul>
    </div>
</div>
<div class="section">
    <div class="registration-form">
    <?php
    include 'db.php'; // Include database connection script

    // Initialize error variable
    $error = "";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set in $_POST array
        if(isset($_POST["firstname"], $_POST["lastname"], $_POST["address"], $_POST["email"], $_POST["phone"], $_POST["username"], $_POST["password"])) {
            // Assign values from $_POST array
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $address = $_POST["address"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Perform validation and insert data into the database
            // Note: You should use prepared statements to prevent SQL injection

            $sql = "INSERT INTO users (firstname, lastname, address, email, phone, username, password)
                    VALUES ('$firstname', '$lastname', '$address', '$email', '$phone', '$username', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Successfully Registered!</div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Handle case where required fields are not filled
            echo "<div class='error'>Please fill in all required fields.</div>";
        }

        // Validate form fields
        // Check if form fields are set before accessing them
        if (isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
            // Validate email format
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error .= "Invalid email format. ";
            }

            // Validate phone number length
            if (strlen($_POST["phone"]) !== 10) {
                $error .= "Phone number must be 10 digits. ";
            }

            // Validate password length
            if (strlen($_POST["password"]) < 6) {
                $error .= "Password must be at least 6 characters. ";
            }

            // Validate password and confirm password match
            if ($_POST["password"] !== $_POST["confirm_password"]) {
                $error .= "Password and Confirm password do not match. ";
            }
        } 
        

        // Display error message
        if (!empty($error)) {
            echo "<div class='error'>$error</div>";
        }
    }
    
    $conn->close();
    ?>
    
        <h2>User Registration</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="firstname" placeholder="First Name" required><br>
            <input type="text" name="lastname" placeholder="Last Name" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="text" name="phone" placeholder="Phone" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <input type="submit" name="register" value="Register">
            </form>
<p>
<div class="container">
<div class="loginbox">
<div class="content">
<form action="ulogin.php" method="POST">
<input type="submit" name="Login" value="Sign in">
</form>
</div>
</div>
</div>
</p>
        

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
        .registration-form {
            background-color: #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 320px;
            margin: 30px 90px;
            text-align: center;
        }

        .registration-form input[type="text"],
        .registration-form input[type="password"] {
            width: calc(100% - 22px); /* Adjusted width to account for padding and border */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .registration-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        #header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px 0;
            width: 100%;
            top: 0;
            z-index: 999;
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

       
    
        .reservation-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px; /* Added for better presentation on larger screens */
            margin: 40px;

        }

        .confirmation-message {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px; /* Added for spacing */
        }

        .details {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px; /* Added for spacing */
        }

        .details p {
            margin: 10px 0; /* Added for spacing */
        }

        .note {
            font-style: italic;
            color: #888;
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

        .loginbox input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
