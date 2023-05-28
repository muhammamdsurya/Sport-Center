<!-- cek apakah sudah login -->
<?php

if (!isset($_SESSION['role'])) {
  header("location:login.php");
} else {
  $role = $_SESSION['role'];
}
?>