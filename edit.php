
                        <!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onClick="closeEditModal()">&times;</span>
        <h2>Edit Reservation</h2>
        <form id="editForm" >
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

