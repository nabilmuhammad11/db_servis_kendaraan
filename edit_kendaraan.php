<?php
include "koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Jika tombol simpan/update diklik
if (isset($_POST['btnSimpan'])) {
    $id_kendaraan  = $_POST['txtIdKendaraan'];
    $id_pelanggan  = $_POST['txtIdPelanggan'];
    $no_plat       = $_POST['txtNoPlat'];
    $merk_tipe     = $_POST['txtMerkTipe'];

    $queryUpdate = "UPDATE kendaraan SET 
                        id_pelanggan = '$id_pelanggan',
                        no_plat      = '$no_plat',
                        merk_tipe    = '$merk_tipe'
                    WHERE id_kendaraan = '$id_kendaraan'";

    $update = mysqli_query($koneksi, $queryUpdate);

    if ($update) {
        echo "<script>alert('Data Kendaraan Berhasil Diperbarui!'); window.location='index.php?open=kendaraan';</script>";
    } else {
        echo "<div style='color:red;'>Gagal memperbarui data: " . mysqli_error($koneksi) . "</div>";
    }
}

// Ambil data kendaraan yang akan diedit
$queryData = mysqli_query($koneksi, "SELECT * FROM kendaraan WHERE id_kendaraan = '$id'");
$data = mysqli_fetch_array($queryData);
?>

<h2><b>EDIT DATA KENDARAAN</b></h2>

<form action="index.php?open=edit_kendaraan&id=<?php echo $id; ?>" method="post">
  <!-- Hidden input untuk menyimpan ID kendaraan -->
  <input type="hidden" name="txtIdKendaraan" value="<?php echo isset($data['id_kendaraan']) ? $data['id_kendaraan'] : ''; ?>" />

  <table cellpadding="3" cellspacing="1" border="0">
    <tr>
      <td><b>ID Pelanggan</b></td>
      <td>:</td>
      <td><input type="text" name="txtIdPelanggan" value="<?php echo isset($data['id_pelanggan']) ? $data['id_pelanggan'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td><b>No Plat</b></td>
      <td>:</td>
      <td><input type="text" name="txtNoPlat" value="<?php echo isset($data['no_plat']) ? $data['no_plat'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td><b>Merk / Type</b></td>
      <td>:</td>
      <td><input type="text" name="txtMerkTipe" value="<?php echo isset($data['merk_tipe']) ? $data['merk_tipe'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value="Simpan Perubahan" />
        <a href="index.php?open=kendaraan"><input type="button" value="Batal" /></a>
      </td>
    </tr>
  </table>
</form>