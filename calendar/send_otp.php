<?php
include('../db-connection.php');
require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = intval($_POST['event_id']);
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $otp = rand(100000, 999999);

    $insert = "INSERT INTO event_joins (event_id, name, email, occupation, gender, reason, otp) 
               VALUES ('$event_id', '$name', '$email', '$occupation', '$gender', '$reason', '$otp')";

    if (mysqli_query($conn, $insert)) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cherrishhomes@gmail.com';
        $mail->Password = 'nptj tvdl rysz pwho'; // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('cherrishhomes@gmail.com', 'Cherrish Homes');
        $mail->addAddress($email, $name);
        $mail->Subject = 'Your OTP to Join Event';
        $mail->Body = "Hi $name,\n\nYour OTP for joining the event is: $otp";

        if ($mail->send()) {
            header("Location: verify_otp.php?email=" . urlencode($email) . "&event_id=" . urlencode($event_id));
            exit;
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "DB Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request";
}
