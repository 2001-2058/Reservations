<!-- send_reset_email.php -->
<?php
require("db.php");

// Initialize error variable
$error = "";

if (isset($_POST['admin_email'])) {
    $admin_email = $_POST['admin_email'];
    
    // Generate a unique token
    $token = bin2hex(random_bytes(50));
    
    // Check if the email exists
    $query = "SELECT * FROM `login` WHERE `Admin_Email`=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        // Save the token in the database with an expiration date
        $query = "UPDATE `login` SET `reset_token`=?, `reset_expires`=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE `Admin_Email`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $token, $admin_email);
        $stmt->execute();

        // Send the email
        $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "To reset your password, please click the following link: $reset_link";
        $headers = "From: no-reply@yourdomain.com";
        
        if (mail($admin_email, $subject, $message, $headers)) {
            echo "An email has been sent to your email address with instructions to reset your password.";
        } else {
            $error = "Failed to send the email.";
        }
    } else {
        $error = "Email address not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password | Online Reservation</title>
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
        <h1>Password Reset Request</h1>
        <?php if(!empty($error)) { ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
