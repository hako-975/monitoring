<?php
require_once 'connection.php';

// Fetch latest data
$sql_dht22 = "SELECT * FROM (
    SELECT * FROM dht22 ORDER BY id DESC LIMIT 5
) AS latest_data
ORDER BY create_at ASC;
";

$result_dht22 = mysqli_query($connection, $sql_dht22);

// Fetch latest data for labels suhu dan kelembaban
$label_suhu_kelembaban = array();
$temperature_data = array();
$humidity_data = array();
while ($data = mysqli_fetch_assoc($result_dht22)) {
    $label_suhu_kelembaban[] = $data['create_at'];
    $temperature_data[] = $data['temperature'];
    $humidity_data[] = $data['humidity'];
}

$data_array = array(
    'label_suhu_kelembaban_array' => $label_suhu_kelembaban,
    'temperature_array' => $temperature_data,
    'humidity_array' => $humidity_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
