<?php
require_once 'connection.php';

// Fetch latest data
$sql_ldr = "SELECT * FROM (
    SELECT * FROM ldr WHERE DATE(create_at) = CURDATE() ORDER BY id DESC
) AS latest_data
ORDER BY create_at ASC;
";

$result_ldr = mysqli_query($connection, $sql_ldr);

$n = mysqli_num_rows($result_ldr);

// Fetch latest data for labels suhu dan kelembaban
$label_dual_axis_solar_tracker_array = array();
$lt_data = array();
$rt_data = array();
$ld_data = array();
$rd_data = array();

while ($data = mysqli_fetch_assoc($result_ldr)) {
    $label_dual_axis_solar_tracker_array[] = date('d/m/Y, H:i:s', strtotime($data['create_at']));
    $lt_data[] = $data['lt'];
    $rt_data[] = $data['rt'];
    $ld_data[] = $data['ld'];
    $rd_data[] = $data['rd'];
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
$lt_regression = calculateLinearRegression($x_array, $lt_data);
$rt_regression = calculateLinearRegression($x_array, $rt_data);
$ld_regression = calculateLinearRegression($x_array, $ld_data);
$rd_regression = calculateLinearRegression($x_array, $rd_data);

$data_array = array(
    'label_dual_axis_solar_tracker_array' => $label_dual_axis_solar_tracker_array,
    'lt_array' => $lt_data,
    'rt_array' => $rt_data,
    'ld_array' => $ld_data,
    'rd_array' => $rd_data,
    'lt_regression' => $lt_regression,
    'rt_regression' => $rt_regression,
    'ld_regression' => $ld_regression,
    'rd_regression' => $rd_regression
);

echo json_encode($data_array);

mysqli_close($connection);
?>
