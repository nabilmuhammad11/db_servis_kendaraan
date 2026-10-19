<?php
include "koneksi.php";


$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    
    $query = mysqli_query($koneksi, "DELETE FROM kendaraan WHERE id_kendaraan = '$id'");

    if ($query) {
        echo "<script>alert('Data kendaraan berhasil dihapus!'); window.location='index.php?open=kendaraan';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data kendaraan: " . mysqli_error($koneksi) . "'); window.location='index.php?open=kendaraan';</script>";
    }
} else {
    echo "<script>alert('ID Kendaraan tidak valid!'); window.location='index.php?open=kendaraan';</script>";
}
?>