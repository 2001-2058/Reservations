<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
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
            <?php
            if(isset($_SESSION['username'])) {
                // If user is logged in, display logout button
                echo '<li><a class="homeblack" href="logout.php">Logout</a></li>';
            } else {
                // If user is not logged in, display login button
                echo '<li><a class="homered" href="clogin.php">Users Login</a></li>';
                echo '<li><a class="homeblack" href="alogin.php">Admin Login</a></li>';
            }
            ?>
            
        </ul>
    </div>
</div>

<div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="1080" height="250" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d742.5096949525622!2d85.29602546302891!3d27
        .71755647337535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb192ede0d87b9%3A0xb30735a9b4bb5f90!
        2sNepa%20futsal!5e0!3m2!1sen!2snp!4v1710490197471!5m2!1sen!2snp" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
    </iframe>
    </div>
</div>


<div class="section contact">
    <div id="contents">
<p style="font-family: Montserrat; text-align: center; font-size: 25px"><i class="fa-solid fa-address-book fa-beat"></i><span> For Inquiries Please Call:<b> +977 9802006163</b></span></p>
<p style="font-family: Montserrat; text-align: center; font-size: 25px"><i class="fa-solid fa-map-location fa-beat"></i><span><b> Chamati-15, Kathmandu, Nepal</b></span></p>
<p style="font-family: Montserrat; text-align: center; font-size: 25px"><i class="fa-solid fa-envelope fa-beat"></i><span> Email: <b>nepafutsal2014@gmail.com</b></span></p>
</div>
</div>
<div>


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
        color: black; /* Font color according to the background image */
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

 
    .section.contact p {
        font-size: 16px;
        margin-bottom: 10px;
       
    }
    .section.contact p, span {
        font-weight: bold;
        color:#2c3e50;
        
    }
    .mapouter {
            position: relative;
            text-align: right;
            height: 250px;
            width: 50%;
            margin-left: 100px;
           
        }
        .gmap_canvas {
            overflow: hidden;
            background: none!important;
            height: 250px;
            width:1080px;
            margin: 50px;
        }

        #contents {
        max-width: 500px;
        text-align: center;
        margin: auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        margin-top: 10px;
    }
        
    

</style>
</body>
</html>
