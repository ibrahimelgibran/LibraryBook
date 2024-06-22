<?php 
require "../../config/config.php";
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Detail Buku || Member</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #6c757d;
    }

    .navbar-brand img {
      max-height: 40px;
    }

    .btn-tertiary {
      background-color: #6c757d;
      color: white;
      border: none;
    }

    .card {
      width: 18rem;
      border: none;
      background-color: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
      object-fit: cover;
      height: 250px;
    }

    .card-body {
      padding: 1rem;
    }

    .card-title {
      font-weight: bold;
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .list-group-item {
      border-color: rgba(0, 0, 0, 0.125);
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
      color: white;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
      color: white;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }

    .bg-subtle {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
    <div class="container-fluid p-3">
      <a class="navbar-brand" href="#">
        <img src="../../assets/logo.png" alt="logo" width="100%">
      </a>
      <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
    </div>
  </nav>

  <div class="p-4 mt-5">
    <h2 class="mt-5">Detail Buku</h2>
    <div class="d-flex justify-content-center">
      <?php foreach ($query as $item) : ?>
        <div class="card">
          <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku">
          <div class="card-body">
            <h5 class="card-title"><?= $item["judul"]; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Id Buku : <?= $item["id_buku"]; ?></li>
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
            <li class="list-group-item">Pengarang : <?= $item["pengarang"]; ?></li>
            <li class="list-group-item">Penerbit : <?= $item["penerbit"]; ?></li>
            <li class="list-group-item">Tahun terbit : <?= $item["tahun_terbit"]; ?></li>
            <li class="list-group-item">Jumlah halaman : <?= $item["jumlah_halaman"]; ?></li>
            <li class="list-group-item">Deskripsi buku : <?= $item["buku_deskripsi"]; ?></li>
          </ul>
          <div class="card-body">
            <a href="daftarBuku.php" class="btn btn-danger">Batal</a>
            <a href="../formPeminjaman/pinjamBuku.php?id=<?= $item["id_buku"]; ?>" class="btn btn-success">Pinjam</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <footer class="shadow-lg bg-subtle p-3">
    <div class="container-fluid d-flex justify-content-between">
    <p class="mt-2">made with 💙 by <span class="text-primary"> iegcode</span></p>
    <p class="mt-2">versi 1.0</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
