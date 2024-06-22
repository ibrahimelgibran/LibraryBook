<?php
session_start();

if (!isset($_SESSION["signIn"])) {
  header("Location: ../sign/member/sign_in.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Member Dashboard</title>
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

    .btn-light {
      background-color: #f8f9fa !important;
      border-color: #ced4da !important;
    }

    .dropdown-menu {
      min-width: 8rem;
    }

    .dropdown-item {
      color: #343a40;
    }

    .dropdown-item:hover {
      background-color: #f8f9fa;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border-color: #c3e6cb;
    }

    .mt-5 {
      margin-top: 3rem !important;
    }

    .cardImg {
      width: 100%;
      max-width: 600px;
    }

    @media screen and (max-width: 600px) {
      .cardImg a img {
        width: 100%;
      }
    }

    .shadow-lg {
      box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .bg-subtle {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-body-tertiary shadow-sm">
    <div class="container-fluid p-3">
      <a class="navbar-brand" href="#">
        <img src="../assets/logo.png" alt="logo" width="100%">
      </a>

      <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../assets/memberLogo.png" alt="memberLogo" width="40px">
        </button>
        <ul class="dropdown-menu dropdown-menu-end mt-2 p-2" aria-labelledby="dropdownMenuButton">
          <li>
            <a class="dropdown-item text-center" href="#">
              <img src="../assets/memberLogo.png" alt="adminLogo" width="30px">
            </a>
          </li>
          <li>
            <a class="dropdown-item text-center text-secondary" href="#">
              <span class="text-capitalize"><?php echo $_SESSION['member']['nama']; ?></span>
            </a>
            <a class="dropdown-item text-center mb-2" href="#">Siswa</a>
          </li>
          <li>
            <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="signOut.php">Sign Out <i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="mt-5 p-4">
    <?php
    $date = date('l, d F Y H:i:s'); // Format tanggal dan waktu
    ?>

    <h1 class="mt-5 fw-bold">Dashboard - <span class="fs-4 text-secondary"><?php echo $date; ?> </span></h1>
    <div class="alert alert-success mt-3" role="alert">Selamat datang member - <span class="text-capitalize fw-bold"><?php echo $_SESSION['member']['nama']; ?> </span> di Dashboard Perpustakaan</div>

    <div class="mt-5">
      <h3 class="mb-4 text-center">Layanan Perpustakaan yang Tersedia</h3>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <div class="cardImg">
          <a href="buku/daftarBuku.php">
            <img src="../assets/dashboardCardMember/daftarBuku.png" alt="daftar buku" width="80%">
          </a>
        </div>
        <div class="cardImg">
          <a href="formPeminjaman/TransaksiPeminjaman.php">
            <img src="../assets/dashboardCardMember/peminjaman.png" alt="peminjaman" width="80%">
          </a>
        </div>
        <div class="cardImg">
          <a href="formPeminjaman/TransaksiPengembalian.php">
            <img src="../assets/dashboardCardMember/pengembalian.png" alt="pengembalian" width="80%">
          </a>
        </div>
        <div class="cardImg">
          <a href="formPeminjaman/TransaksiDenda.php">
            <img src="../assets/dashboardCardMember/denda.png" alt="denda" width="80%">
          </a>
        </div>
      </div>
    </div>
  </div>

  <footer class="shadow-lg bg-subtle p-3 mt-5">
    <div class="container-fluid d-flex justify-content-between">
      <p class="mt-2">made with 💙 by <span class="text-primary"> iegcode</span></p>
      <p class="mt-2">versi 1.0</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
