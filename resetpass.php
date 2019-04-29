<!DOCTYPE html>
<?php
include'include/connection.php';
    session_start();

    if(!isset($_SESSION['id_user'])){
        die("<script>alert('anda belum login');window.location.href='index.php';</script>");
    }
    $id         = $_SESSION['id_user'];
    $akun       = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
    $row        = mysqli_fetch_array($akun);
?>
<HTML>
    <head>
        <meta charset="utf-8">
		<title>Reset Password</title>
		<link rel="icon" type="image/png" href="../img/img1.png">
		<link rel="stylesheet" type="text/css" href="css/resetpass.css">
    </head>
    <body class="gambar">
        <div class="head">Silahkan Reset Password Anda</div>
        <div class="form">
            <form action="" method="post">
                <div class="label">
                    <label>ID USER: <br><?php echo $row['id_user'];$_SESSION['id_user'] = $row['id_user']; ?></label>
                </div>
                <div class="grup">
                    <label> Nama: </label>
                    <input type="text"  name="nama" readonly value="<?php echo $row['nama'];?>">
                </div>
                <div class="grup">
                    <label> Email: </label>
                    <input type="email" name="email" readonly value="<?php echo $row['email'];?>">
                </div>
                <div class="grup">
                    <label>Username/NIK:</label>
                    <input type="text" name="username" readonly value="<?php echo $row['username'];?>">
                </div>
                <div class="grup">
                    <label>Password:</label>
                    <input type="password" id="pass" name="pass" placeholder="Masukkan Password Baru">
                </div>
                <div class="showpassword">
                    <input type="checkbox" onclick="showpassword()" value=""><label>  Show Password</label>
                </div>
                <div class="grup">
                    <label>No Telp:</label>
                    <input type="text" name="tel" value="<?php echo $row['no_tel'];?>">
                </div>
                <div class="grup">
                    <label>Alamat:</label>
                    <input type="text" name="alamat" value="<?php echo $row['alamat'];?>">
                </div>
                <div class="grup">
                    <label>Status:</label>
                    <select name="status">
                        <option selected hidden value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
                        <option value="user">User</option>
                        <option value="mitra">Mitra</option>
                        <option value="optima">Optima</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="footer">
                    <input type="button" onclick="location.href='forgotpass.php';" value="Kembali"> 
                    <input type="submit" value="Submit" name="submit">
                </div>
            </form>
        </div>
        <script type="text/javascript">
            function showpassword() {
            var x = document.getElementById("pass");
            if (x.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
        </script>
    </body>
</html>
    <?php
    if(isset($_POST['submit'])){
        $id_user    = $_SESSION['id_user'];
        $nama       = $_POST['nama'];
        $email      = $_POST['email'];
        $username   = $_POST['username'];
        $password   = md5($_POST['pass']);
        $no_tel     = $_POST['tel'];
        $alamat     = $_POST['alamat'];
        $status     = $_POST['status'];

        $query="UPDATE user SET  nama='$nama', email='$email', username='$username', password='$password', no_tel='$no_tel', alamat='$alamat', status='$status' WHERE id_user='$id_user'";
        $hasil=mysqli_query($conn, $query);
            if(!$hasil) {
                die ("gagal");
            }else{
                echo "<script> alert('Berhasil!');window.location.href='logout.php';</script>";
            }
            
    }

    ?>