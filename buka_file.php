<?php
$open = isset($_GET['open']) ? $_GET['open'] : '';

switch ($open) {
    case 'pelanggan':
        include "pelanggan.php";
        break;

    case 'tambah_pelanggan':
        include "tambah_pelanggan.php";
        break;

    case 'hapus_pelanggan':
        include "hapus_pelanggan.php";
        break;

    case 'edit_pelanggan':
        include "edit_pelanggan.php";
        break;

    case 'kendaraan':
        include "kendaraan.php";
        break;

    case 'tambah_kendaraan':
        include "tambah_kendaraan.php";
        break;

    case 'hapus_kendaraan':
        include "hapus_kendaraan.php";
        break;

    case 'edit_kendaraan':
        include "edit_kendaraan.php";
        break;

    case 'servis':
        include "servis.php";
        break;

    case 'tambah_servis':
        include "tambah_servis.php";
        break;

    case 'hapus_servis':
        include "hapus_servis.php";
        break;

    case 'edit_servis':
        include "edit_servis.php";
        break;

    case 'pembayaran':
        include "pembayaran.php";
        break;

    case 'tambah_pembayaran':
        include "tambah_pembayaran.php";
        break;

    case 'edit_pembayaran':
        include "edit_pembayaran.php";
        break;
        
    case 'hapus_pembayaran':
        include "hapus_pembayaran.php";
        break;

    default:
        echo "<h3>Selamat Datang, Admin</h3>";
        echo "<p>Selamat datang di aplikasi servis kendaraan.</p>";
        break;
}
?>