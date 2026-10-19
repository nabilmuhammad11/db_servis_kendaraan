<?php
include "koneksi.php";


$id = isset($_GET['id']) ? $_GET['id'] : '';


if (isset($_POST['btnSimpan'])) {
    $id_pembayaran     = $_POST['txtIdPembayaran'];
    $id_servis         = $_POST['txtIdServis'];
    $tgl_bayar         = $_POST['txtTglBayar'];
    $jumlah_bayar      = $_POST['txtJumlahBayar'];
    $metode_pembayaran = $_POST['txtMetode'];
    $keterangan        = $_POST['txtKeterangan'];

    $queryUpdate = "UPDATE pembayaran SET 
                        id_servis         = '$id_servis',
                        tgl_bayar         = '$tgl_bayar',
                        jumlah_bayar      = '$jumlah_bayar',
                        metode_pembayaran = '$metode_pembayaran',
                        keterangan        = '$keterangan'
                    WHERE id_pembayaran = '$id_pembayaran'";

    $update = mysqli_query($koneksi, $queryUpdate);

    if ($update) {
        echo "<script>alert('Data Pembayaran Berhasil Diperbarui!'); window.location='index.php?open=pembayaran';</script>";
    } else {
        echo "<div style='color:red;'>Gagal memperbarui pembayaran: " . mysqli_error($koneksi) . "</div>";
    }
}

// Ambil data pembayaran berdasarkan ID
$queryData = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran = '$id'");
$data = mysqli_fetch_array($queryData);
?>

<h2><b>EDIT PEMBAYARAN SERVIS</b></h2>

<form action="index.php?open=edit_pembayaran&id=<?php echo $id; ?>" method="post">
  <!-- Hidden input untuk menyimpan ID pembayaran -->
  <input type="hidden" name="txtIdPembayaran" value="<?php echo isset($data['id_pembayaran']) ? $data['id_pembayaran'] : ''; ?>" />

  <table cellpadding="3" cellspacing="1" border="0">
    <tr>
      <td><b>Pilih Servis / Biaya</b></td>
      <td>:</td>
      <td>
        <select name="txtIdServis" required>
          <option value="">-- Pilih Data Servis & Biaya --</option>
          <?php
          $combo = mysqli_query($koneksi, "SELECT s.id_servis, s.tgl_servis, s.keluhan, s.biaya, k.no_plat, k.merk_tipe 
                                           FROM servis s 
                                           LEFT JOIN kendaraan k ON s.id_kendaraan = k.id_kendaraan 
                                           ORDER BY s.id_servis DESC");
          while ($row = mysqli_fetch_array($combo)) {
              $selected = ($row['id_servis'] == $data['id_servis']) ? "selected" : "";
              echo "<option value='" . $row['id_servis'] . "' $selected>" . $row['no_plat'] . " - " . $row['merk_tipe'] . " (Keluhan: " . $row['keluhan'] . " | Biaya: Rp " . number_format($row['biaya'], 0, ',', '.') . ")</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Tanggal Bayar</b></td>
      <td>:</td>
      <td><input type="date" name="txtTglBayar" value="<?php echo isset($data['tgl_bayar']) ? $data['tgl_bayar'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td><b>Jumlah Bayar (Rp)</b></td>
      <td>:</td>
      <td><input type="number" step="0.01" name="txtJumlahBayar" value="<?php echo isset($data['jumlah_bayar']) ? $data['jumlah_bayar'] : ''; ?>" required /></td>
    </tr>
    <tr>
      <td><b>Metode Pembayaran</b></td>
      <td>:</td>
      <td>
        <select name="txtMetode" required>
          <option value="Cash" <?php if(isset($data['metode_pembayaran']) && $data['metode_pembayaran'] == 'Cash') echo 'selected'; ?>>Cash</option>
          <option value="Transfer" <?php if(isset($data['metode_pembayaran']) && $data['metode_pembayaran'] == 'Transfer') echo 'selected'; ?>>Transfer</option>
          <option value="QRIS" <?php if(isset($data['metode_pembayaran']) && $data['metode_pembayaran'] == 'QRIS') echo 'selected'; ?>>QRIS</option>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Keterangan</b></td>
      <td>:</td>
      <td><textarea name="txtKeterangan" rows="3" cols="30"><?php echo isset($data['keterangan']) ? $data['keterangan'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value="Simpan Perubahan" />
        <a href="index.php?open=pembayaran"><input type="button" value="Batal" /></a>
      </td>
    </tr>
  </table>
</form>