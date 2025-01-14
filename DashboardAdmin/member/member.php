<?php
session_start();

if (!isset($_SESSION["signIn"])) {
  header("Location: ../../sign/admin/sign_in.php");
  exit;
}

require "../../config/config.php";

$member = queryReadData("SELECT * FROM member");

if (isset($_POST["search"])) {
  $member = searchMember($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Member terdaftar</title>
  <style>
    .action {
      display: flex;
      justify-content: center;
      gap: 5px;
    }
  </style>
</head>
<body>
<nav class="navbar fixed-top bg-body-tertiary shadow-sm py-0">
  <div class="container-fluid p-1">
    <a class="navbar-brand" href="#">
      <img src="https://upload.wikimedia.org/wikipedia/id/thumb/c/c7/AMIKOM_LOGO.svg/1200px-AMIKOM_LOGO.svg.png" alt="logo" width="120px">
    </a>
    <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
  </div>
</nav>
<br><br>
<div class="container-fluid p-4 mt-5">
  <!--search engine --->
  <form action="" method="post">
    <div class="input-group mb-3">
      <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Cari data member...">
      <button class="btn btn-outline-secondary" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead class="bg-primary text-light">
      <tr>
        <th>NIM - 4 DIGIT AKHIR</th>
        <th>TAHUN MASUK</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No Telepon</th>
        <th>Pendaftaran</th>
        <th>Delete</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($member as $item) : ?>
        <tr>
          <td><?= $item["nisn"]; ?></td>
          <td><?= $item["kode_member"]; ?></td>
          <td><?= $item["nama"]; ?></td>
          <td><?= $item["jenis_kelamin"]; ?></td>
          <td><?= $item["kelas"]; ?></td>
          <td><?= $item["jurusan"]; ?></td>
          <td><?= $item["no_tlp"]; ?></td>
          <td><?= $item["tgl_pendaftaran"]; ?></td>
          <td>
            <div class="action">
              <a href="deleteMember.php?id=<?= $item["nisn"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data member?');"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<footer class="fixed-bottom shadow-lg bg-subtle p-3">
  <div class="container-fluid d-flex justify-content-between">
  <p class="mt-2">made with 💙 by <span class="text-primary"> iegcode</span></p>
  <p class="mt-2">versi 1.0</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
