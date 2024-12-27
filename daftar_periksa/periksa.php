<?php
require_once "../_config/config.php";
include_once('../_header.php');

$id_daftar = $_GET['id'];
$is_edited = false; // Flag untuk mendeteksi apakah sudah ada data pemeriksaan

// Cek apakah sudah ada pemeriksaan untuk pasien ini
$query_periksa = mysqli_query($con, "SELECT * FROM periksa WHERE id_daftar_poli = '$id_daftar'");
$periksa_data = mysqli_fetch_assoc($query_periksa);

if ($periksa_data) {
    // Jika sudah ada data pemeriksaan, set flag is_edited
    $is_edited = true;
    // Ambil data obat yang telah dipilih sebelumnya
    $query_detail_periksa = mysqli_query($con, "SELECT id_obat FROM detail_periksa WHERE id_periksa = '{$periksa_data['id']}'");
    $obat_terpilih = [];
    while ($row = mysqli_fetch_assoc($query_detail_periksa)) {
        $obat_terpilih[] = $row['id_obat'];
    }
} else {
    $obat_terpilih = [];
}

// Proses form edit atau simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $biaya_periksa = 150000; // Biaya pemeriksaan tetap

    // Hitung total biaya berdasarkan obat yang dipilih
    $obat = $_POST['obat']; // Array ID obat yang dipilih
    $total_harga_obat = $_POST['total_harga_obat']; // Total harga obat

    // Hitung total biaya
    $total_biaya = $biaya_periksa + $total_harga_obat;

    if ($is_edited) {
        // Update data pemeriksaan yang sudah ada
        mysqli_query($con, "UPDATE periksa SET tgl_periksa = '$tgl_periksa', catatan = '$catatan', biaya_periksa = '$total_biaya' WHERE id = '{$periksa_data['id']}'")
            or die(mysqli_error($con));

        // Hapus detail obat yang lama
        mysqli_query($con, "DELETE FROM detail_periksa WHERE id_periksa = '{$periksa_data['id']}'");

        // Masukkan data obat baru
        foreach ($obat as $id_obat) {
            mysqli_query($con, "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('{$periksa_data['id']}', '$id_obat')")
                or die(mysqli_error($con));
        }
    } else {
        // Masukkan data baru ke tabel periksa
        mysqli_query($con, "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) 
                            VALUES ('$id_daftar', '$tgl_periksa', '$catatan', '$total_biaya')")
            or die(mysqli_error($con));

        // Ambil ID pemeriksaan terakhir
        $id_periksa = mysqli_insert_id($con);

        // Simpan data obat yang dipilih ke tabel detail_periksa
        foreach ($obat as $id_obat) {
            mysqli_query($con, "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$id_obat')")
                or die(mysqli_error($con));
        }
    }

    echo "<script>alert('Pemeriksaan berhasil disimpan!'); window.location='data.php';</script>";
}

?>

<div class="slides">
    <div class="slide" id="2">
        <div class="content second-content" style="color: white;">
            <h1><?= $is_edited ? 'Edit Pemeriksaan' : 'Periksa Pasien' ?></h1>
            <form action="periksa.php?id=<?= $id_daftar ?>" method="post" id="form-periksa">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td><input type="date" name="tgl_periksa" class="form-control" value="<?= $is_edited ? $periksa_data['tgl_periksa'] : '' ?>" required></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td><textarea name="catatan" class="form-control" required><?= $is_edited ? $periksa_data['catatan'] : '' ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Tambah Obat</th>
                        <td>
                            <select name="obat[]" id="obat" class="form-control" multiple required size="5" style="width: 100%;">
                                <?php
                                // Ambil data obat dari database
                                $query_obat = mysqli_query($con, "SELECT * FROM obat");
                                while ($row_obat = mysqli_fetch_assoc($query_obat)) {
                                    // Tandai obat yang sudah dipilih
                                    $selected = in_array($row_obat['id'], $obat_terpilih) ? 'selected' : '';
                                    echo "<option value='{$row_obat['id']}' data-harga='{$row_obat['harga']}' $selected>
                                        {$row_obat['nama_obat']} - {$row_obat['kemasan']} (Rp{$row_obat['harga']})
                                    </option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Harga Obat</th>
                        <td><input type="number" name="total_harga_obat" id="total_harga_obat" class="form-control" value="<?= $is_edited ? $total_harga_obat : 0 ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Total Biaya</th>
                        <td><input type="number" id="total_biaya" class="form-control" value="<?= $is_edited ? $periksa_data['biaya_periksa'] : 150000 ?>" readonly></td>
                    </tr>
                </table>

                <div class="form-group pull-right">
                    <input type="submit" value="<?= $is_edited ? 'Edit Pemeriksaan' : 'Simpan Pemeriksaan' ?>" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Menghitung total harga obat berdasarkan pilihan
document.addEventListener("DOMContentLoaded", function() {
    const obatSelect = document.getElementById('obat');
    const totalHargaObatInput = document.getElementById('total_harga_obat');
    const totalBiayaInput = document.getElementById('total_biaya');
    
    obatSelect.addEventListener('change', function() {
        let totalHargaObat = 0;
        const selectedOptions = obatSelect.selectedOptions;
        for (let option of selectedOptions) {
            totalHargaObat += parseInt(option.getAttribute('data-harga')) || 0;
        }

        totalHargaObatInput.value = totalHargaObat;
        const biayaPeriksa = 150000;
        totalBiayaInput.value = biayaPeriksa + totalHargaObat;
    });
});
</script>

<?php include_once('../_footer.php'); ?>
