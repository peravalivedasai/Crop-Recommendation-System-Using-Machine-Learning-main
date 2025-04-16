<?php
session_start();
$username = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
	<style>
    

    .form-container {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 500px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    .form-group {
      flex: 1;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background-color: #45a049;
    }

    @media (max-width: 600px) {
      .form-row {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
		<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5 py-3 align-items-center">
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-start">
                <!-- Left space if needed -->
            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-center justify-content-center">
                <a href="index.html" class="navbar-brand ms-lg-5">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">crop</span> Recommendation System</h1>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
    <div class="d-flex align-items-center justify-content-end">
        <!-- Profile dropdown -->
        <div class="dropdown">
         <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    👤 <?php echo htmlspecialchars($username); ?>
</a>


            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

    </div>
</div>

    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.php" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">crop</span>Recommendation <br>System</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="index1.php" class="nav-item nav-link ">Home</a>
                <a href="about1.php" class="nav-item nav-link">About</a>
					<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Types of Soil</a>
    <div class="dropdown-menu m-0">
        <a href="crop-form.php" class="dropdown-item">Sandy soil</a>
        <a href="crop.php" class="dropdown-item">Loamy soil</a>
        <a href="crop.php" class="dropdown-item">Black soil</a>
        <a href="crop.php" class="dropdown-item">Red soil</a>
        <a href="crop.php" class="dropdown-item">Clayey soil</a>
    </div>
</div>


                <a href="contact1.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

<div style="min-height: 100vh; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
  <div class="form-container">
    <h2>Crop Recommendation Form</h2>
    <form method="post" action="crop.php">

      <div class="form-row">
        <div class="form-group">
          <label for="nitrogen">Nitrogen</label>
          <input type="text" id="nitrogen" name="Nitrogen" required>
        </div>

        <div class="form-group">
          <label for="phosphorus">Phosphorus</label>
          <input type="text" id="phosphorus" name="Phosporus" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="potassium">Potassium</label>
          <input type="text" id="potassium" name="Potassium" required>
        </div>

        <div class="form-group">
          <label for="temperature">Temperature (°C)</label>
          <input type="text" id="temperature" name="Temperature" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="humidity">Humidity (%)</label>
          <input type="text" id="humidity" name="Humidity" required>
        </div>

        <div class="form-group">
          <label for="ph">pH</label>
          <input type="text" id="ph" name="Ph" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group" style="flex: 1;">
          <label for="rainfall">Rainfall (mm)</label>
          <input type="text" id="rainfall" name="Rainfall" required>
        </div>
        <div class="form-group" style="flex: 1;"></div> <!-- Empty to keep layout aligned -->
      </div>

      <input class="submit-btn" type="submit" value="Get Recommendation">
    </form>
  </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = array(
            "Nitrogen" => $_POST["Nitrogen"],
            "Phosporus" => $_POST["Phosporus"],
            "Potassium" => $_POST["Potassium"],
            "Temperature" => $_POST["Temperature"],
            "Humidity" => $_POST["Humidity"],
            "Ph" => $_POST["Ph"],
            "Rainfall" => $_POST["Rainfall"]
        );

        $jsonData = json_encode($data);

        $ch = curl_init("http://127.0.0.1:5000/predict"); // Flask running locally
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        echo '<div style="
    max-width: 600px;
    margin: 30px auto;
    padding: 25px;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    text-align: center;
">';

echo "<h3 style='margin-bottom: 20px;'>🌾 Recommended Crops</h3>";
echo "<ul style='list-style: none; padding: 0;'>";
foreach ($result["recommendations"] as $rec) {
    echo "<li style='padding: 8px 0; font-size: 16px;'><strong>{$rec['crop']}</strong> — {$rec['probability']}% suitability</li>";
}
echo "</ul>";
echo "</div>";

    }
    ?>
 

 
    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-white mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="text-white mb-0">Krishna university college of arts and science,Rudravaram</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="text-white mb-0">							hemasreesammeta346@gmail.com
</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="text-white mb-0">+91 81210 83758</p>
                            </div>
                            
                        </div>
                        
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Popular Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="index.html"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Our Services</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-secondary p-5">
                        <h4 class="text-white">Newsletter</h4>
                        <h6 class="text-white">Subscribe Our Newsletter</h6>
                        <div class="col-12">
    <form action="subscribe.php" method="POST" class="w-100">
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </div>
    </form>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <!-- Back to Top -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>