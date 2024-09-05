<!-- forgot_password.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | Online Reservation</title>
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
<div class="divider"></div>
<div class="section">
    <div class="loginbox">
        <img src="assets/admin.png" class="avatar">
        <h1>Forgot Password</h1>
        <form action="send_reset_email.php" method="POST">
            <i class="fa-solid fa-envelope fa-beat"></i>
            <input type="email" name="admin_email" placeholder="Enter Email" required="required">
            
            <input type="submit" name="Reset" value="Reset Password">
        </form>
    </div>
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

.divider {
    height: 1px;
    background-color: #ccc;
    margin-top: 0px;
    margin-bottom: 20px;
}

.loginbox {
    background-color: #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    margin: 40px auto; /* Center the login box */
    text-align: center;
}

.error {
    color: red;
    margin-bottom: 10px;
}

.success {
    color: green;
    margin-bottom: 10px;
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
.loginbox input[type="password"],
.loginbox input[type="email"], /* Added email input type */
.loginbox input[type="submit"] {
    width: calc(100% - 20px);
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

.loginbox a {
    display: block;
    margin-top: 10px;
    color: #333;
    text-decoration: none;
}

.loginbox a:hover {
    color: #45a049;
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
