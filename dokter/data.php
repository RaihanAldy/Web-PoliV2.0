<?php include_once('../_header.php'); ?>

    <div class="slides">
          <div class="slide" id="2">
            <div class="content second-content" style="color: black;">
         <h1>Dokter</h1>
         <h4 >
            <small style="color: black;">Data Dokter</small>
            <div class="pull-right">
              <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
              <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Data Dokter</a>
            </div>
         </h4>
         <form method="post" name="proses">
         <div class="table-responsive">
             <table class="table table-bordered table-hover" id="dokter" style="color: black; ">
                <thead>
                  <tr>
                    <th>
                         <center>
                             <input type="checkbox" id="select_all" value="">
                         </center>
                     </th>   
                     <th><center>No.</center></th>
                     <th><center>Nama Dokter</center></th>
                     <th><center>Spesialis</center></th>
                     <th><center>Alamat</center></th>
                     <th><center>No. Telepon</center></th> 
                     <th><center>Inisial</center></th> 
                     <th><i class="glyphicon glyphicon-cog"></i></th>
                  </tr> 
                </thead>
                <tbody>
                <?php
                $no = 1;
                $sql_poli = mysqli_query($con,"SELECT * FROM dokter") or die(mysqli_error($con));
                while ($data = mysqli_fetch_array($sql_poli)) { ?>
                    <tr>
                        <td align="center">
                            <input type="checkbox" name="checked[]" class="check" value="<?=$data['id']?>">
                        </td>
                        <td><?=$no++?>.</td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['id_poli']?></td>
                        <td><?=$data['alamat']?></td>
                        <td><?=$data['no_hp']?></td>
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
     </form>

        <div class="box pull-right">
            <button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
        </div>
        </div>
        </div>
    </div>

    <script>
    //script multiple checked
    $(document).ready(function() {

      $('#dokter').DataTable({
        columnDefs: [
            { 
            "searchable": false,
            "orderable": false,
            "target": [0, 6]
            }
        ],
        "order": [1,"asc"]
    });
        
      $('#select_all').on('click',function(){
         if(this.checked) {
            $('.check').each(function() {
                this.checked = true;
            })
         } else {
            $('.check').each(function() {
                this.checked = false;
            })
         }
      });

      $('.check').on('click', function() {
        if($('.check:checked').length == $('.check').length) {
            $('#select_all').prop('checked',true)
        } else {
            $('#select_all').prop('checked',false)
        }
      })
    })
    

    //membuat fungsi hapus
    function hapus() {
        var conf = confirm('Yakin Akan Menghapus Data');
        if(conf) {
           document.proses.action = 'del.php';
           document.proses.submit();
        }
        
    }
    </script>
     
<?php include_once('../_footer.php'); ?>