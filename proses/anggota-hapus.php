<?php
include "../connect.php";

function deleteAnggota($id_anggota)
{
  global $db;

  // Perform the delete operation in the database
  $sql = "DELETE FROM tbanggota WHERE id_anggota = '$id_anggota'";
  $query = mysqli_query($db, $sql);

  return $query;
}

if (isset($_GET['id'])) {
  $id_anggota = $_GET['id'];

  if (isset($_GET['confirm'])) {
    // User confirmed the deletion, proceed with deletion
    $result = deleteAnggota($id_anggota);
    if ($result) {
      // Deletion successful
      header("Location: ../index.php?p=anggota&delete_success=true");
      exit();
    } else {
      // Error occurred during deletion
      header("Location: ../index.php?p=anggota&delete_error=true");
      exit();
    }
  } else {
    // Display the confirmation dialog
    echo '<script>
            if (confirm("Are you sure you want to delete this data?")) {
                window.location.href = "anggota-hapus.php?id=' . $id_anggota . '&confirm=true";
            } else {
                window.location.href = "../index.php?p=anggota";
            }
        </script>';
    exit();
  }
} else {
  // Redirect back to the member list page if the 'id' parameter is not provided
  header("Location: ../index.php?p=anggota");
  exit();
}
?>