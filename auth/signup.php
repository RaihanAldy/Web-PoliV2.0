<?php
require_once "../_config/config.php";

// Cek jika user sudah login
if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
    exit;
}

// Proses registrasi
if (isset($_POST['signup'])) {
    $name = trim(mysqli_real_escape_string($con, $_POST['nama_user']));
    $username = trim(mysqli_real_escape_string($con, $_POST['username']));
    $password = password_hash(trim(mysqli_real_escape_string($con, $_POST['password'])), PASSWORD_BCRYPT);
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $no_ktp = trim(mysqli_real_escape_string($con, $_POST['no_ktp']));
    $no_hp = trim(mysqli_real_escape_string($con, $_POST['no_hp']));

    // Cek jika username sudah ada
    $sql_check = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($sql_check) == 0) {
        // Masukkan data ke tabel user
        $sql_user = mysqli_query($con, "INSERT INTO tb_user (nama_user, username, password, level) VALUES ('$name', '$username', '$password', '3')");
        if ($sql_user) {
            // Ambil ID user yang baru saja dibuat
            $id_user = mysqli_insert_id($con);

            // Masukkan data ke tabel pasien
            $sql_pasien = mysqli_query($con, "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, id_user) VALUES ('$name', '$alamat', '$no_ktp', '$no_hp', '$id_user')");
            if ($sql_pasien) {
                echo "<script>alert('Registration successful!');window.location='login.php';</script>";
            } else {
                echo "<script>alert('Failed to save pasien data');</script>";
            }
        } else {
            echo "<script>alert('Failed to save user data');</script>";
        }
    } else {
        $error_message = "Username already exists";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Pasien</title>
    <link rel="stylesheet" href="../_assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../_assets/css/style.css">
</head>
<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Patient Registration</h2>
                        <?php if (isset($error_message)) { ?>
                            <div class="row">
                                <p style="color: red; text-align: center;"><?php echo $error_message; ?></p>
                            </div>
                        <?php } ?>
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="nama_user"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama_user" id="nama_user" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Your Address" required />
                            </div>
                            <div class="form-group">
                                <label for="no_ktp"><i class="zmdi zmdi-assignment"></i></label>
                                <input type="text" name="no_ktp" id="no_ktp" placeholder="Your KTP Number" required />
                            </div>
                            <div class="form-group">
                                <label for="no_hp"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="no_hp" id="no_hp" placeholder="Your Phone Number" required />
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account-circle"></i></label>
                                <input type="text" name="username" id="username" placeholder="Your Username" required />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../_assets/images/signup.jpg" alt="sign up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already a member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../_assets/js/jquery.min.js"></script>
    <script src="../_assets/js/main.js"></script>
</body>
</html>
