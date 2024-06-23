<?php
$servername = "localhost:3306";
$dbname = "dastmoni_monitoring";
$username = "dastmoni_admin";
$password = "grandakasia29";

$api_key_value = "12345";
$api_key = $lt = $rt = $ld = $rd = "";
$temperature = $humidity = $arus = $tegangan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    $lt = test_input($_POST["ldrlt"]);
    $rt = test_input($_POST["ldrrt"]);
    $ld = test_input($_POST["ldrld"]);
    $rd = test_input($_POST["ldrrd"]);
    $temperature = test_input($_POST["temperature"]);
    $humidity = test_input($_POST["humidity"]);
    $arus = test_input($_POST["current_mA"]);
    $tegangan = test_input($_POST["busVoltage"]);

    if ($api_key == $api_key_value) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
            exit();
        }

        // Insert LDR data
        $sql_ldr = "INSERT INTO ldr (lt, rt, ld, rd) VALUES ('$lt', '$rt', '$ld', '$rd')";
        if ($conn->query($sql_ldr) === TRUE) {
            
            if ($conn->query($sql_ldr) === TRUE) {
                echo "Data LDR berhasil ditambahkan. ";
            } else {
                echo "Data LDR gagal ditambahkan. ". "<br>" . $sql_ldr . $conn->error . " ";
            }
        } else {
            echo "Error LDR: " . $sql_ldr . "<br>" . $conn->error . " ";
        }

        // Insert Temperature and Humidity data
        $sql_temp_humidity = "INSERT INTO dht22 (temperature, humidity) VALUES ('$temperature', '$humidity')";
        if ($conn->query($sql_temp_humidity) === TRUE) {
            echo "Data temperature dan humidity berhasil ditambahkan. ";
        } else {
            echo "Error temperature dan humidity: " . $sql_temp_humidity . "<br>" . $conn->error . " ";
        }

        // Insert INA219 data
        $sql_ina219 = "INSERT INTO ina219 (arus, tegangan) VALUES ('$tegangan', '$arus')";
        if ($conn->query($sql_ina219) === TRUE) {
            echo "Data tegangan dan arus berhasil ditambahkan.";
        } else {
            echo "Error tegangan dan arus: " . $sql_ina219 . "<br>" . $conn->error . " ";
        }

        $conn->close();
    } else {
        echo "Wrong API Key";
    }
} else {
    echo "No data posted HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
