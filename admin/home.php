<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
}

$lapangan = query("SELECT COUNT(212279_id_lapangan) AS jml_lapangan FROM lapangan_212279")[0];
$pesanan = query("SELECT COUNT(212279_id_bayar) AS jml_sewa FROM bayar_212279")[0];
$user = query("SELECT COUNT(212279_id_user) AS jml_user FROM user_212279")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <title>Home</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="sidebar col-2 bg-secondary">
        <!-- Sidebar -->
        <h5 class="mt-5 judul text-center"><?= $_SESSION["username"]; ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent"><a href="home.php">Home</a></li>
          <li class="list-group-item bg-transparent"><a href="member.php">Data Member</a></li>
          <li class="list-group-item bg-transparent"><a href="lapangan.php">Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a href="pesan.php">Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a href="admin.php">Data Admin</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a href="../logout.php" class="mt-5 btn btn-inti text-dark">Logout</a>
      </div>
      <div class="col-10 p-5 mt-5">
        <!-- Konten -->
        <h3 class="judul">Home</h3>
        <hr>
        <div class="row row-cols-1 row-cols-md-4 g-3 justify-content-center my-5 gap-3">
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/futsal.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Lapangan</h5>
                <h2 class="card-text text-center"><?= $lapangan["jml_lapangan"]; ?></h2>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/badmintoon.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Pesanan</h5>
                <h2 class="card-text text-center"><?= $pesanan["jml_sewa"]; ?></h2>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card align-items-center">
              <img src="../img/basket.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Jumlah Member</h5>
                <h2 class="card-text text-center"><?= $user["jml_user"]; ?></h2>
              </div>
            </div>
          </div>
        </div>
        <div class="announcement">
          <h3 class="judul">Pengumuman</h3>
          <hr>
          <div class="text p-2 mb-2">
            <p>Perubahan Jadwal Olahraga <br> <br> Kepada seluruh member Sport Center. <br>
              Kami ingin memberitahukan bahwa terdapat perubahan jadwal olahraga di Sport Center. Mulai hari senin, 29 april 2023. Berikut adalah perubahan jadwal: <br> <br>
              1. Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
              2. Lorem ipsum dolor sit amet. <br>
              3. Cum, vel dolores sed ab delectus repellat laboriosam. <br>
              Mohon maaf atas ketidaknyamanan yang ditimbulkan dan terimakasih atas perhatiannya. <br> <br>
              Salam Olahraga <br>
              Sport Center
            </p>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>