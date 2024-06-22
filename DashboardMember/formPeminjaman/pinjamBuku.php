<?php 
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}
require "../../config/config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION["member"]["nisn"];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM admin");

// Peminjaman 
if(isset($_POST["pinjam"]) ) {
  
  if(pinjamBuku($_POST) > 0) {
    echo "<script>
    alert('Buku berhasil dipinjam');
    </script>";
  }else {
    echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
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
  <title>Form Peminjaman Buku || Member</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #6c757d;
    }

    .navbar-brand img {
      max-height: 30px;
    }

    .btn-tertiary {
      background-color: #6c757d;
      color: white;
      border: none;
    }

    .card {
      border: none;
      background-color: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #6c757d;
      color: white;
      font-weight: bold;
    }

    .card-body {
      padding: 1.5rem;
    }

    .input-group-text {
      background-color: #6c757d;
      color: white;
      border: none;
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

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }

    .fw-bold {
      font-weight: bold;
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
        <img src="../../assets/logo.png" alt="logo" width="30px">
      </a>
      
      <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
    </div>
  </nav>
  
<div class="p-4 mt-5">
  <h2 class="mt-5">Form Peminjaman Buku</h2>
  <div class="card">
    <h5 class="card-header">Data Lengkap Buku</h5>
    <div class="card-body d-flex flex-wrap gap-5 justify-content-center">
      <?php foreach ($query as $item) : ?>
        <p class="card-text"><img src="../../imgDB/<?= $item["cover"]; ?>" width="180px" height="185px" style="border-radius: 5px;"></p>
        <form action="" method="post">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Id Buku</span>
            <input type="text" class="form-control" placeholder="Id Buku" aria-label="Id Buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kategori</span>
            <input type="text" class="form-control" placeholder="Kategori" aria-label="Kategori" aria-describedby="basic-addon1" value="<?= $item["kategori"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Judul</span>
            <input type="text" class="form-control" placeholder="Judul" aria-label="Judul" aria-describedby="basic-addon1" value="<?= $item["judul"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Pengarang</span>
            <input type="text" class="form-control" placeholder="Pengarang" aria-label="Pengarang" aria-describedby="basic-addon1" value="<?= $item["pengarang"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Penerbit</span>
            <input type="text" class="form-control" placeholder="Penerbit" aria-label="Penerbit" aria-describedby="basic-addon1" value="<?= $item["penerbit"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
            <input type="text" class="form-control" placeholder="Tahun Terbit" aria-label="Tahun Terbit" aria-describedby="basic-addon1" value="<?= $item["tahun_terbit"]; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
            <input type="text" class="form-control" placeholder="Jumlah Halaman" aria-label="Jumlah Halaman" aria-describedby="basic-addon1" value="<?= $item["jumlah_halaman"]; ?>" readonly>
          </div>
          <div class="form-floating">
            <textarea class="form-control" placeholder="Deskripsi Buku" id="floatingTextarea2" style="height: 100px" readonly><?= $item["buku_deskripsi"]; ?></textarea>
            <label for="floatingTextarea2">Deskripsi Buku</label>
          </div>
      <?php endforeach; ?>
    </form>
   </div>
  </div>
  
<div class="card mt-4">
  <h5 class="card-header">Data Lengkap Siswa</h5>
  <div class="card-body d-flex flex-wrap gap-4 justify-content-center">
    <p><img src="../../assets/memberLogo.png" width="150px"></p>
    <form action="" method="post">
      <?php foreach ($dataSiswa as $item) : ?>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">NIM</span>
          <input type="text" class="form-control" placeholder="NISN" aria-label="NISN" aria-describedby="basic-addon1" value="<?= $item["nisn"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Tahun Masuk Member</span>
          <input type="text" class="form-control" placeholder="Kode Member" aria-label="Kode Member" aria-describedby="basic-addon1" value="<?= $item["kode_member"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Nama</span>
          <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1" value="<?= $item["nama"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
          <input type="text" class="form-control" placeholder="Jenis Kelamin" aria-label="Jenis Kelamin" aria-describedby="basic-addon1" value="<?= $item["jenis_kelamin"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Kelas</span>
          <input type="text" class="form-control" placeholder="Kelas" aria-label="Kelas" aria-describedby="basic-addon1" value="<?= $item["kelas"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Jurusan</span>
          <input type="text" class="form-control" placeholder="Jurusan" aria-label="Jurusan" aria-describedby="basic-addon1" value="<?= $item["jurusan"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">No Tlp</span>
          <input type="text" class="form-control" placeholder="No Tlp" aria-label="No Tlp" aria-describedby="basic-addon1" value="<?= $item["no_tlp"]; ?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Tanggal Daftar</span>
          <input type="text" class="form-control" placeholder="Tanggal Daftar" aria-label="Tanggal Daftar" aria-describedby="basic-addon1" value="<?= $item["tgl_pendaftaran"]; ?>" readonly>
        </div>
      <?php endforeach; ?>
    </form>
   </div>
  </div>

<div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data di atas, pastikan sudah benar sebelum meminjam buku!. jika ada kesalahan data harap hubungi admin</div>

<div class="card mt-4">
  <h5 class="card-header">Form Pinjam Buku</h5>
  <div class="card-body">
    <form action="" method="post">
      <!--Ambil data id buku-->
      <?php foreach ($query as $item) : ?>
       <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Id Buku</span>
        <input type="text" name="id_buku" class="form-control" placeholder="Id Buku" aria-label="Id Buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
       </div>
      <?php endforeach; ?>
    <!-- Ambil data NISN user yang login-->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">NIM</span>
        <input type="text" name="nisn" class="form-control" placeholder="NISN" aria-label="NISN" aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["member"]["nisn"]); ?>" readonly>
    </div>
    <!--Ambil data id admin-->
    <select name="id" class="form-select" aria-label="Default select example">
      <option selected>Pilih Id Admin</option>
      <?php foreach ($admin as $item) : ?>
      <option><?= $item["id"]; ?></option>
      <?php endforeach; ?>
    </select>
    <div class="input-group mb-3 mt-3">
        <span class="input-group-text" id="basic-addon1">Tanggal Pinjam</span>
        <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control" placeholder="Tanggal Pinjam" aria-label="Tanggal Pinjam" aria-describedby="basic-addon1" onchange="setReturnDate()" required>
    </div>
    <div class="input-group mb-3 mt-3">
        <span class="input-group-text" id="basic-addon1">Tenggat Pengembalian</span>
        <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control" placeholder="Tenggat Pengembalian" aria-label="Tenggat Pengembalian" aria-describedby="basic-addon1" readonly>
    </div>
    
    <a class="btn btn-danger" href="../buku/daftarBuku.php"> Batal</a>
    <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
    </form>
  </div>
</div>

<div class="alert alert-danger mt-4" role="alert"><span class="fw-bold">Catatan :</span> Setiap keterlambatan pada pengembalian buku akan dikenakan sanksi berupa denda.</div>

</div>

<footer class="shadow-lg bg-subtle p-3">
  <div class="container-fluid d-flex justify-content-between">
  <p class="mt-2">made with 💙 by <span class="text-primary"> iegcode</span></p>
  <p class="mt-2">versi 1.0</p>
  </div>
</footer>

<!--JAVASCRIPT -->
<script src="../../style/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
