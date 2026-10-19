<?php
include "koneksi.php";

if (isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];

    // Hapus data dari database MySQL
    $query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");

    if ($query) {
        echo "<script>alert('Data pelanggan berhasil dihapus!'); window.location='?open=pelanggan';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "'); window.location='?open=pelanggan';</script>";
    }
} else {
    echo "<script>window.location='?open=pelanggan';</script>";
}
?>