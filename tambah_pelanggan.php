<?php
include "koneksi.php";


if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];

    $simpan = mysqli_query($koneksi, "INSERT INTO pelanggan (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')");

    if ($simpan) {
        echo "<script>alert('Data pelanggan berhasil disimpan!'); window.location='?open=pelanggan';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<h2><b>TAMBAH DATA PELANGGAN</b></h2>

<form action="" method="post">
    <table cellpadding="5" cellspacing="0" border="0">
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><input type="text" name="nama" required style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="alamat" rows="3" required style="width: 250px; padding: 5px;"></textarea></td>
        </tr>
        <tr>
            <td>No HP / WhatsApp</td>
            <td>:</td>
            <td><input type="text" name="no_hp" required style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <input type="submit" name="simpan" value="Simpan Data" style="padding: 5px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            </td>
        </tr>
    </table>
</form>