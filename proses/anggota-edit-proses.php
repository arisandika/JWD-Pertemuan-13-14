<?php
include "../connect.php";

if (isset($_POST['simpan'])) {
  $id_anggota = $_POST['id_anggota'];
  $nama = $_POST['nama'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];

  $foto = $_FILES['foto'];
  if ($foto['error'] === UPLOAD_ERR_OK) {
    $nama_file = $foto['name'];
    $lokasi_file = $foto['tmp_name'];
    $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
    $file_foto = $id_anggota . "." . $tipe_file;

    $folder = "../images/$file_foto";
    if (!move_uploaded_file($lokasi_file, $folder)) {
      echo "Failed to move the uploaded image.";
      exit;
    }
  } else {
    $file_foto = $foto_awal;
  }

  $query = "UPDATE tbanggota SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto='$file_foto' WHERE id_anggota='$id_anggota'";
  if (mysqli_query($db, $query)) {
    header("Location: ../index.php?p=anggota");
    exit;
  } else {
    echo "Failed to update member data.";
    exit;
  }
}
?>