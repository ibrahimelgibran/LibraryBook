<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";
$akunMember = $_SESSION["member"]["nisn"];
$dataPinjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, admin.nama_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian
                              FROM peminjaman
                              INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
                              INNER JOIN member ON peminjaman.nisn = member.nisn
                              INNER JOIN admin ON peminjaman.id_admin = admin.id
                              WHERE peminjaman.nisn = $akunMember");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Transaksi Peminjaman Buku || Member</title>
    <style>
        body {
            padding-top: 70px; /* Adjusted padding for fixed navbar */
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #6c757d;
        }

        .btn-tertiary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .alert-primary {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .bg-primary {
            background-color: #007bff !important;
            color: #fff;
        }

        .bg-subtle {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-body-tertiary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logo.png" alt="logo" width="80px">
            </a>
            <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="alert alert-primary" role="alert">
            Riwayat transaksi Peminjaman Buku Anda -
            <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama"]); ?></span>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="text-center bg-primary">
                    <tr>
                        <th>ID Peminjaman</th>
                        <th>ID Buku</th>
                        <th>Judul Buku</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Nama Admin</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataPinjam as $item) : ?>
                    <tr>
                        <td><?= $item["id_peminjaman"]; ?></td>
                        <td><?= $item["id_buku"]; ?></td>
                        <td><?= $item["judul"]; ?></td>
                        <td><?= $item["nisn"]; ?></td>
                        <td><?= $item["nama"]; ?></td>
                        <td><?= $item["nama_admin"]; ?></td>
                        <td><?= $item["tgl_peminjaman"]; ?></td>
                        <td><?= $item["tgl_pengembalian"]; ?></td>
                        <td>
                            <a class="btn btn-success" href="pengembalianBuku.php?id=<?= $item["id_peminjaman"]; ?>"> Kembalikan</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
