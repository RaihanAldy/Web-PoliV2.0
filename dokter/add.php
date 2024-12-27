<?php include_once('../_header.php'); ?>

     <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: white;">
         <h1>Dokter</h1>
         <h4>
            <small>Tambah Data Dokter</small>
            <div class="pull-right">
              <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
            </div>
         </h4>
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="proses.php" method="post">
                   <div class="form-group">
                        <label form="nama">Nama Dokter</label>
                        <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="id_poli">Spesialis</label>
                        <input type="text" name="id_poli" id="id_poli" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                   </div>
                   <div class="form-group">
                        <label form="no_hp">No. Telepon</label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control" required autofocus>
                   </div>
                   <div class="form-group">
                        <label form="id_user">Inisial</label>
                        <input type="text" name="id_user" id="id_userp" class="form-control" required autofocus>
                   </div>
                   <div class="form-group pull-right">
                        <input type="submit" name="add" value="Simpan" class="btn btn-success">
                   </div>   
                </form>
            </div>
         </div>
         </div>
         </div>
     </div>

<?php include_once('../_footer.php'); ?>