<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusPesan($id_user) > 0) {
  echo "
  <script>
    alert('Data Berhasil Dihapus');
    document.location.href = '../bayar.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Data Gagal Dihapus');
    document.location.href = '../bayar.php'; 
  </script>
  ";
}
