<?php
require "../../config/config.php";
$dataPeminjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, member.kelas, member.jurusan, peminjaman.id_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian 
                                FROM peminjaman 
                                INNER JOIN member ON peminjaman.nisn = member.nisn
                                INNER JOIN buku ON peminjaman.id_buku = buku.id_buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Kelola peminjaman buku || admin</title>
  <style>
    body {
      background-color: #f8f9fa; /* Warna latar belakang */
    }
    .navbar {
      background-color: #6c757d; /* Warna navbar */
    }
    .navbar-brand img {
      max-height: 40px; /* Ukuran logo navbar */
    }
    .btn-tertiary {
      background-color: #343a40; /* Warna tombol Dashboard */
      color: #fff; /* Warna teks tombol Dashboard */
    }
    .table {
      background-color: #fff; /* Warna latar belakang tabel */
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); /* Efek bayangan tabel */
    }
    .table thead {
      background-color: #007bff; /* Warna latar belakang header tabel */
      color: #fff; /* Warna teks header tabel */
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0, 123, 255, 0.1); /* Warna latar belakang baris ganjil */
    }
    .table-hover tbody tr:hover {
      background-color: rgba(0, 123, 255, 0.2); /* Warna latar belakang saat hover */
    }
    .fixed-bottom {
      background-color: #f8f9fa; /* Warna latar belakang footer */
    }
    .bg-subtle {
      background-color: #f8f9fa; /* Warna latar belakang footer */
    }
  </style>
</head>
<body>
<nav class="navbar fixed-top bg-body-tertiary shadow-sm">
  <div class="container-fluid p-3">
    <a class="navbar-brand" href="#">
      <img src="../../assets/logo.png" alt="logo" width="100%">
    </a>
    <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
  </div>
</nav>

<div class="p-4 mt-5">
  <div class="mt-5">
    <h2 class="text-center mb-4">List of Peminjaman</h2>
    <div class="table-responsive mt-3">
      <table class="table table-striped table-hover">
        <thead class="text-center">
          <tr>
            <th class="bg-primary text-light">Id Peminjaman</th>
            <th class="bg-primary text-light">Id Buku</th>
            <th class="bg-primary text-light">Judul Buku</th>
            <th class="bg-primary text-light">NIM Siswa</th>
            <th class="bg-primary text-light">Nama siswa</th>
            <th class="bg-primary text-light">Kelas</th>
            <th class="bg-primary text-light">Jurusan</th>
            <th class="bg-primary text-light">Id Admin</th>
            <th class="bg-primary text-light">Tanggal Peminjaman</th>
            <th class="bg-primary text-light">Tanggal Pengembalian</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dataPeminjam as $item) : ?>
            <tr>
              <td><?= $item["id_peminjaman"]; ?></td>
              <td><?= $item["id_buku"]; ?></td>
              <td><?= $item["judul"]; ?></td>
              <td><?= $item["nisn"]; ?></td>
              <td><?= $item["nama"]; ?></td>
              <td><?= $item["kelas"]; ?></td>
              <td><?= $item["jurusan"]; ?></td>
              <td><?= $item["id_admin"]; ?></td>
              <td><?= $item["tgl_peminjaman"]; ?></td>
              <td><?= $item["tgl_pengembalian"]; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
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
