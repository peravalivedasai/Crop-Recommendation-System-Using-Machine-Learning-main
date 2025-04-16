<?php
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

// OTP verification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $entered_otp = $_POST['otp'];

    try {
        $stmt = $pdo->prepare("SELECT otp FROM `user` WHERE email = ? AND status = 'pending'");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $entered_otp == $row['otp']) {
            // Update user status to verified
            $stmt = $pdo->prepare("UPDATE `user` SET status = 'verified' WHERE email = ?");
            $stmt->execute([$email]);

            // ✅ Create table based on email
            $safe_table_name = 'user_' . preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($email));
            
            $createTableSQL = "
                CREATE TABLE IF NOT EXISTS `$safe_table_name` (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    crop VARCHAR(50),
                    recommendation_date DATETIME DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ";
            $pdo->exec($createTableSQL);

            // Redirect to login
            header("Location: login.php?success=Email verified successfully");
            exit();
        } else {
            echo "Invalid OTP or the email has already been verified.";
        }
    } catch (PDOException $e) {
        die("Error verifying OTP: " . $e->getMessage());
    }
}
?>


<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="assets/css/styles.css">
   <link rel="stylesheet" href="assets/css/form.css">
   <link rel="stylesheet" href="assets/css/styles2.css">
   <style>body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to right, #a8edea, #fed6e3);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.hero {
  width: 100%;
  max-width: 400px;
  margin: auto;
}

.form-box {
  background-color: #ffffff;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.button-box {
  margin-bottom: 20px;
}

.toggle-btn {
  background-color: #4CAF50;
  border: none;
  padding: 10px 25px;
  border-radius: 20px;
  color: white;
  font-size: 16px;
  cursor: default;
}

.form-box h2 {
  margin-bottom: 25px;
  color: #333;
}

.input-field {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
  box-sizing: border-box;
}

.submit-btn {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  border: none;
  border-radius: 8px;
  color: white;
  font-size: 16px;
  margin-top: 10px;
  cursor: pointer;
}

.submit-btn:hover {
  background-color: #45a049;
}

    </style>

</head>
<body>    
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <button type="button" class="toggle-btn">LogIn</button>
            </div>

            <h2>Enter OTP</h2>
            <form action="verify.php" method="POST">
                <!-- Pre-fill the email field with the value from the query parameter -->
                <input type="text" name="email" class="input-field" placeholder="Enter user id"
                       value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" readonly>
                <input type="text"class="input-field" name="otp" placeholder="Enter OTP" required>
                <button class="submit-btn"type="submit">Verify</button>
            </form>

        </div>
    </div>
</body>
</html>
