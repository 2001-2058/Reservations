<?php
session_start();
include 'db.php'; // Include database connection script

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID'], $_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['rev_date'], $_POST['rev_time'], $_POST['hours'], $_POST['price'])) {
    
        $id = $_POST['ID'];
        echo $id;
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rev_date = $_POST['rev_date'];
        $rev_time = $_POST['rev_time'];
        $hours = $_POST['hours'];
        $price = $_POST['price'];

        $sql = "UPDATE reservations SET name=?, address=?, email=?, phone=?, rev_date=?, rev_time=?, hours=?, price=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssissi", $name, $address, $email, $phone, $rev_date, $rev_time, $hours, $price, $id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Reservation updated successfully';
        } else {
            $response['message'] = 'Error: Unable to update the reservation. Please try again later.';
        }
        $stmt->close();
    } else {
        $response['message'] = 'Invalid request';
    }
} else {
    $response['message'] = 'Invalid request method';
}

       

echo json_encode($response);
$conn->close();
?>
