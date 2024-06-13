<?php
require_once 'connection.php';

// Get the filter from the query parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

// Prepare SQL query based on the filter
switch ($filter) {
    case 'perhari':
        $sql_ldr = "SELECT * FROM ldr WHERE create_at >= CURDATE() ORDER BY create_at DESC;";
        break;
    case 'perminggu':
        $sql_ldr = "SELECT * FROM ldr WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY create_at DESC;";
        break;
    case 'perbulan':
        $sql_ldr = "SELECT * FROM ldr WHERE create_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY create_at DESC;";
        break;
    case 'semua':
    default:
        $sql_ldr = "SELECT * FROM ldr ORDER BY create_at DESC;";
        break;
}

$result_ldr = mysqli_query($connection, $sql_ldr);

$label_servo_array = array();
$lt_data = array();
$rt_data = array();
$ld_data = array();
$rd_data = array();

while ($data = mysqli_fetch_assoc($result_ldr)) {
    $label_servo_array[] = date('d/m/Y, H:i:s', strtotime($data['create_at']));
    $lt_data[] = $data['lt'] . " Units";
    $rt_data[] = $data['rt'] . " Units";
    $ld_data[] = $data['ld'] . " Units";
    $rd_data[] = $data['rd'] . " Units";
}

$data_array = array(
    'label_servo_array' => $label_servo_array,
    'lt_array' => $lt_data,
    'rt_array' => $rt_data,
    'ld_array' => $ld_data,
    'rd_array' => $rd_data
);

echo json_encode($data_array);

mysqli_close($connection);
?>
