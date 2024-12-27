<?php
include_once('../_header.php');

// Ambil nama user berdasarkan id_user dari session
$id_user = $_SESSION['id_user'];
$query_user = mysqli_query($con, "SELECT nama_user FROM tb_user WHERE id_user = '$id_user'");
$data_user = mysqli_fetch_assoc($query_user);
$nama_user = $data_user['nama_user'];
?>

<div class="slides">
    <div class="slide" id="1">
        <div class="content first-content">
            <div class="container-fluid">
                <div class="col-md-3">
                    <div class="author-image"><img src="../_assets/images/16.jpg" alt=""></div>
                </div>
                <div class="container">
                    <h1 style="color: white">Welcome, <?= $nama_user; ?>!</h1>
                    <p>This is your personalized dashboard. Use the menu to navigate.</p>
                    
                    <!-- You can display user-specific data here -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style = "color:white">Dashboard Content</h3>
                            <p>As a <strong>
                                <?= ($_SESSION['level'] == '1') ? 'Admin' : (($_SESSION['level'] == '2') ? 'Doctor' : (($_SESSION['level'] == '3') ? 'Patient' : 'Unknown')) ?>
                                </strong>, you have access to different sections of the site.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<?php include_once('../_footer.php'); ?>
