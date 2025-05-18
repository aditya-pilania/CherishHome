<?php
include('../db-connection.php'); // Adjust path if needed

if (!isset($_GET['event_id'])) {
    echo "Invalid event.";
    exit;
}

$event_id = intval($_GET['event_id']);
$event_query = mysqli_query($conn, "SELECT * FROM events WHERE id = $event_id");

if (mysqli_num_rows($event_query) == 0) {
    echo "Event not found.";
    exit;
}

$event = mysqli_fetch_assoc($event_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Join Event - <?php echo htmlspecialchars($event['title']); ?></title>
    <link rel="stylesheet" href="../css/join_event.css"> <!-- Optional -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
</head>
<body>
    <div class="container">
        <h2>Join Event: <?php echo htmlspecialchars($event['title']); ?></h2>
        <p><?php echo htmlspecialchars($event['description']); ?></p>

        <form action="send_otp.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Occupation:</label>
                <input type="text" name="occupation">
            </div>

            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Select...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Why do you want to join?</label>
                <textarea name="reason" rows="4" cols="40"></textarea>
            </div>

            <button type="submit">Send OTP</button>
        </form>
    </div>
</body>
</html>
