<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
</head>
<body>
<h2>Book an Appointment</h2>
<form method="POST">
    <label for="date">Date:</label>
    <input type="date" name="date" required><br>

    <label for="time">Time:</label>
    <input type="time" name="time" required><br>

    <label for="service">Service:</label>
    <select name="service" required>
        <option value="service_1">Service 1</option>
        <option value="service_2">Service 2</option>
    </select><br>

    <label for="patient_contact">Contact Information:</label>
    <input type="text" name="patient_contact" required><br>

    <input type="submit" value="Book Appointment">
</form>
</body>
</html>

<?php

$host = "127.0.0.1";
$database = "Clinic";
$username = "obscured";
$password = "obscured.";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'];
$time = $_POST['time'];
$service = $_POST['service'];
$patientContact = $_POST['patient_contact'];

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
        echo "Appointment slot is already booked.";
    } else {
        $id = uniqid();
        $insertQuery = "INSERT INTO appointments (appointment_id, doctor_id, start_time, end_time, service, status, patient_contact) 
                        VALUES ('$id', 1, '$appointmentDateTime', ADDTIME('$appointmentDateTime', '1:00:00'), '$service', 'SCHEDULED', '$patientContact')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();

