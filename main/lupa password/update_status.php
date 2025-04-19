<?php
include("../../config/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($status !== 'pending' && $status !== 'completed') {
        echo "Status tidak valid.";
        exit;
    }

    $query = "UPDATE reset_password SET status = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {

        $stmt->bind_param('si', $status, $id);


        if ($stmt->execute()) {
            echo "Status berhasil diperbarui.";
        } else {
            echo "Error: " . mysqli_error($conn); 
        }

        $stmt->close();
    } else {
        echo "Error: " . mysqli_error($conn); 
    }

    $conn->close();
}
?>
