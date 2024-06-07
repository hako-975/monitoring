<?php
require_once 'connection.php';

// Fetch latest data
$sql_ldr = "SELECT * FROM ldr ORDER BY create_at DESC, id DESC LIMIT 1";

$result_ldr = mysqli_query($connection, $sql_ldr);

if (mysqli_num_rows($result_ldr) > 0) {
    // Output data of the latest row
    $row_ldr = mysqli_fetch_assoc($result_ldr);
    $data = array(
        'lt' => $row_ldr['lt'],
        'rt' => $row_ldr['rt'],
        'ld' => $row_ldr['ld'],
        'rd' => $row_ldr['rd'],
        'create_at' => date('d/m/Y, H:i:s', strtotime($row_ldr['create_at']))
    );
    echo json_encode($data);
} else {
    echo json_encode(array('lt' => 'N/A', 'rt' => 'N/A', 'ld' => 'N/A', 'rd' => 'N/A', 'create_at' => '-'));
}

mysqli_close($connection);
?>
