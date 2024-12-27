<?php include_once('../_header.php'); ?>

     <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: white;">
         <h1>Pasien</h1>
         <h4>
            <small>Edit Data Pasien</small>
            <div class="pull-right">
              <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
            </div>
         </h4>
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                 <?php
                  $id = @$_GET['id'];
                  $sql_pasien = mysqli_query($con,"SELECT * FROM pasien WHERE id = '$id'") or die (mysqli_error($con));
                  $data = mysqli_fetch_array($sql_pasien);
                 ?>
                <form action="proses.php" method="post">
                   <div class="form-group">
                        <label for="nama">Nama Pasien</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?=$data['nama']?>" required>
                   </div>
                   <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required><?=$data['alamat']?></textarea>
                   </div>
                   <div class="form-group">
                        <label for="ktp">No. KTP</label>
                        <input type="number" name="ktp" id="ktp" class="form-control" value="<?=$data['no_ktp']?>" required autofocus>
                   </div>
                   <div class="form-group">
                        <label for="telp">No. Telepon</label>
                        <input type="number" name="telp" id="telp" class="form-control" value="<?=$data['no_hp']?>" required autofocus>
                   </div>
                   <div class="form-group">
                        <label for="rm">No. Rekam Medis</label>
                        <input type="number" name="rm" id="rm" class="form-control" value="<?=$data['no_rm']?>" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="id_user">Inisial</label>
                        <input type="text" name="id_user" id="id_user" value="<?=$data['id_user']?>"  class="form-control" required autofocus>
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