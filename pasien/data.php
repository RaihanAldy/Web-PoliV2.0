<?php include_once('../_header.php'); ?>

      <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content">
         <h1 style="color: white;">Data Pasien</h1>
         <h4>
            <small style="color: white;">Data Pasien</small>
            <div class="pull-right">
              <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
              <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pasien</a>
              <a href="import.php" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-import"></i>Import Data Pasien</a>
            </div>
         </h4>
         <div class="table-responsive">
             <table class="table table-bordered table-hover" id="pasien" style="color: white; background-color: #3b3b3b;">
                <thead>
                  <tr>
                    <th></th>
                     <th>Nomor</th>
                     <th>Nama Pasien</th>
                     <th>Alamat</th>
                     <th>No. KTP</th>
                     <th>No. Telepon</th>
                     <th>No. Rekam Medis</th>
                     <th>Inisial</th> 
                     <th><i class="glyphicon glyphicon-cog"></i></th>
                  </tr> 
                </thead>
                <tbody>
                <?php
                $no = 1;
                $sql_poli = mysqli_query($con,"SELECT * FROM pasien") or die(mysqli_error($con));
                while ($data = mysqli_fetch_array($sql_poli)) { ?>
                    <tr style="background-color: #222222;">
                        <td align="center">
                            <input type="checkbox" name="checked[]" class="check" value="<?=$data['id']?>">
                        </td>
                        <td><?=$no++?>.</td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['alamat']?></td>
                        <td><?=$data['no_ktp']?></td>
                        <td><?=$data['no_hp']?></td>
                        <td><?=$data['no_rm']?></td>
                        <td><?=$data['id_user']?></td>
                        <td align="center">
                            <a href="edit.php?id=<?=$data['id']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                    </tr>
                    <?php
                      }
                ?>
              </tbody>
             </table>
         </div>
         <!-- <script>

    $(document).ready(function() {
       $('#pasien').DataTable( {
           "processing": true,
            "serverSide": true,
            "ajax": "pasien_data.php",
            //scrollY : '250px',
            dom : 'Bfrtip' ,
            buttons : [
              {
                extend : 'pdf',
                orientation : 'portrait',
                pageSize : 'Legal',
                title : 'Data Pasien',
                download : 'open'
              },
              //'csv', 'excel', 'print', 'copy'
            ],
            columnDefs : [
                 {
                    "searchable" : false,
                    "orderable"  : false,
                    "targets": 5,
                    "render" : function(data, type, row) {
                       var btn = "<center><a href=\"edit.php?id="+data+"\"                         class=\"btn btn-warning btn-xs\"><i class=\"glyphicon                      glyphicon-edit\"></i></a> <a href=\"del.php?id="+data+"\"            onclick=\"return confirm('Yakin Menghapus Data?')\"                    class=\"btn btn-danger btn-xs\"><i class=\"glyphicon            glyphicon-trash\"></i></a></center>";
                       return btn;
                    }
                 }

                ]

              } );
          } );
         </script> -->
         </div>
         </div>
    </div>  

<?php include_once('../_footer.php'); ?>