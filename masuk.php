<?php
require'function.php';
require'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Barang Masuk</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link
      href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
      crossorigin="anonymous"
    ></script>
    <style>
      .zoomable{
        width: 100px;
      }
      .zoomable:hover{
        transform: scale(2.5);
        transition: 0.3s ease;
      }
    </style>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">Taruna Jaya Musik</a>
      <button
        class="btn btn-link btn-sm order-1 order-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
      
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Core</div>
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Stock Barang
              </a>
              <a class="nav-link" href="masuk.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Barang Masuk 
              </a>
              <a class="nav-link" href="keluar.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Barang Keluar
              </a>
              <!-- <a class="nav-link" href="admin.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Kelola Admin
              </a> -->
              <a class="nav-link" href="logout.php">
                 logout
              </a>

              
            </div>
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Barang Masuk</h1>
           
               <div class="card mb-4">
              <div class="card-header">
               <!-- button open the modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Tambah Barang</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
                    $ambilsemuadatastock = mysqli_query($conn, 'select * from masuk m, stock s where s.idbarang = m.idbarang');
                    while($data=mysqli_fetch_array($ambilsemuadatastock)){
                      $idb = $data['idbarang'];
                      $idm = $data['idmasuk'];
                      $tanggal = $data['tanggal'];
                      $namabarang = $data['namabarang'];
                      $qty = $data['qty'];
                      $keterangan = $data['keterangan'];

                       // cek ada barang atau tidak
                          $gambar = $data['image']; //ambil gambar
                          if($gambar == null){
                            //jika tidak ada gambar
                            $img ='no photo';
                          } else {
                            //jika ada gambar
                            $img = '<img src="images/'.$gambar.'" class="zoomable">';
                          }
                    
                    ?>

                      <tr>
                        <td><?=$tanggal; ?></td>
                        <td><?=$img; ?></td>
                        <td><?=$namabarang; ?></td>
                        <td><?=$qty; ?></td>
                        <td><?=$keterangan; ?></td>
                        <td>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>"> 
                          Edit
                          </button>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>"> 
                          Delete
                          </button>
                        </td>
                      </tr>
                        
                      
                       <!-- edit modal -->
                        <div class="modal fade" id="edit<?=$idm;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- modal header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Barang</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal Body --> 
                              <form method="post">
                              <div class="modal-body">
                              <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                              <br>
                              <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                              <br>
                              <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                              <br>
                              
                              <input type="hidden" name="idb" value="<?=$idb;?>">
                              <input type="hidden" name="idm" value="<?=$idm;?>">
                              <button type="submit" class="btn btn-primary" name="updatebarangmasuk">button</button>
                              </div>
                              </form>

                        
                            </div>
                          </div>
                        </div>

                       <!-- delete modal -->
                        <div class="modal fade" id="delete<?=$idm;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- modal header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Barang</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal Body --> 
                              <form method="post">
                              <div class="modal-body">
                              apakah anda yakin ingin menghapus <?=$namabarang;?> ?
                              <input type="hidden" name="idb" value="<?=$idb;?>">
                              <input type="hidden" name="kty" value="<?=$qty;?>">
                              <input type="hidden" name="idm" value="<?=$idm;?>">
                              <br>
                              <br>
                              <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                              </div>
                              </form>

                        
                            </div>
                          </div>
                        </div>


                    <?php
                    };
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid">
            <div
              class="d-flex align-items-center justify-content-between small"
            >
              <div class="text-muted">Copyright &copy; Your Website 2021</div>
              <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/scripts.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script
      src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="assets/demo/datatables-demo.js"></script>
  </body>
  <!-- the modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- modal header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body --> 
        <form method="post">
        <div class="modal-body">
        <select name="barangnya" class="form-control">
        <?php
          $ambilsemuadatanya = mysqli_query($conn, "select * from stock order by namabarang ASC");
          while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
            $namabarangnya = $fetcharray['namabarang'];
            $idbarangnya = $fetcharray['idbarang'];
        ?>

        <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

        <?php
          }
        ?>
        </select>
        <br>
        <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
        <br>
        <input type="text" name="penerima" placeholder="Keterangan" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-primary" name="barangmasuk">button</button>
        </div>
        </form>

   
      </div>
    </div>
  </div>
</html>
