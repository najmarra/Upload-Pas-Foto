<?php
include "koneksi.php";

$nis            = $_POST['nis'];
$nama           = $_POST['nama'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$telp           = $_POST['telp'];
$alamat         = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

$folder = "images/";
if (!is_dir($folder)) {
  mkdir($folder, 0777, true);
}

$fotobaru = date('dmYHis') . "_" . basename($foto);
$path = $folder . $fotobaru;

if (move_uploaded_file($tmp, $path)) {

  $sql = $pdo->prepare("
    INSERT INTO siswa 
    (nis, nama, jenis_kelamin, telp, alamat, foto)
    VALUES 
    (:nis, :nama, :jenis_kelamin, :telp, :alamat, :foto)
  ");

  $sql->execute([
    ':nis' => $nis,
    ':nama' => $nama,
    ':jenis_kelamin' => $jenis_kelamin,
    ':telp' => $telp,
    ':alamat' => $alamat,
    ':foto' => $fotobaru
  ]);

  header("Location: index.php");
  exit;

} else {
  echo "❌ Maaf, Gambar gagal diupload.";
  echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
?>
