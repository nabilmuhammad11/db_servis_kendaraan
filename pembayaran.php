<?php
include "koneksi.php";
?>

<h2><b>DATA PEMBAYARAN SERVIS</b></h2>

<a href="index.php?open=tambah_pembayaran">[ + ] Tambah Pembayaran</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
<thead>
    <tr bgcolor="#CCCCCC">
        <th>No</th>
        <th>Tanggal Bayar</th>
        <th>Kendaraan (No Plat)</th>
        <th>Keluhan Servis</th>
        <th>Jumlah Bayar</th>
        <th>Metode</th>
        <th>Keterangan</th>
        <th width="120">Aksi</th>
    </tr>
</thead>
<tbody>
<?php
$query = "SELECT p.*, s.tgl_servis, s.keluhan, k.no_plat, k.merk_tipe 
          FROM pembayaran p 
          JOIN servis s ON p.id_servis = s.id_servis 
          JOIN kendaraan k ON s.id_kendaraan = k.id_kendaraan 
          ORDER BY p.id_pembayaran DESC";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td align="center"><?php echo $data['tgl_bayar']; ?></td>
            <td><?php echo $data['no_plat'] . " (" . $data['merk_tipe'] . ")"; ?></td>
            <td><?php echo $data['keluhan']; ?></td>
            <td align="right">Rp <?php echo number_format($data['jumlah_bayar'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo $data['metode_pembayaran']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td align="center" style="white-space: nowrap;">
                <a href="index.php?open=edit_pembayaran&id=<?php echo $data['id_pembayaran']; ?>">Edit</a> 
                | 
                <a href="index.php?open=hapus_pembayaran&id=<?php echo $data['id_pembayaran']; ?>" onclick="return confirm('Yakin ingin menghapus data pembayaran ini?')">Hapus</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='8' align='center'>Belum ada data pembayaran.</td></tr>";
}
?>
</tbody>
</table>