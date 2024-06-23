<?php
require_once 'connection.php';

// Fetch latest data
$sql_ldr = "SELECT * FROM (
    SELECT * FROM ldr ORDER BY id DESC LIMIT 5
) AS latest_data
ORDER BY create_at ASC;
";

$result_ldr = mysqli_query($connection, $sql_ldr);

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

$data_array = array(
    'label_dual_axis_solar_tracker_array' => $label_dual_axis_solar_tracker_array,
    'lt_array' => $lt_data,
    'rt_array' => $rt_data,
    'ld_array' => $ld_data,
    'rd_array' => $rd_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
