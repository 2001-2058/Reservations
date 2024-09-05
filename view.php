<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: a login.php");
    exit();
}

// Display the private content
?>

<?php
include 'db.php';
// Retrieve reserved dates and times from the database
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>View Reservations</title>
</head>
<body>
<header>
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
<h2>Reserved Details</h2>

<?php if ($result->num_rows > 0) : ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>No. of hours</th>
            <th>Price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
       
        <?php $count = 1; ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['rev_date']; ?></td>
                <td><?php echo $row['rev_time']; ?></td>
                <td><?php echo $row['hours']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <button onClick="openEditModal('<?php echo $row['name']; ?>','<?php echo $row['address']; ?>','<?php echo $row['email']; ?>','<?php echo $row['phone']; ?>','<?php echo $row['rev_date']; ?>', '<?php echo $row['rev_time']; ?>', '<?php echo $row['hours']; ?>', '<?php echo $row['price']; ?>')">Edit</button>
                    <button onClick="openDeleteModal('<?php echo $row['email']; ?>')">Delete</button>
                </td>
            </tr>
            <?php $count++; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No reservations found.</p>
<?php endif; ?>


<p>
<div class="container">
<div class="loginbox">
<div class="content">
<form action="index.php" method="POST">
<input type="submit" name="Login" value="Log out">
</form>
</div>
</div>
</div>
</p>


                        <!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onClick="closeEditModal()">&times;</span>
        <h2>Edit Reservation</h2>
        <form id="editForm">
        <i class="fa-solid fa-user fa-beat"></i>
            <input type="text" id="edit_name" name="name" required><br><br>

            <i class="fa-solid fa-location-dot fa-beat"></i>
            <input type="text" id="edit_address" name="address" required><br><br>

            <i class="fa-solid fa-envelope fa-beat"></i>
            <input type="email" id="edit_email" name="email" required><br><br>

            <i class="fa-solid fa-phone fa-beat"></i>
            <input type="text" id="edit_phone" name="phone" required><br><br>

            <i class="fa-solid fa-calendar-days fa-beat"></i>
            <input type="date" id="edit_rev_date" name="rev_date" required><br><br>

            <i class="fa-regular fa-hourglass-half fa-beat"></i>
            <select id="edit_hours" name="hours" required>
                <option value="1">1 hour</option>
                <option value="2">2 hours</option>
                <option value="3">3 hours</option>
                <option value="4">4 hours</option>
            </select><br><br>

            <i class="fa-solid fa-clock fa-beat"></i>
            <input type="time" id="edit_rev_time" name="rev_time" required><br><br>

            <i class="fa-solid fa-hand-holding-dollar fa-beat"></i>
            <input type="text" id="edit_price" name="price" readonly><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</div>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_email'])) {
    $delete_email = $_POST['delete_email'];
    $sql = "DELETE FROM reservations WHERE email = '$delete_email'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        header("Location: ".$_SERVER['PHP_SELF']); // Reload the page
        exit();
    } else {
        // Error in deletion
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<script>
    // Open Edit Modal
    function openEditModal(name, address, email, phone, rev_date, rev_time, hours, price) {
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_address").value = address;
        document.getElementById("edit_email").value = email;
        document.getElementById("edit_phone").value = phone;
        document.getElementById("edit_rev_date").value = rev_date;
        document.getElementById("edit_rev_time").value = rev_time;
        document.getElementById("edit_hours").value = hours;
        document.getElementById("edit_price").value = price;
        document.getElementById("editModal").style.display = "block";
    }

    // Close Edit Modal
    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    // Open Delete Modal
    function openDeleteModal(email) {
        document.getElementById("deleteModal").style.display = "block";
        document.getElementById("delete_email").value = email;
    }

    // Close Delete Modal
    function closeDeleteModal() {
        document.getElementById("deleteModal").style.display = "none";
    }

    // Confirm Delete Action
    function confirmDelete() {
        // Perform delete action here
        console.log("Reservation deleted.");
        // Close delete modal after action
        closeDeleteModal();
    }
</script>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <!-- Delete modal content -->
    <div class="modal-content">
        <span class="close" onClick="closeDeleteModal()">&times;</span>
        <h2>Delete Reservation</h2>
        <p>Are you sure you want to delete this reservation?</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" id="delete_email" name="delete_email">
            <button type="submit" onClick="confirmDelete()">Delete</button>
            <button type="button" onClick="closeDeleteModal()">Cancel</button>
        </form>
    
    </div>
</div>
<script>
console.log("hello");

    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the select elements and price input field
        var hoursSelect = document.getElementById("hours");
        var timeSelect = document.getElementById("time");
        var priceInput = document.getElementById("price");

        // Define available time slots
        var availableTimes = [
            ["6:00 am", "7:00 am", "8:00 am", "09:00 am", "10:00 am", "11:00 am", "12:00 pm"],
            ["6:00 am", "8:00 am", "10:00 am", "12:00pm", "2:00 pm", "4:00 pm", "6:00 pm"],
            ["6:00 am", "9:00 am", "12:00 pm", "3:00 pm", "6:00 pm"],
            ["6:00 am", "10:00 am", "2:00 pm", "6:00 pm"] 
        ];

        // Define hourly rate
        var hourlyRate = 1500; // Change this to your actual hourly rate

        // Update available time slots based on the selected number of hours
        hoursSelect.addEventListener("change", function() {
            console.log("Selected hours: ", this.value); // Log the selected number of hours
            var selectedHours = parseInt(this.value);
            console.log("Parsed hours: ", selectedHours); // Log the parsed number of hours
            var availableOptions = availableTimes[selectedHours - 1];
            console.log("Available options: ", availableOptions); // Log the available time options
            // Remove existing options
            timeSelect.innerHTML = "";
            // Add new options
            availableOptions.forEach(function(time) {
                var option = document.createElement("option");
                option.text = time;
                option.value = time;
                timeSelect.add(option);
            });
            // Calculate and update the price
            var price = selectedHours * hourlyRate;
            console.log("Calculated price: ", price); // Log the calculated price
            priceInput.value = price.toFixed(2);    
        });
    });
</script>





<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url('nepa.png'); /*Change the URL to your desired background image */
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
            margin-top: 0 px;
            margin-bottom: 20px;
        }

    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            
        }

        th {
            background-color: #ffe100;
        }

        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color:#76D7C4;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            box-sizing: border-box;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form {
            width: 100%;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        
        .loginbox input[type="submit"] {
            width: calc(200% - 22px);
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

        .container {
     display: flex;
     justify-content: flex-end; /* Align items to the right */
    .content {
    /* Styles for your normal page content */
    padding: 50px; /* Adjust as needed */
}

}
    </style>
</body>
</html>