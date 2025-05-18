<?php 
include './components/header.php'; 
require 'vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>

    <div class="ui container">

        <!-- Top Navigation Bar -->
        <?php include './components/top-menu.php'; ?>

        <!-- BODY Content -->
        <div class="ui grid">
            <!-- Left menu -->
            <?php include './components/side-menu.php'; ?>
            
            <!-- right content -->
            <div class="twelve wide column">
                <h1>Feedback</h1>

                <?php
                    if(isset($_POST['submit_feedback'])) {
                        $name = $_POST['full_name'];
                        $address = $_POST['full_address'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];

                        // Database Insertion
                        $sql = "INSERT INTO feedback (full_name, full_address, phone, email, comment) 
                                VALUES ('$name', '$address', '$phone', '$email', '$comment')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<script> alert('Feedback successfully sent'); </script>";

                            // Send Email
                            $mail = new PHPMailer(true);
                            try {
                                // SMTP Configuration
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
                                $mail->SMTPAuth = true;
                                $mail->Username = 'cherrishhomes@gmail.com'; // Your email
                                $mail->Password = 'hmib imwo qgbz yyli'; // Your email password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;

                                // Email Content
                                $mail->setFrom($email, $name);
                                $mail->addAddress('cherrishhomes@gmail.com', 'Admin'); // Your email
                                $mail->Subject = 'New Feedback Submission';
                                $mail->Body = "Name: $name\nAddress: $address\nPhone: $phone\nEmail: $email\nComments: $comment";

                                $mail->send();
                            } catch (Exception $e) {
                                echo "<script> alert('Error sending email: {$mail->ErrorInfo}'); </script>";
                            }

                            // Send Thank You Email to User
                            $thankYouMail = new PHPMailer(true);
                            try {
                                $thankYouMail->isSMTP();
                                $thankYouMail->Host = 'smtp.gmail.com';
                                $thankYouMail->SMTPAuth = true;
                                $thankYouMail->Username = 'cherrishhomes@gmail.com';
                                $thankYouMail->Password = 'hmib imwo qgbz yyli';
                                $thankYouMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $thankYouMail->Port = 587;

                                // Email Content for User
                                $thankYouMail->setFrom('cherrishhomes@gmail.com', 'Cherish Home');
                                $thankYouMail->addAddress($email, $name);
                                $thankYouMail->Subject = 'Thank You for Your Feedback!';
                                $thankYouMail->Body = "Dear $name,\n\nThank you for your valuable feedback! It means a lot to us.\n\nBest regards,\nCherrish Homes Team";

                                $thankYouMail->send();
                            } catch (Exception $e) {
                                echo "<script> alert('Error sending thank you email: {$thankYouMail->ErrorInfo}'); </script>";
                            }
                        } else {
                            echo "<script> alert('Error in Insertion'); </script>";
                        }

                        $conn->close();
                    }
                ?>

                <form action="<?php $_PHP_SELF ?>" method="post" class="ui form">
                    <div class="field">
                        <label>Name</label>
                        <input type="text" name="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="field">
                        <label>Address</label>
                        <div class="field">
                          <div class="sixteen wide field">
                            <input type="text" name="full_address" placeholder="Address" required>
                          </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Phone No.</label>
                        <div class="field">
                          <div class="eight wide field">
                            <input type="tel" name="phone" placeholder="Phone / Mobile" required>
                          </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Email Address</label>
                        <div class="field">
                          <div class="eight wide field">
                            <input type="email" name="email" placeholder="Email ID" required>
                          </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Comments</label>
                        <textarea rows="2" name="comment" required></textarea>
                    </div>
                    <button name="submit_feedback" class="ui primary button" type="submit">Submit</button>
                    <button class="ui button" type="reset">Reset</button>
                </form>

                <span class="p-20"></span>

            </div>
        </div>

    </div>
    
<?php include './components/footer.php'; ?>
