<?php
require_once 'connection.php';

$sql_ina219 = "SELECT * FROM (
    SELECT * FROM ina219 ORDER BY id DESC LIMIT 5
) AS latest_data
ORDER BY create_at ASC;
";

$result_ina219 = mysqli_query($connection, $sql_ina219);

// Fetch latest data for labels suhu dan kelembaban
$label_arus_tegangan_array = array();
$tegangan_data = array();
$arus_data = array();
while ($data = mysqli_fetch_assoc($result_ina219)) {
    $label_arus_tegangan_array[] = $data['create_at'];
    $tegangan_data[] = $data['tegangan'];
    $arus_data[] = $data['arus'];
}

$data_array = array(
    'label_arus_tegangan_array' => $label_arus_tegangan_array,
    'arus_array' => $arus_data,
    'tegangan_array' => $tegangan_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
