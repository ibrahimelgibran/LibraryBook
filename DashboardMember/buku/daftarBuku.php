<?php
session_start();

if (!isset($_SESSION["signIn"])) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}

require "../../config/config.php";

// query read semua buku
$buku = queryReadData("SELECT * FROM buku");

// search buku
if (isset($_POST["search"])) {
  $buku = search($_POST["keyword"]);
}

// read buku berdasarkan kategori
if (isset($_POST["kategori"])) {
  $kategori = $_POST["kategori"];
  if ($kategori === "semua") {
    $buku = queryReadData("SELECT * FROM buku");
  } else {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = '$kategori'");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Daftar Buku || Member</title>
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

    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }

    .card {
      width: 15rem;
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
    <!-- Btn filter data kategori buku -->
    <div class="d-flex gap-2 mt-5 justify-content-center">
      <form action="" method="post">
        <div class="layout-card-custom">
          <button class="btn btn-primary" type="submit" name="kategori" value="semua">Semua</button>
          <button type="submit" class="btn btn-outline-primary" name="kategori" value="informatika">Informatika</button>
          <button type="submit" class="btn btn-outline-primary" name="kategori" value="bisnis">Bisnis</button>
          <button type="submit" class="btn btn-outline-primary" name="kategori" value="filsafat">Filsafat</button>
          <button type="submit" class="btn btn-outline-primary" name="kategori" value="novel">Novel</button>
          <button type="submit" class="btn btn-outline-primary" name="kategori" value="sains">Sains</button>
        </div>
      </form>
    </div>

    <form action="" method="post" class="mt-5">
      <div class="input-group d-flex justify-content-end mb-3">
        <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="Cari judul atau kategori buku...">
        <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </form>

    <!-- Card buku -->
    <div class="layout-card-custom">
      <?php foreach ($buku as $item) : ?>
        <div class="card">
          <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku">
          <div class="card-body">
            <h5 class="card-title"><?= $item["judul"]; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
          </ul>
          <div class="card-body">
            <a class="btn btn-success" href="detailBuku.php?id=<?= $item["id_buku"]; ?>">Detail</a>
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
