<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: clogin.php");
    exit();
}

// Display the private content
?>

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
                <a href="clogin.php">Logout</a>
            </li>
        </ul>
    </div>
</div>
<div class="section">
<div class="reservation-container">
        <h2>Reservation Confirmation</h2>
        <p class="confirmation-message">Your reservation is successfully BOOKED!</p>
        <div class="details">
            <p><strong>Booking Details:</strong></p>
            <p><strong>Name:</strong> <span id="name"></span></p>
            <p><strong>Date:</strong> <span id="date"></span></p>
            <p><strong>Time:</strong> <span id="time"></span></p>
            <p><strong>Address:</strong> <span id="address"></span></p>
            <p><strong>Hours:</strong> <span id="hours"></span></p>
            <p><strong>Price:</strong> <span id="price"></span></p>
            <p><strong>Confirmation Number:</strong> <span id="confirmation"></span></p>
        </div>
        <p class="note">(Please remember to bring this confirmation with you to the venue.)</p>
        </div>
</div>
<script>
        // Function to parse URL parameters
        function getParams() {
            var params = {};
            var search = window.location.search.substring(1);
            var pairs = search.split("&");
            for (var i = 0; i < pairs.length; i++) {
                var pair = pairs[i].split("=");
                params[pair[0]] = decodeURIComponent(pair[1]);
            }
            return params;
        }

        // Function to update details in the page
        function updateDetails() {
            var params = getParams();
            document.getElementById("name").textContent = params["name"];
            document.getElementById("date").textContent = params["date"];
            document.getElementById("time").textContent = params["time"];
            document.getElementById("address").textContent = params["address"];
            document.getElementById("hours").textContent = params["hours"];
            document.getElementById("price").textContent = params["price"];
            document.getElementById("confirmation").textContent = params["confirmation"];
        }

        // Call updateDetails function when the page loads
        window.onload = updateDetails;
    </script>


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
        
        .reservation-container {
            background-color: #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 20px 450px;
        }

        .confirmation-message {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px; /* Added for spacing */
        }

        .details {
            font-size: 18px;
            color: #444;
            margin-bottom: 20px; /* Added for spacing */
        }

        .details p {
            margin: 10px 0; /* Added for spacing */
        }

        .note {
            font-style: italic;
            color: red;
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

    
        <!-- Animation  -->
<style>
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
