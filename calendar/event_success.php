<?php
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 'Unknown';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Joined</title>
</head>
<body>
    <h2>🎉 OTP Verified Successfully!</h2>
    <p>You've joined Event ID: <?php echo $event_id; ?></p>
</body>
</html>
