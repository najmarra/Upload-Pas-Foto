<?php
include "koneksi.php";

$id = $_GET['id'] ?? 0;

$sql = $pdo->prepare("SELECT * FROM siswa WHERE id = :id");
$sql->execute([':id' => $id]);
$data = $sql->fetch(PDO::FETCH_ASSOC);

if (!$data) {
  echo "Data tidak ditemukan";
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ubah Data Siswa</title>
</head>
<body>

<h1>Ubah Data Siswa</h1>

<form method="post" action="proses_ubah.php?id=<?= $id ?>" enctype="multipart/form-data">
<table cellpadding="8">

<tr>
  <td>NIS</td>
  <td><input type="text" name="nis" value="<?= $data['nis'] ?>"></td>
</tr>

<tr>
  <td>Nama</td>
  <td><input type="text" name="nama" value="<?= $data['nama'] ?>"></td>
</tr>

<tr>
  <td>Jenis Kelamin</td>
  <td>
    <label>
      <input type="radio" name="jenis_kelamin" value="Laki-laki"
        <?= $data['jenis_kelamin']=="Laki-laki"?'checked':'' ?>> Laki-laki
    </label>
    <label>
      <input type="radio" name="jenis_kelamin" value="Perempuan"
        <?= $data['jenis_kelamin']=="Perempuan"?'checked':'' ?>> Perempuan
    </label>
  </td>
</tr>

<tr>
  <td>Telepon</td>
  <td><input type="text" name="telp" value="<?= $data['telp'] ?>"></td>
</tr>

<tr>
  <td>Alamat</td>
  <td><textarea name="alamat"><?= $data['alamat'] ?></textarea></td>
</tr>

<tr>
  <td>Foto</td>
  <td>
    <input type="file" name="foto"><br>
    <small>Foto lama:</small><br>
    <img src="images/<?= $data['foto'] ?>" width="100">
  </td>
</tr>

</table>

<hr>
<input type="submit" value="Ubah">
<a href="index.php"><input type="button" value="Batal"></a>
</form>

</body>
</html>
