<?php
session_start();
require "../session.php";
require "../functions.php";

if ($role !== 'Admin') {
  header("location:../login.php");
}

$pesan = query("SELECT sewa_212279.212279_id_sewa,user_212279.212279_nama_lengkap,sewa_212279.212279_tanggal_pesan,sewa_212279.212279_jam_mulai,sewa_212279.212279_lama_sewa,sewa_212279.212279_total,bayar_212279.212279_bukti,bayar_212279.212279_konfirmasi
FROM sewa_212279
JOIN user_212279 ON sewa_212279.212279_id_user = user_212279.212279_id_user
JOIN bayar_212279 ON sewa_212279.212279_id_sewa = bayar_212279.212279_id_sewa
");

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

  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="col-12 p-5 mt-5">
        <!-- Konten -->
        <h3 class="judul text-center">Data Pesanan</h3>
        <hr>
        <table class="table table-hover mt-3">
          <thead class="table-inti">
            <tr>
              <th scope="col">Id</th>
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
<td><?= $row["212279_tanggal_pesan"];?></td>
 <td><?= $row["212279_jam_mulai"]; ?></td>
                <td><?= $row["212279_lama_sewa"]; ?></td>
                <td><?= $row["212279_total"]; ?></td>
                <td><img src="../img/<?= $row["212279_bukti"]; ?>" width="100" height="100"></td>
                <td><?= $row["212279_konfirmasi"]; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <?php
      require_once __DIR__ . '/vendor/autoload.php'; // path ke autoload.php di folder vendor

      use Dompdf\Dompdf;

      // Membuat objek Dompdf
      $dompdf = new Dompdf();

      // Mengambil isi file DataPesanan.php
      $html = ob_get_clean();

      // Mengubah HTML menjadi PDF
      $dompdf->loadHtml($html);

      // Mengatur ukuran dan orientasi kertas
      $dompdf->setPaper('A4', 'landscape');

      // Render HTML sebagai PDF
      $dompdf->render();

      // Menghasilkan PDF dan menampilkannya di browser
      $dompdf->stream("DataPesanan.pdf", array("Attachment" => false));
      ?>

</body>


</html>