<?php
include "koneksi.php";
?>

<h2><b>DATA KENDARAAN</b></h2>

<a href="index.php?open=tambah_kendaraan">[ + ] Tambah Data</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
<thead>
    <tr bgcolor="#006699" style="color:white;">
        <th>No</th>
        <th>ID Pelanggan</th>
        <th>No Plat</th>
        <th>Merk / Type</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php
$query = "SELECT * FROM kendaraan ORDER BY id_kendaraan DESC";
$result = mysqli_query($koneksi, $query);
$no = 1;

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td align="center"><?php echo $data['id_pelanggan']; ?></td>
            <td><?php echo $data['no_plat']; ?></td>
            <td><?php echo $data['merk_tipe']; ?></td>
            <td align="center">
                <a href="index.php?open=edit_kendaraan&id=<?php echo $data['id_kendaraan']; ?>">Edit</a> | 
                <a href="index.php?open=hapus_kendaraan&id=<?php echo $data['id_kendaraan']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='5' align='center'>Belum ada data kendaraan.</td></tr>";
}
?>
</tbody>
</table>