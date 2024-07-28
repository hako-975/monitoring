<?php
require_once 'connection.php';

// Get the filter from the query parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

// Prepare SQL query based on the filter
switch ($filter) {
    case 'perhari':
        $sql_ina219 = "SELECT * FROM ina219 WHERE create_at >= CURDATE() ORDER BY create_at DESC;";
        break;
    case 'perminggu':
        $sql_ina219 = "SELECT * FROM ina219 WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY create_at DESC;";
        break;
    case 'perbulan':
        $sql_ina219 = "SELECT * FROM ina219 WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY create_at DESC;";
        break;
    case 'semua':
    default:
        $sql_ina219 = "SELECT * FROM ina219 ORDER BY create_at DESC;";
        break;
}

$result_ina219 = mysqli_query($connection, $sql_ina219);

// Fetch latest data for labels arus dan tegangan
$label_arus_tegangan_array = array();
$tegangan_data = array();
$arus_data = array();
while ($data = mysqli_fetch_assoc($result_ina219)) {
    $label_arus_tegangan_array[] = date('d/m/Y, H:i:s', strtotime($data['create_at']));
    $arus_data[] = $data['arus'] . " V";
    $tegangan_data[] = $data['tegangan'] . " A";
}

$data_array = array(
    'label_arus_tegangan_array' => $label_arus_tegangan_array,
    'arus_array' => $tegangan_data,
    'tegangan_array' => $arus_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
