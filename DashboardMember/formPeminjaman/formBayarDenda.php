<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";

if (isset($_POST["bayar"])) {
    if (bayarDenda($_POST) > 0) {
        echo "<script>
        alert('Denda berhasil dibayar');
        document.location.href = 'TransaksiDenda.php';
        </script>";
    } else {
        echo "<script>
        alert('Denda gagal dibayar');
        </script>";
    }
}

$dendaSiswa = $_GET["id"];
$query = queryReadData("SELECT pengembalian.id_pengembalian, buku.judul, member.nama, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nisn = member.nisn
WHERE pengembalian.id_pengembalian = $dendaSiswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Bayar Denda || Member</title>
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
    <div class="card p-3 mb-5">
        <form action="" method="post">
            <h3 class="mb-4">Form Bayar Denda</h3>
            <?php foreach ($query as $item) : ?>
                <input type="hidden" name="id_pengembalian" id="id_pengembalian" value="<?= $item["id_pengembalian"]; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $item["nama"]; ?>" readonly>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="judul" class="form-label">Buku yang Dipinjam</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $item["judul"]; ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="buku_kembali" class="form-label">Tanggal Dikembalikan</label>
                        <input type="date" class="form-control" id="buku_kembali" name="buku_kembali" value="<?= $item["buku_kembali"]; ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="denda" class="form-label">Besar Denda</label>
                        <input type="number" class="form-control" id="denda" name="denda" value="<?= $item["denda"]; ?>" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bayarDenda" class="form-label">Jumlah Denda yang Dibayar</label>
                    <input type="number" class="form-control" id="bayarDenda" name="bayarDenda" required>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-warning me-md-2">Reset</button>
                    <button type="submit" class="btn btn-success" name="bayar">Bayar</button>
                </div>
            <?php endforeach; ?>
        </form>
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
