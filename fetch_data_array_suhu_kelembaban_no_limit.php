<?php
require_once 'connection.php';

// Get the filter from the query parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

// Prepare SQL query based on the filter
switch ($filter) {
    case 'perhari':
        $sql_dht22 = "SELECT * FROM dht22 WHERE create_at >= CURDATE() ORDER BY create_at DESC;";
        break;
    case 'perminggu':
        $sql_dht22 = "SELECT * FROM dht22 WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY create_at DESC;";
        break;
    case 'perbulan':
        $sql_dht22 = "SELECT * FROM dht22 WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY create_at DESC;";
        break;
    case 'semua':
    default:
        $sql_dht22 = "SELECT * FROM dht22 ORDER BY create_at DESC;";
        break;
}

$result_dht22 = mysqli_query($connection, $sql_dht22);

// Fetch data for labels suhu dan kelembaban
$label_suhu_kelembaban = array();
$temperature_data = array();
$humidity_data = array();
while ($data = mysqli_fetch_assoc($result_dht22)) {
    $label_suhu_kelembaban[] = $data['create_at'];
    $temperature_data[] = $data['temperature'] . " °C";
    $humidity_data[] = $data['humidity'] . " %";
}

$data_array = array(
    'label_suhu_kelembaban_array' => $label_suhu_kelembaban,
    'temperature_array' => $temperature_data,
    'humidity_array' => $humidity_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
