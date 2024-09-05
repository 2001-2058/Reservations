<?php  
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: clogin.php");
    exit();
}

// Display the private content

include 'db.php'; // Include database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required parameters are set in the POST request
    if (isset($_POST['rev_date'], $_POST['rev_time'], $_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['hours'], $_POST['price'])) {
        // Retrieve POST parameters
        $date = $_POST['rev_date'];
        $time = $_POST['rev_time'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $hours = $_POST['hours'];
        $price = $_POST['price'];

        // Check if the email already exists in the reservations table
        if (checkExistingReservationByEmail($conn, $email)) {
            $message = "Email already exists. Please use a different email.";
        } elseif (checkExistingReservations($conn, $date, $time)) {
            $message = "Place already reserved for the selected date and time.";
        } else {
            // Perform reservation logic
            $sql = "INSERT INTO reserve (rev_date, rev_time, name, address, email, phone, hours, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssiii", $date, $time, $name, $address, $email, $phone, $hours, $price);

            if ($stmt->execute()) {
                // Reservation successful, redirect to view_reservations.php
                header("Location: reservation_contains.php?date=".$date."&name=".$name."&time=".$time."&address= Chamati, Kathmandu"."&confirmation=".$phone."&hours=".$hours."&price=".$price);
                exit(); // Ensure that no further code is executed after the header
            } else {
                $message = "Error: Unable to process the reservation. Please try again later.";
            }
        }
    } else {
        $message = "Invalid request";
    }

    // Send JSON response
    echo json_encode(['message' => $message]);
}


       

// Function to check if there are existing reservations for the given date and time
function checkExistingReservations($conn, $date, $time) {
    $sql = "SELECT * FROM reserve WHERE rev_date = ? AND rev_time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute(); 
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Function to check if the email already exists in the reservations table
function checkExistingReservationByEmail($conn, $email) {
    $sql = "SELECT * FROM reserve WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
					<a href="logout.php">Logout</a>
				</li>
				
			</ul>
		</div>
	</div>
    <div id="contents">
        <div class="section">
            <h1>Online Booking</h1>
            <p>
                You can fill up this form for online reservation on your own time schedule and submit to us.
            </p>
            <form id="reservationForm" method="post" action="online.php">
    <i class="fa-solid fa-user fa-beat"></i>
    <input type="text" id="name" placeholder="Enter Username" name="name" required>
    <br>
    <i class="fa-solid fa-location-dot fa-beat"></i>
    <input type="text" id="address" placeholder="Enter Address" name="address" required>
    <br>
    <i class="fa-solid fa-envelope fa-beat"></i>
    <input type="email" id="email" placeholder="Enter Email" name="email" required>
    <br>
    <i class="fa-solid fa-phone fa-beat"></i>
    <input type="phone" id="phone" placeholder="Enter Phone" name="phone" required>
    <br>
    <i class="fa-solid fa-calendar-days fa-beat"></i>
    <input type="date" id="date" name="rev_date" required><br>
    <!-- Button to open the first modal -->

    <i class="fa-solid fa-hand-pointer fa-beat"></i>
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">Select Time</button>
    <br>
    <i class="fa-regular fa-hourglass-half fa-beat"></i>
    <input type="text" id="hoursField" placeholder="Hours" name="hours" readonly><br>
    <i class="fa-solid fa-clock fa-beat"></i>
    <input type="text" id="timeField" placeholder="Time" name="rev_time" readonly><br>
    <i class="fa-solid fa-hand-holding-dollar fa-beat"></i>
    <input type="text" id="price" placeholder="Display Price" name="price" readonly><br>
    <input type="submit" name="Login" value="Reserve">
</form>

        </div>
    </div>

    <!-- First Modal -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Select number of hours</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="hoursSelect">Choose number of hours:</label>
                    <select class="form-select" id="hoursSelect">
                        <option value="1">1 hour</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" onclick="storeSelectedHours()">Select</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Modal -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Select Time Duration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="timeButtons" class="row">
                        <!-- Buttons will be dynamically generated here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="confirmSelection()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        

        let selectedHours = 1;
    let selectedTime = '';
    const pricePerHour = 1500; // Price per hour
        

        function storeSelectedHours() {
            selectedHours = document.getElementById('hoursSelect').value;
            createButtons(selectedHours);
        }

        function createButtons(hours) {
            const container = document.getElementById('timeButtons');
            container.innerHTML = ''; // Clear previous buttons

            const startHour = 6; // Starting from 6:00 AM
            const endHour = 20;  // Ending at 8:00 PM

            for (let hour = startHour; hour < endHour; hour += parseInt(hours)) {
                const startTime = formatTime(hour);
                const endTime = formatTime(hour + parseInt(hours));
                const button = document.createElement('button');
                button.className = 'time-button';
                button.innerText = `${startTime} - ${endTime}`;
                button.onclick = () => selectTimeSlot(`${startTime} - ${endTime}`);
                container.appendChild(button);
            }
        }

        function formatTime(hour) {
            const period = hour >= 12 ? 'PM' : 'AM';
            const adjustedHour = hour % 12 || 12; // Convert 0 to 12 for 12-hour clock
            return `${adjustedHour}:00 ${period}`;
        }

        document.getElementById("date").addEventListener("change", function() {
    var inputDate = new Date(this.value);
    var today = new Date();

    // Set hours, minutes, seconds, and milliseconds to 0 for accurate comparison
    today.setHours(0, 0, 0, 0);

    if (inputDate < today) {
        alert("Date must be today or later.");
        this.value = ""; // Clear the input field
    } else if (isNaN(inputDate.getTime())) {
        // If inputDate is not a valid date, set it to today's date
        this.valueAsDate = today;
    }
});
        

        function selectTimeSlot(timeSlot) {
            selectedTime = timeSlot;
        }

        function confirmSelection() {
    const selectedHoursValue = selectedHours;
    const selectedTimeValue = selectedTime;
    document.getElementById('hoursField').value = `${selectedHoursValue} hour(s)`;
    document.getElementById('timeField').value = selectedTimeValue;

    // Calculate and populate the price input based on selected hours
    const totalPrice = selectedHoursValue * pricePerHour;
    document.getElementById('price').value = totalPrice;

    const secondModal = new bootstrap.Modal(document.getElementById('exampleModalToggle2'));
    secondModal.show(); // Show the modal
    
    // Attach an event listener to hide the modal and its backdrop after being fully shown
    secondModal._element.addEventListener('shown.bs.modal', function () {
        // This function will execute once the modal is fully shown
        secondModal.hide(); // Hide the modal
        document.querySelector('.modal-backdrop').remove(); // Remove the modal backdrop
    });
}


    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<style>
    /* Global Styles */
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

/* Header Styles */
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


/* button modal */
.modal-content {
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Header styling for modal titles */
.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.modal-title {
    font-weight: bold;
}

/* Button styling inside the second modal */
.time-button {
    margin: 2px;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #4caf50;
    width: 45%;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.time-button:hover {
    background-color: #45a049;
}

.time-button:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
}

/* Styling for the button container */
#timeButtons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
}

/* Footer button styling for the confirm button */
.modal-footer .btn-primary {
    background-color: #4caf50;
    border: none;
}

.modal-footer .btn-primary:hover {
    background-color: #45a049;
}



/* Contents Styles */
#contents {
    width: 28%;
    margin: 10px 50px;
    padding-top: 2px;
}

.section {
    background-color: #ddd;
    padding: 15px;
    border-radius: 20px;
    margin-bottom: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: 15px;
}

.section h1 {
    color: #333;
    font-size: 25px;
    margin-bottom: 10px;
}

/* Form Styles */
#reservationForm {
    flex-wrap: wrap;
    justify-content: space-between;
}

#reservationForm i {
    flex-basis: 100%;
    font-size: 18px;
    margin-top: 8px;
}

#reservationForm input[type="text"],
#reservationForm input[type="email"],
#reservationForm input[type="phone"],
#reservationForm select,
#reservationForm input[type="date"] {
    flex-basis: calc(100%);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    
}

#reservationForm input[type="submit"] {
    
    padding: 10px;
    margin-bottom: 2px;
    border: none;
    border-radius: 4px;
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
    width: 100%;
}

#reservationForm input[type="submit"]:hover {
    background-color: #45a049;
}
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

<script>
    // Display popup notification
    var message = <?php echo json_encode($message); ?>;
    if (message) {
        alert(message);
    }
</script>
</body>
</html>