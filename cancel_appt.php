<!DOCTYPE html>
<html>
<head>
    <title>Cancel Appointment</title>
</head>
<body>
<h2>Cancel an Appointment</h2>
<form method="POST">
    <select name="appointments" required>
        <?php
        $host = "127.0.0.1";
        $database = "Clinic";
        $username = "obscured";
        $password = "obscured";

        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT appointment_id, start_time, end_time, status FROM appointments WHERE status!='CANCELLED'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointmentId = $row["appointment_id"];
                $startTime = $row["start_time"];
                $endTime = $row["end_time"];
                $status = $row["status"];
                echo "<option value='$appointmentId'> $startTime - $endTime - $status</option>";
            }
        }

        $conn->close();
        ?>
    </select><br>

    <input type="submit" value="CANCEL">
</form>
</body>
</html>

<?php

$host = "127.0.0.1";
$database = "Clinic";
$username = "obscured";
$password = "obscured";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$appointmentId =  $_POST['appointments'];

$id = uniqid();
$updateQuery = "UPDATE appointments SET status='CANCELLED' where appointment_id = '$appointmentId'";

if ($conn->query($updateQuery) === TRUE) {
    echo "Appointment cancelled successfully!";
} else {
    echo "Error: " . $updateQuery . "<br>" . $conn->error;
}

$conn->close();


