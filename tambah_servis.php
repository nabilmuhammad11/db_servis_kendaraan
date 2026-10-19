<?php
include "koneksi.php";

if (isset($_POST['btnSimpan'])) {
    $id_kendaraan = $_POST['txtIdKendaraan'];
    $tgl_servis   = $_POST['txtTglServis'];
    $keluhan      = $_POST['txtKeluhan'];
    $biaya        = $_POST['txtBiaya'];

    $query = "INSERT INTO servis (id_kendaraan, tgl_servis, keluhan, biaya) 
              VALUES ('$id_kendaraan', '$tgl_servis', '$keluhan', '$biaya')";

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>alert('Data Servis Berhasil Disimpan!'); window.location='index.php?open=servis';</script>";
    } else {
        echo "<div style='color:red;'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<h2><b>TAMBAH DATA SERVIS</b></h2>

<form action="index.php?open=tambah_servis" method="post">
  <table cellpadding="3" cellspacing="1" border="0">
    <tr>
      <td><b>Kendaraan</b></td>
      <td>:</td>
      <td>
        <select name="txtIdKendaraan" required>
          <option value="">-- Pilih Kendaraan --</option>
          <?php
          $combo = mysqli_query($koneksi, "SELECT id_kendaraan, no_plat, merk_tipe FROM kendaraan ORDER BY id_kendaraan ASC");
          while ($row = mysqli_fetch_array($combo)) {
              echo "<option value='" . $row['id_kendaraan'] . "'>" . $row['no_plat'] . " - " . $row['merk_tipe'] . "</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Tanggal Servis</b></td>
      <td>:</td>
      <td><input type="date" name="txtTglServis" required /></td>
    </tr>
    <tr>
      <td><b>Keluhan</b></td>
      <td>:</td>
      <td><textarea name="txtKeluhan" rows="4" cols="30" required></textarea></td>
    </tr>
    <tr>
      <td><b>Biaya (Rp)</b></td>
      <td>:</td>
      <td><input type="number" step="0.01" name="txtBiaya" placeholder="0" required /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value="Simpan" />
        <input type="reset" name="btnBatal" value="Batal" />
      </td>
    </tr>
  </table>
</form>