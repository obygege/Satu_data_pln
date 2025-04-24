<?php
include("../../config/koneksi.php");

if (isset($_GET['id'])) {
    $id_dokumen = $_GET['id'];

    $query = "SELECT nama_dokumen FROM dokumen WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_dokumen);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $nama_dokumen = $data['nama_dokumen'];

        $query = "
            SELECT l.nip, l.aksi, l.waktu, u.nama AS nama_user
            FROM log_dokumen l
            JOIN users u ON l.nip = u.nip
            WHERE l.nama_dokumen = ?
            ORDER BY l.waktu DESC
        ";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $nama_dokumen);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<h5>Aktivitas untuk dokumen: <strong>" . htmlspecialchars($nama_dokumen) . "</strong></h5>";
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>NIP</th><th>Nama Pengguna</th><th>Aksi</th><th>Waktu</th></tr></thead><tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nip']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nama_user']) . '</td>';
                echo '<td>' . htmlspecialchars($row['aksi']) . '</td>';
                echo '<td>' . htmlspecialchars($row['waktu']) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>Tidak ada aktivitas untuk dokumen ini.</p>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<p>Dokumen tidak ditemukan.</p>';
    }

    mysqli_close($conn);
} else {
    echo '<p>Parameter id tidak ditemukan.</p>';
}
?>
