<?php 
require "../../config/config.php";
//$informatika = "informatika";
$kategori = queryReadData("SELECT * FROM kategori_buku");
if(isset($_POST["tambah"]) ) {
  
  if(tambahBuku($_POST) > 0) {
    echo "<script>
    alert('Data buku berhasil ditambahkan');
    </script>";
  }else {
    echo "<script>
    alert('Data buku gagal ditambahkan!');
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
  <title>Tambah buku || Admin</title>
  <style>
    .custom-css-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }
  </style>
</head>
<body>  
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-body-tertiary">
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
          <a class="nav-link text-primary"  href="../dashboardAdmin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="daftarBuku.php">Browse</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container p-3 mt-5">
  <div class="card p-2 mt-5">
    <h1 class="text-center fw-bold p-3">Form Tambah buku</h1>
    <form action="" method="post" enctype="multipart/form-data" class="mt-3 p-2">

      <div class="custom-css-form">
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Cover Buku</label>
          <input class="form-control" type="file" name="cover" id="formFileMultiple" required>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
          <input type="text" class="form-control" name="id_buku" id="exampleFormControlInput1" placeholder="Contoh: inf01" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select class="form-select" name="kategori" required>
            <option selected disabled>Pilih Kategori</option>
            <?php foreach ($kategori as $item) : ?>
              <option value="<?= $item["kategori"]; ?>"><?= $item["kategori"]; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
          <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku" required>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
          <input type="text" class="form-control" name="pengarang" id="exampleFormControlInput1" placeholder="Nama Pengarang" required>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
          <input type="text" class="form-control" name="penerbit" id="exampleFormControlInput1" placeholder="Nama Penerbit" required>
        </div>

        <div class="mb-3">
          <label for="validationCustom01" class="form-label">Tahun Terbit</label>
          <input type="date" class="form-control" name="tahun_terbit" id="validationCustom01" required>
        </div>

        <div class="mb-3">
          <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
          <input type="number" class="form-control" name="jumlah_halaman" id="validationCustom01" required>
        </div>

        <div class="mb-3">
          <label for="floatingTextarea2" class="form-label">Sinopsis</label>
          <textarea class="form-control" name="buku_deskripsi" id="floatingTextarea2" style="height: 100px" placeholder="Sinopsis tentang buku ini" required></textarea>
        </div>

      </div>

      <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
      <input type="reset" class="btn btn-warning text-light" value="Reset">
    </form>
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
