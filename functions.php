<?php

$conn = mysqli_connect("localhost", "root", "", "dbfutsal");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function hapusMember($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM user_212279 WHERE 212279_id_user = $id");

  return mysqli_affected_rows($conn);
}

function hapusLpg($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM lapangan_212279 WHERE 212279_id_lapangan = $id");

  return mysqli_affected_rows($conn);
}

function hapusAdmin($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM admin_212279 WHERE 212279_id_user = $id");

  return mysqli_affected_rows($conn);
}

function hapusPesan($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM sewa_212279 WHERE 212279_id_sewa = $id");

  return mysqli_affected_rows($conn);
}

function daftar($data)
{
  global $conn;

  $username = strtolower(stripslashes($data["email"]));
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone = $data["hp"];
  $alamat = $data["alamat"];
  $gender = $data["gender"];
  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }

  $result = mysqli_query($conn, "SELECT 212279_email FROM user_212279 WHERE 212279_email = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar!');
        </script>";
    return false;
  }
  mysqli_query($conn, "INSERT INTO user_212279 (212279_email,212279_password,212279_no_handphone,212279_jenis_kelamin,212279_nama_lengkap,212279_alamat,212279_foto) VALUES ('$username','$password','$no_handphone','$gender','$nama','$alamat','$upload')");
  return mysqli_affected_rows($conn);
}

function edit($data)
{
  global $conn;

  $userid = $_SESSION["id_user"];
  $username = strtolower(stripslashes($data["email"]));
  $nama = $data["nama_lengkap"];
  $no_handphone = $data["hp"];
  $gender = $data["jenis_kelamin"];
  $gambar = $data["foto"];
  $gambarLama = $data["fotoLama"];
 
  // Cek apakah User pilih gambar baru
  if ($_FILES["foto"]["error"] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  $query = "UPDATE user_212279 SET 212279_email = '$username', 
  212279_nama_lengkap = '$nama',
  212279_no_handphone = '$no_handphone',
  212279_jenis_kelamin = '$gender',
  212279_foto = '$gambar'
  WHERE 212279_id_user = '$userid'
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function pesan($data)
{
  global $conn;

  $userid = $_SESSION["id_user"];
  $idlpg = $data["id_lpg"];
  $lama =  $data["jam_mulai"];
  $mulai = $data["tgl_main"];
  $mulai_waktu = strtotime($mulai); // mengubah format datetime-local menjadi format UNIX timestamp
  $habis_waktu = $mulai_waktu + (intval($lama) * 3600); // menambahkan waktu dalam menit ke waktu awal
  $habis = date('Y-m-d\TH:i', $habis_waktu); // mengubah format waktu kembali ke datetime-local
  $habis_datetime_local = date('Y-m-d\TH:i:s', strtotime($habis)); // mengubah format waktu dari Y-m-d\TH:i ke format datetime-local
  $habis = $habis_datetime_local; // menyimpan hasil ke dalam variabel $habis_datetime_local
  $harga = $data["harga"];
  $total = date("H", strtotime($lama)) * $harga;

  mysqli_query($conn, "INSERT INTO sewa_212279 (212279_id_user, 212279_id_lapangan,212279_lama_sewa,212279_jam_mulai,212279_jam_habis,212279_harga,212279_total) VALUES ('$userid','$idlpg','$lama','$mulai','$habis','$harga','$total') ");

  return mysqli_affected_rows($conn);
}

function bayar($data)
{
  global $conn;
  $id_sewa = $data["212279_id_sewa"];

  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }

  mysqli_query($conn, "INSERT INTO bayar_212279 (212279_id_sewa,212279_bukti,212279_konfirmasi) VALUES ('$id_sewa','$upload','Sudah Bayar')");

  return mysqli_affected_rows($conn);
}

function tambahLpg($data)
{
  global $conn;

  $lapangan_212279 = $data["lapangan"];
  $harga = $data["harga"];

  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }


  $query = "INSERT INTO lapangan_212279 (212279_nama,212279_harga,212279_foto) VALUES ('$lapangan_212279','$harga','$upload')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  // Cek apakah tidak ada gambar yang di upload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  // Cek apakah gambar
  $extensiValid = ['jpg', 'png', 'jpeg'];
  $extensiGambar = explode('.', $namaFile);
  $extensiGambar = strtolower(end($extensiGambar));

  if (!in_array($extensiGambar, $extensiValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar!');
    </script>";
    return false;
  }

  if ($ukuranFile > 1000000) {
    echo "<script>
    alert('Ukuran Gambar Terlalu Besar!');
    </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $extensiGambar;
  // Move File
  move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
  return $namaFileBaru;
}

function editLpg($data)
{
  global $conn;

  $id = $data["idlap"];
  $lapangan_212279 = $data["lapangan"];
  $ket = $data["ket"];
  $harga = $data["harga"];
  $gambarLama =  $data["fotoLama"];

  // Cek apakah User pilih gambar baru
  if ($_FILES["foto"]["error"] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }


  $query = "UPDATE lapangan_212279 SET 
  212279_nama = '$lapangan_212279',
  212279_keterangan = '$ket',
  212279_harga = '$harga',
  212279_foto = '$gambar' WHERE 212279_id_lapangan = '$id'
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}


function tambahAdmin($data)
{
  global $conn;

  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone= $data["hp"];
  $email = $data["email"];

  $query = "INSERT INTO admin_212279 (212279_username,212279_password,212279_nama,212279_no_handphone,212279_email) VALUES ('$username','$password','$nama','$no_handphone','$email')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function editAdmin($data)
{
  global $conn;

  $id = $data["id"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone= $data["hp"];
  $email = $data["email"];

  $query = "UPDATE admin_212279 SET 
  212279_username = '$username',
  212279_password = '$password',
  212279_nama = '$nama',
  212279_no_handphone = '$no_handphone',
  212279_email  = '$email' WHERE 212279_id_user = '$id'
  
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function konfirmasi($id_sewa)
{
  global $conn;

  $id = $id_sewa;

  mysqli_query($conn, "UPDATE bayar_212279 set 212279_konfirmasi = ('Terkonfirmasi') WHERE 212279_id_sewa = '$id'");
  return mysqli_affected_rows($conn);
}
