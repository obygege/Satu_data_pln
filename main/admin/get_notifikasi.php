<?php
header('Content-Type: application/json');
include("../../config/koneksi.php");

$query = "SELECT COUNT(*) AS total_pending FROM reset_password WHERE status = 'pending'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

echo json_encode(['totalPending' => $data['total_pending'] ?? 0]);
