<?php
// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve bookings from the database
$sql = "SELECT * FROM bookings";
$result = mysqli_query($conn, $sql);

// Filter the bookings based on the input fields in the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST["room_number"];
    $room_type = $_POST["room_type"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $sql = "SELECT * FROM bookings WHERE room_number = '$room_number' AND room_type = '$room_type' AND start_time >= '$start_time' AND end_time <= '$end_time'";
    $result = mysqli_query($conn, $sql);
}
?>

<!-- Display the bookings in a table -->
<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>User Email</th>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the bookings and display them in rows
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["booking_id"] . "</td>";
                echo "<td>" . $row["user_email"] . "</td>";
                echo "<td>" . $row["room_number"] . "</td>";
                echo "<td>" . $row["room_type"] . "</td>";
                echo "<td>" . $row["start_time"] . "</td>";
                echo "<td>" . $row["end_time"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No bookings found</td></tr>";
        }
        ?>
    </tbody>
</table>
