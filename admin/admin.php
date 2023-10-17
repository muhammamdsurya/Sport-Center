<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
};

// Pagination
$jmlHalamanPerData = 5;
$jumlahData = count(query("SELECT * FROM admin_212279"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$admin = query("SELECT * FROM admin_212279 LIMIT $awalData, $jmlHalamanPerData");


if (isset($_POST["simpan"])) {
  if (tambahAdmin($_POST) > 0) {
    echo "<script>
  alert('Berhasil DiTambahkan');
</script>";
  } else {
    echo "<script>
  alert('Gagal DiTambahkan');
</script>";
  }
}

if (isset($_POST["edit"])) {
  if (editAdmin($_POST) > 0) {
    echo "<script>
  alert('Berhasil DiTambahkan');
</script>";
  } else {
    echo "<script>
  alert('Gagal DiTambahkan');
</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <title>Data Admin</title>
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
        <h3 class="judul">Data Admin</h3>
        <hr>
        <button class="btn btn-inti mt-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body">
                  <!-- konten form modal -->
                  <div class="row justify-content-center align-items-center">
                    <div class="col">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="212279_exampleInputPassword1">
                     </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No Hp</label>
                        <input type="number" name="hp" class="form-control" id="exampleInputPassword1">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputPassword1">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Modal Tambah -->
        <table class="table table-hover mt-3">
          <thead class="table-inti">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Username</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Email</th>
              <th scope="col">No Hp</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="text">
            <?php $i = 1; ?>
            <?php foreach ($admin as $row) : ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $row["212279_username"]; ?></td>
                <td><?= $row["212279_nama"]; ?></td>
                <td><?= $row["212279_email"]; ?></td>
                <td><?= $row["212279_no_handphone"]; ?> </td>
                <td>
                  <button class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#editModal<?= $row["212279_id_user"]; ?>">Edit</button>
                  <a href="./controller/hapusAdmin.php?id=<?= $row["212279_id_user"]; ?>" class="btn btn-danger">Hapus</a>
                </td>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $row["212279_id_user"]; ?>" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Admin <?= $row["212279_nama"]; ?></h5>
                      </div>
                      <form action="" method="post">
                        <input type="hidden" name="id" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_id_user"]; ?>>">
                        <div class="modal-body">
                          <!-- konten form modal -->
                          <div class="row justify-content-center align-items-center">
                            <div class="mb-3">
                              <img src="../img/futsal.jpg" alt="gambar lapangan" class="img-fluid">
                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_username"]; ?>">
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_password"]; ?>">
                              </div>
                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                                <input type="212279_nama" name="nama" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_nama"]; ?>">
                              </div>
                              <d212279_no_handiv class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_email"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">No Hp</label>
                              <input type="number" name="hp" class="form-control" id="exampleInputPassword1" value="<?= $row["212279_no_handphone"]; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="edit" id="edit">Simpan</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal Tambah -->
              </tr>
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