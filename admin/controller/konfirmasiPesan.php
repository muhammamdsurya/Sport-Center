<?php
require "../../functions.php";
$idsewa = $_GET["id"];

if (konfirmasi($idsewa) > 0) {
  echo "
  <script>
    alert('Data Berhasil DiKonfirmasi');
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
