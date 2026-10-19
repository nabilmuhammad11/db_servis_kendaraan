<?php
include "koneksi.php";


$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    
    $queryHapus = "DELETE FROM servis WHERE id_servis = '$id'";
    $hapus = mysqli_query($koneksi, $queryHapus);

    if ($hapus) {
        // Jika berhasil, munculkan alert lalu arahkan kembali ke halaman servis
        echo "<script>alert('Data Servis Berhasil Dihapus!'); window.location='index.php?open=servis';</script>";
    } else {
        // Jika gagal menghapus
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location='index.php?open=servis';</script>";
    }
} else {
    // Jika ID tidak ditemukan di URL
    echo "<script>alert('ID Servis tidak valid!'); window.location='index.php?open=servis';</script>";
}
?>