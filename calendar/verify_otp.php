<?php
include('../db-connection.php');

$email = isset($_GET['email']) ? strtolower(trim($_GET['email'])) : '';
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
$error = '';

if (!$email || !$event_id) {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = trim(mysqli_real_escape_string($conn, $_POST['otp']));

    $query = "SELECT otp FROM event_joins WHERE LOWER(email) = '$email' AND event_id = $event_id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($entered_otp == $row['otp']) {
            $update = "UPDATE event_joins SET is_verified = 1 WHERE LOWER(email) = '$email' AND event_id = $event_id";
            mysqli_query($conn, $update);
            header("Location: event_success.php?event_id=$event_id");
            exit;
        } else {
            $error = "Incorrect OTP. Please try again.";
        }
    } else {
        $error = "No record found for this email and event.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Verify OTP</title></head>
<body>
    <h2>Enter OTP</h2>
    <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
