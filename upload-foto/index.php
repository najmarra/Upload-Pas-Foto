<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Aplikasi CRUD + Upload Gambar dengan PHP</title>
</head>

<body>

<h1>Data Siswa</h1>

<a href="form_simpan.php">➕ Tambah Data</a>
<br><br>

<table border="1" width="100%" cellpadding="8" cellspacing="0">
  <tr>
    <th>Foto</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Telepon</th>
    <th>Alamat</th>
    <th colspan="2">Aksi</th>
  </tr>

<?php
include "koneksi.php";

$sql = $pdo->prepare("SELECT * FROM siswa");
$sql->execute();

while ($data = $sql->fetch()) {
?>
  <tr>
    <td align="center">
      <?php if (!empty($data['foto'])): ?>
        <img src="images/<?= $data['foto']; ?>" width="100" height="100">
      <?php else: ?>
        -
      <?php endif; ?>
    </td>

    <td><?= $data['nis']; ?></td>
    <td><?= $data['nama']; ?></td>
    <td><?= $data['jenis_kelamin']; ?></td>
    <td><?= $data['telp']; ?></td>
    <td><?= $data['alamat']; ?></td>

    <td align="center">
      <a href="form_ubah.php?id=<?= $data['id']; ?>">✏️ Ubah</a>
    </td>

    <td align="center">
      <a href="proses_hapus.php?id=<?= $data['id']; ?>"
         onclick="return confirm('Yakin ingin menghapus data ini?')">
         🗑️ Hapus
      </a>
    </td>
  </tr>
<?php
}
?>

</table>

</body>
</html>
