<?php
require "../../functions.php";
$id_sewa = $_GET["id"];

if (hapusPesan($id_sewa) > 0) {
  echo "
  <script>
    alert('Data Berhasil Dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Data Gagal Dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
}
