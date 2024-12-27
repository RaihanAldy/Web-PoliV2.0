<?php include_once('../_header.php'); ?>

    <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: white;">
         <h1>Pasien</h1>
         <h4>
            <small>Import Data Pasien</small>
            <div class="pull-right">
              <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
            </div>
         </h4>
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="proses.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label form="file">File Excel</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                   </div>
                   <div class="form-group pull-right">
                        <input type="submit" name="import" value="Import" class="btn btn-success">
                   </div>   
                </form>
            </div>
         </div>
         </div>
         </div>
     </div>

<?php include_once('../_footer.php'); ?>