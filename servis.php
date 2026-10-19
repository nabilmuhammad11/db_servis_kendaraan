<?php
include "koneksi.php";
?>

<h2><b>DATA SERVIS KENDARAAN</b></h2>

<a href="index.php?open=tambah_servis">[ + ] Tambah Data Servis</a>
<br><br>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
<thead>
    <tr bgcolor="#CCCCCC">
        <th>No</th>
        <th>Kendaraan</th>
        <th>Tanggal Servis</th>
        <th>Keluhan</th>
        <th>Biaya</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php
$query = "SELECT s.*, k.no_plat, k.merk_tipe 
          FROM servis s 
          LEFT JOIN kendaraan k ON s.id_kendaraan = k.id_kendaraan 
          ORDER BY s.id_servis DESC";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td><?php echo $data['no_plat'] . " (" . $data['merk_tipe'] . ")"; ?></td>
            <td><?php echo $data['tgl_servis']; ?></td>
            <td><?php echo $data['keluhan']; ?></td>
            <td align="right">Rp <?php echo number_format($data['biaya'], 0, ',', '.'); ?></td>
            <td align="center">
                <a href="index.php?open=edit_servis&id=<?php echo $data['id_servis']; ?>">Edit</a> |
                <a href="index.php?open=hapus_servis&id=<?php echo $data['id_servis']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='6' align='center'>Data servis belum ada.</td></tr>";
}
?>
</tbody>
</table>