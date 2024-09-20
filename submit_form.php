<?php
// Load Composer's autoloader (if using Composer)
// require 'vendor/autoload.php'; 

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['name'];  // User's name from the form
$email = $_POST['email']; // User's email from the form


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim(string: $_POST['comments']));

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';           // Specify main SMTP server
            $mail->SMTPAuth   = true;                       // Enable SMTP authentication
            $mail->Username   = 'cosammalaika@gmail.com';     // Your email address
            $mail->Password   = 'acir qmjp ynsw jqgg';      // Your email password (use App Password if 2FA is enabled)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
            $mail->Port       = 587;                        // TCP port for TLS

            // Recipients
            $mail->setFrom($email, $name);       // Sender's email
            $mail->addAddress('care@swiftguard.app', 'SwiftGuard');   // Recipient's email and name

            // Content
            $mail->isHTML(true);                                // Set email format to HTML
            $mail->Subject = $subject;                          // Email subject
            $mail->Body    = nl2br("Name: $name\nEmail: $email\nMessage: $message");  // Email message body

            // Send email
            $mail->send();
            echo "<script type='text/javascript'>
            alert('Message has been sent successfully!');
            window.location.href = 'index.html';  // Change this to the actual page
          </script>";
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "Please fill all fields.";
    }
}
?>
