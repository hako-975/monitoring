<?php
require_once 'connection.php';

// Fetch latest data
$sql_dht22 = "SELECT * FROM (
    SELECT * FROM dht22 WHERE DATE(create_at) = CURDATE() ORDER BY id DESC
) AS latest_data
ORDER BY create_at ASC;
";

$result_dht22 = mysqli_query($connection, $sql_dht22);
$n = mysqli_num_rows($result_dht22);

// Fetch latest data for labels suhu dan kelembaban
$label_suhu_kelembaban = array();
$temperature_data = array();
$humidity_data = array();
while ($data = mysqli_fetch_assoc($result_dht22)) {
    $label_suhu_kelembaban[] = date('d/m/Y, H:i:s', strtotime($data['create_at']));
    $temperature_data[] = $data['temperature'];
    $humidity_data[] = $data['humidity'];
}

$x_array = [];
for ($i = 0; $i < $n; $i++) {
    $x_array[] = $i + 1; // dimulai dari 1
}

// Fungsi untuk menghitung regresi linear
function calculateLinearRegression($x_array, $y_array) {
    $n = count($x_array);
    
    // Menghitung jumlah x, y, xy, dan x^2
    $sum_x = $sum_y = $sum_xy = $sum_x2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $x = $x_array[$i];
        $y = $y_array[$i];
        $sum_x += $x;
        $sum_y += $y;
        $sum_xy += ($x * $y);
        $sum_x2 += ($x * $x);
    }

    // Menghitung slope (m) dan intercept (c)
    $m = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x * $sum_x);
    $c = ($sum_y * $sum_x2 - $sum_x * $sum_xy) / ($n * $sum_x2 - $sum_x * $sum_x);

    // Mempersiapkan data untuk regresi linear
    $regression_data = [];
    foreach ($x_array as $x) {
        $regression_data[] = $m * $x + $c;
    }

    return $regression_data;
}

// Menghitung regresi linear untuk masing-masing variabel
$temperature_regression = calculateLinearRegression($x_array, $temperature_data);
$humidity_regression = calculateLinearRegression($x_array, $humidity_data);

$data_array = array(
    'label_suhu_kelembaban_array' => $label_suhu_kelembaban,
    'temperature_array' => $temperature_data,
    'humidity_array' => $humidity_data,
    'temperature_regression' => $temperature_regression,
    'humidity_regression' => $humidity_regression
);

echo json_encode($data_array);

mysqli_close($connection);
?>
