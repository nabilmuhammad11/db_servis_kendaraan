<?php
include "koneksi.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    $query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_pembayaran = '$id'");

    if ($query) {
        echo "<script>alert('Data pembayaran berhasil dihapus!'); window.location='index.php?open=pembayaran';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data pembayaran: " . mysqli_error($koneksi) . "'); window.location='index.php?open=pembayaran';</script>";
    }
} else {
    echo "<script>window.location='index.php?open=pembayaran';</script>";
}
?>