<?php
require_once 'connection.php';

$sql_ina219 = "SELECT * FROM (
    SELECT * FROM ina219 WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY id DESC
) AS latest_data
ORDER BY create_at ASC;
";

$result_ina219 = mysqli_query($connection, $sql_ina219);
$n = mysqli_num_rows($result_ina219);

// Fetch latest data for labels suhu dan kelembaban
$label_arus_tegangan_array = array();
$tegangan_data = array();
$arus_data = array();
while ($data = mysqli_fetch_assoc($result_ina219)) {
    $label_arus_tegangan_array[] = date('d/m/Y, H:i:s', strtotime($data['create_at']));
    $arus_data[] = $data['arus'];
    $tegangan_data[] = $data['tegangan'];
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
$arus_regression = calculateLinearRegression($x_array, $arus_data);
$tegangan_regression = calculateLinearRegression($x_array, $tegangan_data);

$data_array = array(
    'label_arus_tegangan_array' => $label_arus_tegangan_array,
    'arus_array' => $tegangan_data,
    'tegangan_array' => $arus_data,
    'arus_regression' => $tegangan_regression,
    'tegangan_regression' => $arus_regression
);

echo json_encode($data_array);

mysqli_close($connection);
?>
