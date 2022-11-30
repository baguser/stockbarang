<?php
require'function.php';
require'cek.php';

$email = $_SESSION['email'];

// dapetin id barang yang dipassing di halaman sebelumnya
$idbarang = $_GET['id']; //get id barang
// get informasi barang berdasarkan database
$get = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);
// set variabel
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

   // cek ada barang atau tidak
$gambar = $fetch['image']; //ambil gambar
if($gambar == null){
//jika tidak ada gambar
$img ='no photo';
} else {
//jika ada gambar
$img = '<img class="card-img-top" src="images/'.$gambar.'" alt="Card image" style="width:100%">';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>Detail Barang</h3>
        <div class="card mt-4" style="width:400px">
            <?=$img?>
            <div class="card-body">
            <h4 class="card-title"><?=$namabarang;?></h4>
            <h4 class="card-text"><?=$deskripsi;?></h4>
            <h4 class="card-text"><?=$stock;?></h4>
            </div>
        </div>
        <br>
    </div>
</body>
</html>