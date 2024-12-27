<?php include_once('../_header.php'); ?>

<div class="slides">
    <div class="slide" id="poli_form">
        <div class="content third-content">
            <h1 style="color: white;">Pendaftaran Poli</h1>
            <h4>
                <small style="color: white;">Pilih Poli, Dokter, dan Jadwal</small>
                <div class="pull-right">
                    <a href="data.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pendaftaran</a>
                </div>
            </h4>
            
            <div style="margin-bottom: 20px;">
                <form class="form-inline" action="proses.php" method="post" style="max-width: 500px; margin: 0 auto;">
                    <div class="form-group" style="width: 100%; margin-bottom: 15px;">
                        <label for="id_pasien" style="color: white">ID Pasien:</label>
                        <select name="id_pasien" name="id_pasien" id="id_pasien" class="form-control" required style="width: 100%;">
                        <?php
                            // Ambil data poli dari database
                            $query_pasien = mysqli_query($con, "SELECT * FROM pasien");
                            while ($row_pasien = mysqli_fetch_assoc($query_pasien)) {
                                echo "<option value='{$row_pasien['id']}'>{$row_pasien['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>   
                    <div class="form-group" style="width: 100%; margin-bottom: 15px;">
                        <label for="poli" style="color: white">Pilih Poli:</label>
                        <select name="id_poli" id="poli" class="form-control" required style="width: 100%;">
                            <?php
                            // Ambil data poli dari database
                            $query_poli = mysqli_query($con, "SELECT * FROM poli");
                            while ($row_poli = mysqli_fetch_assoc($query_poli)) {
                                echo "<option value='{$row_poli['id']}'>{$row_poli['nama_poli']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group" style="width: 100%; margin-bottom: 15px;">
                        <label for="dokter" style="color: white">Pilih Dokter:</label>
                        <select name="id_dokter" id="dokter" class="form-control" required style="width: 100%;">
                            <!-- Dokter akan dimuat dinamis menggunakan JavaScript -->
                            <?php
                            // Ambil data poli dari database
                            $query_dokter = mysqli_query($con, "SELECT * FROM dokter");
                            while ($row_dokter = mysqli_fetch_assoc($query_dokter)) {
                                echo "<option value='{$row_dokter['id']}'>{$row_dokter['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" style="width: 100%; margin-bottom: 15px;">
                        <label for="jadwal" style="color: white">Pilih Jadwal:</label>
                        <select name="id_jadwal" id="jadwal" class="form-control" required style="width: 100%;">
                            <!-- Jadwal akan dimuat dinamis menggunakan JavaScript -->
                            <?php
                            // Ambil data poli dari database
                            $query_jadwal = mysqli_query($con, "SELECT * FROM jadwal_periksa");
                            while ($row_jadwal = mysqli_fetch_assoc($query_jadwal)) {
                                echo "<option value='{$row_jadwal['id']}'>{$row_jadwal['hari']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" style="width: 100%; margin-bottom: 15px;">
                        <label for="keluhan" style="color: white">Keluhan / Gejala:</label>
                        <textarea name="keluhan" id="keluhan" class="form-control" required style="width: 100%;"></textarea>
                    </div>

                    <button type="submit" name="add" class="btn btn-primary" style="width: 100%;">Daftar Poli</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
// JavaScript untuk memuat dokter berdasarkan poli yang dipilih
document.getElementById('poli').addEventListener('change', function () {
    var poliId = this.value;

    fetch('get_dokter.php?poli_id=' + poliId)
        .then(response => response.json())
        .then(data => {
            var dokterSelect = document.getElementById('dokter');
            dokterSelect.innerHTML = ''; // Kosongkan daftar dokter
            data.forEach(function (dokter) {
                var option = document.createElement('option');
                option.value = dokter.id;
                option.textContent = dokter.nama;
                dokterSelect.appendChild(option);
            });
        });
});

// JavaScript untuk memuat jadwal berdasarkan dokter yang dipilih
document.getElementById('dokter').addEventListener('change', function () {
    var dokterId = this.value;

    fetch('get_jadwal.php?dokter_id=' + dokterId)
        .then(response => response.json())
        .then(data => {
            var jadwalSelect = document.getElementById('jadwal');
            jadwalSelect.innerHTML = ''; // Kosongkan jadwal
            data.forEach(function (jadwal) {
                var option = document.createElement('option');
                option.value = jadwal.id;
                option.textContent = jadwal.hari + ' ' + jadwal.jam_mulai + ' - ' + jadwal.jam_selesai;
                jadwalSelect.appendChild(option);
            });
        });
});
</script>

<?php include_once('../_footer.php'); ?>
