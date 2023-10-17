<?php
session_start();
require "../session.php";
require "../functions.php";

if ($role !== 'Admin') {
  header("location:../login.php");
}

// Pagination
$jmlHalamanPerData = 3;
$jumlahData = count(query("SELECT sewa_212279.212279_id_sewa,user_212279.212279_nama_lengkap,sewa_212279.212279_tanggal_pesan,sewa_212279.212279_jam_mulai,sewa_212279.212279_lama_sewa,sewa_212279.212279_total,bayar_212279.212279_bukti,bayar_212279.212279_konfirmasi
FROM sewa_212279
JOIN user_212279 ON sewa_212279.212279_id_user = user_212279.212279_id_user
JOIN bayar_212279 ON sewa_212279.212279_id_sewa = bayar_212279.212279_id_sewa"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$pesan = query("SELECT sewa_212279.212279_id_sewa,user_212279.212279_nama_lengkap,sewa_212279.212279_tanggal_pesan,sewa_212279.212279_jam_mulai,sewa_212279.212279_lama_sewa,sewa_212279.212279_total,bayar_212279.212279_bukti,bayar_212279.212279_konfirmasi
FROM sewa_212279
JOIN user_212279 ON sewa_212279.212279_id_user = user_212279.212279_id_user
JOIN bayar_212279 ON sewa_212279.212279_id_sewa = bayar_212279.212279_id_sewa LIMIT $awalData, $jmlHalamanPerData");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <title>Data Pesanan</title>
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
        <h3 class="judul">Data Pesanan</h3>
        <hr>
        <a href="export.php" class="btn btn-inti mt-5">Download</a>
        <table class="table table-hover mt-3">
          <thead class="table-inti">
            <tr>
              <th scope="col">No</th>
              <th scope="col">NamaCust</th>
              <th scope="col">TglPesan</th>
              <th scope="col">TglMain</th>
              <th scope="col">Lama</th>
              <th scope="col">Total</th>
              <th scope="col">Bukti</th>
              <th scope="col">Konfir</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="text">
            <?php $i = 1; ?>
            <?php foreach ($pesan as $row) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $row["212279_nama_lengkap"]; ?></td>
                <td><?= $row["212279_tanggal_pesan"]; ?></td>
                <td><?= $row["212279_jam_mulai"]; ?></td>
                <td><?= $row["212279_lama_sewa"]; ?></td>
                <td><?= $row["212279_total"]; ?></td>
                <td><img src="../img/<?= $row["212279_bukti"]; ?>" width="100" height="100"></td>
                <td><?= $row["212279_konfirmasi"]; ?></td>
                <td>
                  <?php
                  $id_sewa = $row["212279_id_sewa"];
                  if ($row["212279_konfirmasi"] == "Terkonfirmasi") {
                    // tampilkan tombol Bayar dan Hapus
                    echo '';
                  } else {
                    // tampilkan tombol Detail
                    echo ' <button type="button" class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#konfirmasiModal' . $id_sewa . '">
                    Konfir
                  </button>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal' . $id_sewa . '">
                    Hapus
                  </button>
                  ';
                  }
                  ?>
                </td>
              </tr>
              <!-- Modal Konfirmasi -->
              <div class="modal fade" id="konfirmasiModal<?= $row["212279_id_sewa"]; ?>" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pesanan <?= $row["212279_nama_lengkap"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin mengkonfirmasi pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/konfirmasiPesan.php?id=<?= $row["212279_id_sewa"]; ?>" class="btn btn-primary">Konfirmasi</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->

              <!-- Modal Hapus -->
              <div class="modal fade" id="hapusModal<?= $row["212279_id_sewa"]; ?>" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusModalLabel">Hapus Pesanan <?= $row["212279_nama_lengkap"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin menghapus pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/hapusPesan.php?id=<?= $row["212279_id_sewa"]; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->
            <?php endforeach; ?>
          </tbody>
        </table>

        <ul class="pagination">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Previous</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $jmlHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else : ?>
              <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $jmlHalaman) : ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>