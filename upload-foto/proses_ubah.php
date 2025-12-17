<?php
include "koneksi.php";

$id = $_GET['id'];

$nis           = $_POST['nis'];
$nama          = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp          = $_POST['telp'];
$alamat        = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

if (empty($foto)) {

  $sql = $pdo->prepare("
    UPDATE siswa SET
      nis = :nis,
      nama = :nama,
      jenis_kelamin = :jk,
      telp = :telp,
      alamat = :alamat
    WHERE id = :id
  ");

  $sql->execute([
    ':nis' => $nis,
    ':nama' => $nama,
    ':jk' => $jenis_kelamin,
    ':telp' => $telp,
    ':alamat' => $alamat,
    ':id' => $id
  ]);

  header("Location: index.php");
  exit;

} else {

  $fotobaru = date('dmYHis') . "_" . $foto;
  $path = "images/" . $fotobaru;

  if (!is_dir("images")) {
    mkdir("images", 0777, true);
  }

  if (move_uploaded_file($tmp, $path)) {

    $q = $pdo->prepare("SELECT foto FROM siswa WHERE id = :id");
    $q->execute([':id' => $id]);
    $data = $q->fetch();

    if ($data['foto'] && file_exists("images/" . $data['foto'])) {
      unlink("images/" . $data['foto']);
    }

    $sql = $pdo->prepare("
      UPDATE siswa SET
        nis = :nis,
        nama = :nama,
        jenis_kelamin = :jk,
        telp = :telp,
        alamat = :alamat,
        foto = :foto
      WHERE id = :id
    ");

    $sql->execute([
      ':nis' => $nis,
      ':nama' => $nama,
      ':jk' => $jenis_kelamin,
      ':telp' => $telp,
      ':alamat' => $alamat,
      ':foto' => $fotobaru,
      ':id' => $id
    ]);

    header("Location: index.php");
    exit;

  } else {
    echo "❌ Gagal upload foto";
  }
}
