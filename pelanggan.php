<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
?>

<h2>DATA PELANGGAN</h2>

<a href="?open=tambah_pelanggan" class="btn-tambah">+ Tambah Pelanggan</a>

<table>
    <tr>
        <th width="50" style="text-align: center;">No</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th width="140" style="text-align: center;">Aksi</th>
    </tr>

    <?php
    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td align="center"><?php echo $no++; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['no_hp']; ?></td>
        <td align="center">
            <a href="?open=edit_pelanggan&id_pelanggan=<?php echo $data['id_pelanggan']; ?>" class="btn-edit">Edit</a> | 
            <a href="?open=hapus_pelanggan&id_pelanggan=<?php echo $data['id_pelanggan']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>