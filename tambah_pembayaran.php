<?php
include "koneksi.php";

// Jika tombol simpan diklik
if (isset($_POST['btnSimpan'])) {
    $id_servis         = $_POST['txtIdServis'];
    $tgl_bayar         = $_POST['txtTglBayar'];
    $jumlah_bayar      = $_POST['txtJumlahBayar'];
    $metode_pembayaran = $_POST['txtMetode'];
    $keterangan        = $_POST['txtKeterangan'];

    $queryInsert = "INSERT INTO pembayaran (id_servis, tgl_bayar, jumlah_bayar, metode_pembayaran, keterangan) 
                    VALUES ('$id_servis', '$tgl_bayar', '$jumlah_bayar', '$metode_pembayaran', '$keterangan')";
    
    $simpan = mysqli_query($koneksi, $queryInsert);

    if ($simpan) {
        echo "<script>alert('Pembayaran Berhasil Disimpan!'); window.location='index.php?open=pembayaran';</script>";
    } else {
        echo "<div style='color:red;'>Gagal menyimpan pembayaran: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<h2><b>TAMBAH PEMBAYARAN SERVIS</b></h2>

<form action="index.php?open=tambah_pembayaran" method="post">
  <table cellpadding="3" cellspacing="1" border="0">
    <tr>
      <td><b>Pilih Servis / Biaya</b></td>
      <td>:</td>
      <td>
        <select name="txtIdServis" required>
          <option value="">-- Pilih Data Servis & Biaya --</option>
          <?php
          // Mengambil data servis yang digabung dengan kendaraan untuk ditampilkan di pilihan
          $combo = mysqli_query($koneksi, "SELECT s.id_servis, s.tgl_servis, s.keluhan, s.biaya, k.no_plat, k.merk_tipe 
                                           FROM servis s 
                                           LEFT JOIN kendaraan k ON s.id_kendaraan = k.id_kendaraan 
                                           ORDER BY s.id_servis DESC");
          while ($row = mysqli_fetch_array($combo)) {
              echo "<option value='" . $row['id_servis'] . "'>" . $row['no_plat'] . " - " . $row['merk_tipe'] . " (Keluhan: " . $row['keluhan'] . " | Biaya: Rp " . number_format($row['biaya'], 0, ',', '.') . ")</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Tanggal Bayar</b></td>
      <td>:</td>
      <td><input type="date" name="txtTglBayar" value="<?php echo date('Y-m-d'); ?>" required /></td>
    </tr>
    <tr>
      <td><b>Jumlah Bayar (Rp)</b></td>
      <td>:</td>
      <td><input type="number" step="0.01" name="txtJumlahBayar" placeholder="Masukkan jumlah bayar" required /></td>
    </tr>
    <tr>
      <td><b>Metode Pembayaran</b></td>
      <td>:</td>
      <td>
        <select name="txtMetode" required>
          <option value="Cash">Cash</option>
          <option value="Transfer">Transfer</option>
          <option value="QRIS">QRIS</option>
        </select>
      </td>
    </tr>
    <tr>
      <td><b>Keterangan</b></td>
      <td>:</td>
      <td><textarea name="txtKeterangan" rows="3" cols="30" placeholder="Lunas / Keterangan lain..."></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="btnSimpan" value="Simpan Pembayaran" />
        <a href="index.php?open=pembayaran"><input type="button" value="Batal" /></a>
      </td>
    </tr>
  </table>
</form>