<?php
include "koneksi.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT foto FROM siswa WHERE id = :id");
$sql->execute([':id' => $id]);
$data = $sql->fetch();

if (!empty($data['foto']) && file_exists("images/" . $data['foto'])) {
  unlink("images/" . $data['foto']);
}

$sql = $pdo->prepare("DELETE FROM siswa WHERE id = :id");
$execute = $sql->execute([':id' => $id]);

if ($execute) {
  header("Location: index.php");
  exit;
} else {
  echo "❌ Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
