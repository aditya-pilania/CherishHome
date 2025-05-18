<?php
include('../db-connection.php');

$result = mysqli_query($conn, "SELECT * FROM events");
$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'], // full datetime
        'end' => $row['end'],     // full datetime (optional)
        'description' => $row['description']
        // Do not set allDay
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
