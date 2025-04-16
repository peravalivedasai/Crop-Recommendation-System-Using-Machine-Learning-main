<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $adminEmail = "hemasreesammeta346@gmail.com"; // Your email
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration hemasreesammeta346@gmail.com    Hemasree@46
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hemasreesammeta346@gmail.com'; // SMTP username
        $mail->Password   = 'ovtd rwwn zxtv wkru'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email Content
        $mail->setFrom('hemasreesammeta346@gmail.com', 'Subscription Service');
        $mail->addAddress($adminEmail);
        $mail->Subject = 'New Subscription';
        $mail->Body    = "A new user has subscribed with the email: " . $userEmail;

        if ($mail->send()) {
            echo "<script>
                alert('Thanks for subscribing!');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Subscription failed. Please try again!');
                window.location.href = 'index.php';
            </script>";
        }
    } catch (Exception $e) {
        echo "<script>
            alert('Error: {$mail->ErrorInfo}');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'index.php';
    </script>";
}
?>

