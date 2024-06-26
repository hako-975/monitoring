<?php
require_once 'connection.php';

$selectedCreateAt = isset($_GET['create_at']) ? $_GET['create_at'] : null;

if ($selectedCreateAt !== null) {
    // Sanitize and format the timestamp as needed
    $selectedCreateAt = mysqli_real_escape_string($connection, $selectedCreateAt);

    // Fetch data for the selected timestamp
    $sql = "SELECT * FROM ldr WHERE create_at = '$selectedCreateAt'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data = [
            'lt' => $row['lt'],
            'rt' => $row['rt'],
            'ld' => $row['ld'],
            'rd' => $row['rd'],
            'create_at' => date('d/m/Y, H:i:s', strtotime($row['create_at']))
        ];
        echo json_encode($data);
    } else {
        echo json_encode(['lt' => 'N/A', 'rt' => 'N/A', 'ld' => 'N/A', 'rd' => 'N/A', 'create_at' => '-']);
    }
} else {
    echo json_encode(['error' => 'Tanggal Belum Dipilih']);
}

mysqli_close($connection);
?>
