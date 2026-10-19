<?php
include "koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Jika tombol simpan diklik
if (isset($_POST['btnSimpan'])) {
    $id_servis    = $_POST['txtIdServis'];
    $id_kendaraan = $_POST['txtIdKendaraan'];
    $tgl_servis   = $_POST['txtTglServis'];
    $keluhan      = $_POST['txtKeluhan'];
    $biaya        = $_POST['txtBiaya'];

    $queryUpdate = "UPDATE servis SET 
                        id_kendaraan = '$id_kendaraan',
                        tgl_servis   = '$tgl_servis',
                        keluhan      = '$keluhan',
                        biaya        = '$biaya'
                    WHERE id_servis = '$id_servis'";

    $update = mysqli_query($koneksi, $queryUpdate);

    if ($update) {
        echo "<script>alert('Data Servis Berhasil Diperbarui!'); window.location='index.php?open=servis';</script>";
    } else {
        echo "<div style='color:red;'>Gagal memperbarui data: " . mysqli_error($koneksi) . "</div>";
    }
}

// Ambil data servis yang akan diedit
$queryData = mysqli_query($koneksi, "SELECT * FROM servis WHERE id_servis = '$id'");
$data = mysqli_fetch_array($queryData);
?>

<h2><b>EDIT DATA SERVIS</b></h2>

<form action="index.php?open=edit_servis&id=<?php echo $id; ?>" method="post">
  <!-- Hidden input ID servis -->
  <input type="hidden" name="txtIdServis" value="<?php echo isset($data['id_servis']) ? $data['id_servis'] : ''; ?>" />

  <table cellpadding="3" cellspacing="1" border="0">
    <tr>
      <td><b>Kendaraan</b></td>
      <td>:</td>
      <td>
        <select name="txtIdKendaraan" required>
          <option value="">-- Pilih Kendaraan --</option>
          <?php
          $combo = mysqli_query($koneksi, "SELECT id_kendaraan, no_plat, merk_tipe FROM kendaraan ORDER BY id_kendaraan ASC");
          
          if ($combo && mysqli_num_rows($combo) > 0) {
              while ($row = mysqli_fetch_array($combo)) {
                  $selected = (isset($data['id_kendaraan']) && $row['id_kendaraan'] == $data['id_kendaraan']) ? "selected" : "";
                  echo "<option value='" . $row['id_kendaraan'] . "' $selected>" . $row['no_plat'] . " - " . $row['merk_tipe'] . "</option>";
              }
          } else {
              echo "<option value=''>Data kendaraan kosong / error</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Tanggal Servis</b></td>
      <td>:</td>
      <td><input type="date" name="txtTglServis" value="<?php echo isset($data['tgl_servis']) ? $data['tgl_servis'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td><b>Keluhan</b></td>
      <td>:</td>
      <td><textarea name="txtKeluhan" rows="4" cols="30" required><?php echo isset($data['keluhan']) ? $data['keluhan'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td><b>Biaya (Rp)</b></td>
      <td>:</td>
      <td><input type="number" step="0.01" name="txtBiaya" value="<?php echo isset($data['biaya']) ? $data['biaya'] : ''; ?>" placeholder="0" required /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value="Simpan Perubahan" />
        <a href="index.php?open=servis"><input type="button" value="Batal" /></a>
      </td>
    </tr>
  </table>
</form>