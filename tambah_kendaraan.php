<?php
include "koneksi.php";

// Proses saat tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $no_plat      = $_POST['no_plat'];
    $merk_tipe    = $_POST['merk_tipe'];

    // Query simpan data ke tabel kendaraan
    $sql = "INSERT INTO kendaraan (id_pelanggan, no_plat, merk_tipe) 
            VALUES ('$id_pelanggan', '$no_plat', '$merk_tipe')";
    
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Data kendaraan berhasil ditambahkan!'); window.location='?open=kendaraan';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data kendaraan: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<h2><b>TAMBAH DATA KENDARAAN</b></h2>
<p><a href="?open=kendaraan">&lt; Kembali ke Data Kendaraan</a></p>

<form action="" method="post">
    <table cellpadding="5" cellspacing="0" border="0">
        <tr>
            <td>Pilih Pelanggan</td>
            <td>:</td>
            <td>
                <select name="id_pelanggan" required style="width: 250px; padding: 5px;">
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php
                    // Mengambil daftar pelanggan agar tidak terjadi error Foreign Key
                    $query_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama ASC");
                    while ($pelanggan = mysqli_fetch_array($query_pelanggan)) {
                        echo "<option value='" . $pelanggan['id_pelanggan'] . "'>" . $pelanggan['nama'] . " (ID: " . $pelanggan['id_pelanggan'] . ")</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>No Plat</td>
            <td>:</td>
            <td><input type="text" name="no_plat" required placeholder="Contoh: DA 1234 ABC" style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td>Merk / Tipe</td>
            <td>:</td>
            <td><input type="text" name="merk_tipe" required placeholder="Contoh: Honda Vario 125" style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <input type="submit" name="simpan" value="Simpan Data" style="padding: 5px 15px;">
                <input type="reset" value="Reset" style="padding: 5px 15px;">
            </td>
        </tr>
    </table>
</form>