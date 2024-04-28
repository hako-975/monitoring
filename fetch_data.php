<?php
require_once 'connection.php';

// Fetch latest data
$sql_dht22 = "SELECT * FROM dht22 ORDER BY create_at DESC, id DESC LIMIT 5";
$sql_ina219 = "SELECT * FROM ina219 ORDER BY create_at DESC, id DESC LIMIT 5";

$result_dht22 = mysqli_query($connection, $sql_dht22);
$result_ina219 = mysqli_query($connection, $sql_ina219);

if (mysqli_num_rows($result_dht22) > 0 || mysqli_num_rows($result_ina219) > 0) {
    // Output data of the latest row
    $row_dht22 = mysqli_fetch_assoc($result_dht22);
    $row_ina219 = mysqli_fetch_assoc($result_ina219);
    $data = array(
        'temperature' => $row_dht22['temperature'],
        'humidity' => $row_dht22['humidity'],
        'tegangan' => $row_ina219['tegangan'],
        'arus' => $row_ina219['arus']
    );
    echo json_encode($data);
} else {
    echo json_encode(array('temperature' => 'N/A', 'humidity' => 'N/A', 'tegangan' => 'N/A', 'arus' => 'N/A'));
}

mysqli_close($connection);
?>
