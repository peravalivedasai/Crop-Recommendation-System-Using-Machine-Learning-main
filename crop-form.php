<!DOCTYPE html>
<html>
<head>
    <title>Crop Recommendation</title>
</head>
<body>
    <h2>Crop Recommendation Form</h2>
    <form method="post" action="crop-form.php">
        Nitrogen: <input type="text" name="Nitrogen"><br>
        Phosphorus: <input type="text" name="Phosporus"><br>
        Potassium: <input type="text" name="Potassium"><br>
        Temperature: <input type="text" name="Temperature"><br>
        Humidity: <input type="text" name="Humidity"><br>
        pH: <input type="text" name="Ph"><br>
        Rainfall: <input type="text" name="Rainfall"><br>
        <input type="submit" value="Get Recommendation">
    </form>

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

        echo "<h3>Recommended Crops:</h3><ul>";
        foreach ($result["recommendations"] as $rec) {
            echo "<li><strong>{$rec['crop']}</strong> — {$rec['probability']}% suitability</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
