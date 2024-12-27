<?php include_once('../_header.php'); ?>

     <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: white;">
         <h1>Dokter</h1>
         <h4>
            <small>Edit Data Dokter</small>
            <div class="pull-right">
              <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
            </div>
         </h4>
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                  $id = @$_GET['id'];
                  $sql_dokter = mysqli_query($con, "SELECT * FROM dokter WHERE id = '$id'") or die (mysqli_error($con));
                  $data = mysqli_fetch_array($sql_dokter);
                ?>
                <form action="proses.php" method="post">
                   <div class="form-group">
                        <label form="nama">Nama Dokter</label>
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <input type="text" name="nama" id="nama" value="<?=$data['nama']?>" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="id_poli">Spesialis</label>
                        <input type="text" name="id_poli" id="id_poli" value="<?=$data['id_poli']?>" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required><?=$data['alamat']?></textarea>
                   </div>
                   <div class="form-group">
                        <label form="no_hp">No. Telepon</label>
                        <input type="number" name="no_hp" id="no_hp" value="<?=$data['no_hp']?>"  class="form-control" required autofocus>
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