<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";
$idPeminjaman = $_GET["id"];
$query = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, peminjaman.id_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
WHERE peminjaman.id_peminjaman = $idPeminjaman");

// Jika tombol submit kembalikan diklik
if(isset($_POST["kembalikan"])) {
  
  if(pengembalian($_POST) > 0) {
    echo "<script>
    alert('Terimakasih telah mengembalikan buku!');
    window.location.href = 'TransaksiPeminjaman.php';
    </script>";
  } else {
    echo "<script>
    alert('Buku gagal dikembalikan');
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pengembalian Buku || Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <style>
    .navbar {
      background-color: #6c757d; /* Warna navbar */
    }
    .navbar-brand img {
      max-height: 40px; /* Ukuran logo navbar */
    }
    .btn-tertiary {
      background-color: #f8f9fa !important; /* Warna tombol dashboard */
      border-color: #ced4da !important; /* Warna border tombol dashboard */
      color: #343a40 !important; /* Warna teks tombol dashboard */
    }
    .card {
      background-color: #ffffff; /* Warna latar belakang card */
      border: 1px solid #ced4da; /* Warna border card */
      border-radius: 10px; /* Radius sudut card */
    }
  </style>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../../assets/logo.png" alt="logo" width="50px">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>
<div class="container mt-5">
  <div class="card p-4">
    <form action="" method="post">
      <h3 class="mb-4">Form Pengembalian Buku</h3>
      <?php foreach ($query as $item) : ?>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="<?= $item["id_peminjaman"]; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="id_buku" class="form-label">ID Buku</label>
            <input type="text" class="form-control" id="id_buku" name="id_buku" value="<?= $item["id_buku"]; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= $item["judul"]; ?>" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="nisn" class="form-label">NISN Siswa</label>
            <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $item["nisn"]; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $item["nama"]; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="id_admin" class="form-label">ID Admin Perpustakaan</label>
            <input type="text" class="form-control" id="id_admin" name="id_admin" value="<?= $item["id_admin"]; ?>" readonly>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="tgl_peminjaman" class="form-label">Tanggal Peminjaman</label>
            <input type="date" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman" value="<?= $item["tgl_peminjaman"]; ?>" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="tgl_pengembalian" class="form-label">Tenggat Pengembalian</label>
            <input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" value="<?= $item["tgl_pengembalian"]; ?>" readonly>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="buku_kembali" class="form-label">Tanggal Pengembalian Buku</label>
            <input type="date" class="form-control" id="buku_kembali" name="buku_kembali" value="<?php echo date('Y-m-d'); ?>" oninput="hitungDenda()">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="keterlambatan" class="form-label">Keterlambatan (Hari)</label>
            <input type="text" class="form-control" id="keterlambatan" name="keterlambatan" readonly>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="denda" class="form-label">Denda</label>
            <input type="number" class="form-control" id="denda" name="denda" readonly>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-success" name="kembalikan">Kembalikan</button>
        <a href="TransaksiPeminjaman.php" class="btn btn-danger">Batal</a>
      </div>
      <?php endforeach; ?>
    </form>
  </div>
</div>
<br><br><br>
<footer class="fixed-bottom shadow-lg bg-light p-2">
  <div class="container-fluid d-flex justify-content-between">
  <p class="mt-2">made with 💙 by <span class="text-primary"> iegcode</span></p>
      <p class="mt-2">versi 1.0</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../../style/js/script.js"></script>
</body>
</html>
