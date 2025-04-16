<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Database connection
$host = 'localhost';
$dbname = 'plant'; 
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['username']; // fixed name
    $email = $_POST['email'];
    $raw_password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($raw_password !== $confirm) {
        echo "Passwords do not match!";
        exit();
    }

    $password = password_hash($raw_password, PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);
    $default_profile_picture = 'img/a1.png';

    // Check if the email is already registered
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        echo "You are already registered. Redirecting to the login page...";
        header("Refresh: 3; url=login.php");
        exit();
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO `user` (name, email, password, otp, status, profile_picture) VALUES (?, ?, ?, ?, 'pending', ?)");
            $stmt->execute([$name, $email, $password, $otp, $default_profile_picture]);

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'hemasreesammeta346@gmail.com';
                $mail->Password = 'ovtd rwwn zxtv wkru'; // App password (keep safe!)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('hemasreesammeta346@gmail.com', 'crop Recommendation System');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body = 'Your OTP code is <b>' . $otp . '</b>. Please use this code to verify your email.';

                $mail->send();
                echo 'OTP sent to your email. Please check your inbox.';
                header('Location: verify.php?email=' . urlencode($email));
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } catch (PDOException $e) {
            die("Error inserting data: " . $e->getMessage());
        }
    }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
  <style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: #f0f2f5;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.register-container {
  background: white;
  padding: 30px 40px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

.register-container h2 {
  margin-bottom: 20px;
  color: #333;
}

.register-container form input {
  width: 100%;
  padding: 12px 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

.register-container button {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  border: none;
  border-radius: 8px;
  color: white;
  font-size: 16px;
  cursor: pointer;
  margin-top: 10px;
}

.register-container button:hover {
  background-color: #45a049;
}

.register-container p {
  margin-top: 15px;
  font-size: 14px;
}

.register-container a {
  color: #4CAF50;
  text-decoration: none;
}

.register-container a:hover {
  text-decoration: underline;
}

    </style>

</head>
<body>
  <div class="register-container">
    <h2>Create an Account</h2>
    <form action="#" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</body>
</html>
