<?php
require "../../config/config.php";
$buku = queryReadData("SELECT * FROM buku");

// mengaktifkan tombol search engine
if(isset($_POST["search"]) ) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $buku = search($_POST["keyword"]);
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Kelola buku || Admin</title>
  <style>
    .layout-card-custom {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
      gap: 1.5rem;
      justify-content: center;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary fixed-top py-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="https://upload.wikimedia.org/wikipedia/id/thumb/c/c7/AMIKOM_LOGO.svg/1200px-AMIKOM_LOGO.svg.png" alt="logo" width="120px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-primary" href="../dashboardAdmin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="tambahBuku.php">Tambah Buku</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>
<div class="container-fluid p-4 mt-5">
  <!-- Search Engine -->
  <form action="" method="post">
    <div class="input-group mb-3">
      <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Cari data buku...">
      <button class="btn btn-outline-secondary" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </form>

  <!-- Card Buku -->
  <div class="layout-card-custom">
    <?php foreach ($buku as $item) : ?>
      <div class="card" style="width: 15rem;">
        <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
        <div class="card-body">
          <h5 class="card-title"><?= $item["judul"]; ?></h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Kategori: <?= $item["kategori"]; ?></li>
          <li class="list-group-item">ID Buku: <?= $item["id_buku"]; ?></li>
        </ul>
        <div class="card-body">
          <a class="btn btn-success" href="updateBuku.php?idReview=<?= $item["id_buku"]; ?>" id="review">Edit</a>
          <a class="btn btn-danger" href="deleteBuku.php?id=<?= $item["id_buku"]; ?>" onclick="return confirm('Yakin ingin menghapus data buku?');">Delete</a>
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
