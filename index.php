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
<div id="adbox">
		<div class="clearfix">
			
			<div>
				<h1>Futsal</h1>
				<p>
					"In Futsal you can't always identify talent<br>
since soccer can be more physical"<br>
"In Futsal you notice the small details in<br>
quality, class and tactical understanding."<br><a href="clogin.php" class="btn">Book Now!</a><br>
<b>Move a head...</b>
				</p>
			</div>
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

        .btn {
            color: red;
            display: inline-block;
            font: 24px/60px 'OpenSans';
            height: 60px;
            width: 200px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            border: 2px solid grey; /* Border color same as text color */
            border-radius: 40px; /* Rounded corners */
            padding: 0px 10px; /* Adjust padding to your liking */
            box-sizing: border-box; /* Include padding in the element's total width and height */
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; /* Smooth transition effect */
        }

        .btn:hover {
            background-color: lightgrey; /* Change background color on hover */
            color: green; /* Change text color on hover */
            border-color: red; /* Change border color on hover */
        }

        #adbox { 
            height: 380px;
            padding: 60px 0;
            opacity: 0; /* Initially set opacity to 0 */
            animation: fadeIn 0.5s ease forwards; /* Apply fadeIn animation */
        }

        #adbox > div {
            width: 800px;
            margin: 30px 80px;
            padding: 0 80px;
            opacity: 0; /* Initially set opacity to 0 */
            animation: slideInFromTop 0.5s ease forwards, fadeIn 1s ease forwards; /* Apply animations */
        }

        #adbox h1, #adbox h2 {
            color: yellow;
            font-size: 60px;
            line-height: 60px;
            margin: 0px;
            text-transform: uppercase;
        }

        #adbox h2 {
            font-size: 30px;
            line-height: 36px;
            text-transform: none;
        }

        #adbox p {
            font-size: 16px;
            line-height: 24px;
            margin: 0px;
            color: black;
        }

        #adbox p span {
            display: block;
            font-size: 12px;
            width: 360px;
            padding: 24px 0;
            text-align: center;
        }

        #adbox p span b {
            font-weight: normal;
            display: block;
            width: 256px;
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

        /* Slide in from top animation */
        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

      
    </style>

</body>
</html>