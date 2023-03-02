<?php
// Connect to the database
$db_host = "localhost"; // Change this to your database host
$db_user = "root"; // Change this to your database username
$db_pass = "password"; // Change this to your database password
$db_name = "my_database"; // Change this to your database name
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// Get the form data
$email = $_POST["email"];
$room = $_POST["room"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];

// Validate the start and end times
if (strtotime($start_time) >= strtotime($end_time)) {
  echo "Error: Start time must be before end time";
  exit();
}

// Insert the booking into the database
$sql = "INSERT INTO bookings (email, room, start_time, end_time) VALUES ('$email', $room, '$start_time', '$end_time')";

if (mysqli_query($conn, $sql)) {
  echo "Booking added successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
