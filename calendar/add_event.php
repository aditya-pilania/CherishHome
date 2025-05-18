<?php
// database connection (update path or credentials if needed)
include('../db-connection.php'); 

// Insert Event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $description = $_POST['description'];
    $created_by = 'admin'; // Or use session-based admin name
    $is_public = isset($_POST['is_public']) ? 1 : 0;

    $sql = "INSERT INTO events (title, start, end, description, created_by, is_public) 
            VALUES ('$title', '$start', '$end', '$description', '$created_by', '$is_public')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Event added successfully!'); window.location.href='calendar.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Optional -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
</head>
<body>
    <div class="ui container">
        <h2 class="ui header">Add New Event</h2>
        <form class="ui form" method="POST" action="">
            <div class="field">
                <label>Event Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="field">
                <label>Start Date & Time</label>
                <input type="datetime-local" name="start" required>
            </div>
            <div class="field">
                <label>End Date & Time</label>
                <input type="datetime-local" name="end" required>
            </div>
            <div class="field">
                <label>Description</label>
                <textarea name="description" rows="3" required></textarea>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="is_public" tabindex="0">
                    <label>Make Event Public</label>
                </div>
            </div>
            <button class="ui primary button" type="submit">Add Event</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <script>
        $('.ui.checkbox').checkbox(); // Activate checkbox styling
    </script>
</body>
</html>
