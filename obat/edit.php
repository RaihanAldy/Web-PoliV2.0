<?php include_once('../_header.php');?>

     <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: white;">
         <h1>Obat</h1>
         <h4>
            <small>Edit Data Obat</small>
            <div class="pull-right">
              <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
            </div>
         </h4>
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">

              <?php
              $id = @$_GET['id'];
              $sql_obat = mysqli_query($con,"SELECT * FROM obat WHERE id = '$id'") or die (mysqli_error($con));
              $data = mysqli_fetch_array($sql_obat);
              ?>
                <form action="proses.php" method="post">
                   <div class="form-group">
                        <label form="nama">Nama Obat</label>
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <input type="text" name="nama" id="nama" value="<?=$data['nama_obat']?>" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="kemasan">Kemasan</label>
                        <textarea name="kemasan" id="kemasan" class="form-control" required><?=$data['kemasan']?></textarea>
                   </div>
                   <div class="form-group">
                        <label form="harga">Harga</label>
                        <textarea name="harga" id="harga" class="form-control" required><?=$data['harga']?></textarea>
                   </div>
                   <div class="form-group pull-right">
                        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
                   </div>   
                </form>
            </div>
         </div>
         </div>
         </div>
     </div>

<?php include_once('../_footer.php'); ?>