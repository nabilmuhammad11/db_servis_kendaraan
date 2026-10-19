<?php
include "koneksi.php";

// Ambil ID Pelanggan dari URL
$id_pelanggan = $_GET['id_pelanggan'];

// Ambil data pelanggan berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$data = mysqli_fetch_array($query);


if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];

    
    $update = mysqli_query($koneksi, "UPDATE pelanggan SET 
                nama   = '$nama',
                alamat = '$alamat',
                no_hp  = '$no_hp' 
              WHERE id_pelanggan = '$id_pelanggan'");

    if ($update) {
        echo "<script>alert('Data pelanggan berhasil diubah!'); window.location='?open=pelanggan';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<h2><b>EDIT DATA PELANGGAN</b></h2>
<p><a href="?open=pelanggan">&lt; Kembali ke Data Pelanggan</a></p>

<form action="" method="post">
    <table cellpadding="5" cellspacing="0" border="0">
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" required style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="alamat" rows="3" required style="width: 250px; padding: 5px;"><?php echo $data['alamat']; ?></textarea></td>
        </tr>
        <tr>
            <td>No. Telepon / HP</td>
            <td>:</td>
            <td><input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>" required style="width: 250px; padding: 5px;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <input type="submit" name="update" value="Update Data" style="padding: 5px 15px;">
            </td>
        </tr>
    </table>
</form>