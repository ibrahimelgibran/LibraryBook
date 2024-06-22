<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";

$akunMember = $_SESSION["member"]["nisn"];
$dataPengembalian = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_buku, buku.judul, buku.kategori, pengembalian.nisn, member.nama, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nisn = member.nisn
INNER JOIN admin ON pengembalian.id_admin = admin.id
WHERE pengembalian.nisn = $akunMember");

if (isset($_POST["search"])) {
    $dataPengembalian = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi Pengembalian Buku || Member</title>
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
        .bg-subtle {
            background-color: #f8f9fa; /* Warna latar belakang footer */
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
    <div class="alert alert-primary" role="alert">
        Riwayat transaksi Pengembalian Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama"]); ?></span>
    </div>

    <!-- Search Form -->
    <!-- <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari judul atau ID buku..." name="keyword">
            <button class="btn btn-outline-secondary" type="submit" name="search">Search</button>
        </div>
    </form> -->

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="text-center bg-primary text-light">
            <tr>
                <th>Id Pengembalian</th>
                <th>Id Buku</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Nama Admin</th>
                <th>Tanggal Pengembalian</th>
                <th>Keterlambatan</th>
                <th>Denda</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataPengembalian as $item) : ?>
                <tr>
                    <td><?= $item["id_pengembalian"]; ?></td>
                    <td><?= $item["id_buku"]; ?></td>
                    <td><?= $item["judul"]; ?></td>
                    <td><?= $item["kategori"]; ?></td>
                    <td><?= $item["nisn"]; ?></td>
                    <td><?= $item["nama"]; ?></td>
                    <td><?= $item["nama_admin"]; ?></td>
                    <td><?= $item["buku_kembali"]; ?></td>
                    <td><?= $item["keterlambatan"]; ?></td>
                    <td><?= $item["denda"]; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="fixed-bottom shadow-lg bg-dark text-light p-3">
    <div class="container-fluid d-flex justify-content-between">
        <p class="mt-2">made with 💙 by <span class="text-primary">iegcode</span></p>
        <p class="mt-2">versi 1.0</p>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
