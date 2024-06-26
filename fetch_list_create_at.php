<?php
require_once 'connection.php';

$sql = "SELECT DISTINCT create_at FROM ldr ORDER BY create_at DESC";
$result = mysqli_query($connection, $sql);

$listCreateAt = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $listCreateAt[] = $row['create_at'];
    }
}

echo json_encode($listCreateAt);

mysqli_close($connection);
?>
