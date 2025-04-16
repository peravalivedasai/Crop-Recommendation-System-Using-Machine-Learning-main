<?php
session_start(); // Start the session

// Database connection
$host = 'localhost';
$dbname = 'plant'; // Replace with your actual database name
$username = 'root'; // Use 'root' for XAMPP
$password = ''; // Leave blank for XAMPP's default

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Process login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Fetch user information from the database
    try {
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE email = ? AND status = ''");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Store user data in the session

			$_SESSION['user_id'] = $user['id'];
			$_SESSION['name'] = $user['name']; 

            // Redirect to index.php
                header('Location: index1.php');
            exit();
        } else {
            // Invalid credentials or unverified account
            header("Location: login.php?error=Invalid email, or unverified account");
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
    <h2>Login</h2>
    <form action="#" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>
