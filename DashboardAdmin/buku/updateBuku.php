<?php
require "../../config/config.php";

// Ambil data dari url
$review = $_GET["idReview"];
$reviewData = queryReadData("SELECT * FROM buku WHERE id_buku = '$review'")[0];

// Data kategori buku
$kategori = queryReadData("SELECT * FROM kategori_buku");

if(isset($_POST["update"]) ) {
  
  if(updateBuku($_POST) > 0) {
    echo "<script>
    alert('Data buku berhasil diupdate!');
    document.location.href = 'daftarBuku.php';
    </script>";
  } else {
    echo "<script>
    alert('Data buku gagal diupdate!');
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
  <title>Edit data buku || Admin</title>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-body-tertiary py-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="https://upload.wikimedia.org/wikipedia/id/thumb/c/c7/AMIKOM_LOGO.svg/1200px-AMIKOM_LOGO.svg.png" alt="logo" width="120px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-black" aria-current="page" href="../dashboardAdmin.php">Dashboard</a>
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
    <h1 class="text-center fw-bold p-3">Form Edit buku</h1>
    <form action="" method="post" enctype="multipart/form-data" class="mt-3 p-2">

      <div class="custom-css-form">
        <div class="mb-3">
          <input type="hidden" name="coverLama" value="<?= $reviewData["cover"];?>">
          <label for="formFileMultiple" class="form-label">Cover Buku</label><br>
          <img src="../../imgDB/<?= $reviewData["cover"]; ?>" width="80px" height="80px"><br>
          <input class="form-control" type="file" name="cover" id="formFileMultiple">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
          <input type="text" class="form-control" name="id_buku" id="exampleFormControlInput1" placeholder="example inf01" value="<?= $reviewData["id_buku"]; ?>">
        </div>
      </div>
    
      <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
        <select class="form-select" id="inputGroupSelect01" name="kategori">
          <option disabled>Pilih Kategori</option>
          <?php foreach ($kategori as $item) : ?>
            <option value="<?= $item["kategori"]; ?>" <?= ($reviewData["kategori"] == $item["kategori"]) ? "selected" : ""; ?>>
              <?= $item["kategori"]; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
        
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
        <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku" aria-label="Username" aria-describedby="basic-addon1" value="<?= $reviewData["judul"]; ?>">
      </div>
        
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
        <input type="text" class="form-control" name="pengarang" id="exampleFormControlInput1" placeholder="nama pengarang" value="<?= $reviewData["pengarang"]; ?>">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
        <input type="text" class="form-control" name="penerbit" id="exampleFormControlInput1" placeholder="nama penerbit" value="<?= $reviewData["penerbit"]; ?>">
      </div>
        
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
        <input type="date" class="form-control" name="tahun_terbit" id="validationCustom01" value="<?= $reviewData["tahun_terbit"]; ?>">
      </div>
          
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
        <input type="number" class="form-control" name="jumlah_halaman" id="validationCustom01" value="<?= $reviewData["jumlah_halaman"]; ?>">
      </div>
        
      <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="buku_deskripsi" id="floatingTextarea2" style="height: 100px"><?= $reviewData["buku_deskripsi"]; ?></textarea>
        <label for="floatingTextarea2">Sinopsis</label>
      </div>
          
      <button class="btn btn-success" type="submit" name="update">Edit</button>
      <a href="daftarBuku.php" class="btn btn-danger">Batal</a>
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
