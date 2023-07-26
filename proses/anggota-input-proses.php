<?php
include "../connect.php";

$id_anggota = $_POST['id_anggota'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$status = "Tidak Meminjam";

if (isset($_POST['simpan'])) {
  extract($_POST);
  $nama_file = $_FILES['foto']['name'];
  if (!empty($nama_file)) {
    $lokasi_file = $_FILES['foto']['tmp_name'];
    $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
    $file_foto = $id_anggota . "." . $tipe_file;

    $folder = "../images/$file_foto";
    move_uploaded_file($lokasi_file, "$folder");
    $image = imagecreatefromstring(file_get_contents($folder));
    $width = imagesx($image);
    $height = imagesy($image);
    $size = min($width, $height);
    $new_image = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
    if ($new_image !== false) {
      imagejpeg($new_image, $folder);
      imagedestroy($new_image);
    }
    imagedestroy($image);
  } else {
    $file_foto = "-";

  }
  $sql = "INSERT INTO tbanggota (id_anggota, nama, jenis_kelamin, alamat, status, foto) 
  VALUES ('$id_anggota', '$nama', '$jenis_kelamin', '$alamat', '$status', '$file_foto')";
  $query = mysqli_query($db, $sql);
  header("Location: ../index.php?p=anggota");}




?>