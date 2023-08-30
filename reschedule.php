<!DOCTYPE html>
<html>
<head>
    <title>Reschedule Appointment</title>
</head>
<body>
<h2>Reschedule Appointment</h2>
<form method="POST">
    <label for="date">Date:</label>
    <input type="date" name="date" required><br>

    <label for="time">Time:</label>
    <input type="time" name="time" required><br>


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

    <input type="submit" value="Reschedule">
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

$date = $_POST['date'];
$time = $_POST['time'];
$appointmentId =  $_POST['appointments'];

$appointmentDateTime = date("Y-m-d H:i:s", strtotime("$date $time"));

$doctorShiftEnd = strtotime("17:00");
$doctorShiftStart = strtotime("09:00");

$dayOfWeek = date('w', strtotime($date));
$timeOfDay = strtotime($time);
if ($dayOfWeek == 0 || $dayOfWeek == 6) {
    echo "Appointment time is outside working days.";
} else if ($timeOfDay < $doctorShiftStart || $timeOfDay >= $doctorShiftEnd) {
    echo "Appointment time is outside working hours.";
} else {
    $query = "SELECT * FROM appointments WHERE start_time = '$appointmentDateTime'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "Appointment slot is already taken.";
    } else {
        $id = uniqid();
        $insertQuery = "UPDATE appointments SET start_time= '$appointmentDateTime', end_time=ADDTIME('$appointmentDateTime', '1:00:00') 
        WHERE appointment_id = '$appointmentId'";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();

