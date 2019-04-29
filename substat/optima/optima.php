<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="optima"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Informasi Planning Alat Produksi</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<script src="../../js/jquery-1.11.3.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/optima.css">
</head>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="optima.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>

		</div>
      	<div class="logout">
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')" style="border:none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page4.php" class=""><h4><strong>Mitra</strong></h4></a>
      		<a href="page3.php" class=""><h4><strong>Optima</strong></h4></a>
      		<a href="page2.php" class=""><h4><strong>User</strong></h4></a>
      		<a href="page1.php" class=""><h4><strong>Pilih Mitra</strong></h4></a>
        </div>
  </div>
    <div class="container">
      <?php
          $nama       = '';
          $email= '';
          $username= '';
          $tel= '';
          $alamat= '';
          $status= '';

          $id_user = $_SESSION['id_user'];
          $query = "SELECT * FROM user WHERE id_user = '$id_user'";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)){
              $nama .= $row['nama'];
              $email .= $row['email'];
              $username .= $row['username'];
              $tel.= $row['no_tel'];
              $alamat.= $row['alamat'];
              $status.= $row['status'];
          }
      ?>
    	<div class="konten">
    		<div class="card1">
          <img class="gambar" src="../../img/user1.jpg" alt="profile">
          <h1 class="judul">Selamat Datang <?=$nama?> </h1>
        </div>
        <div class="card2">
            <h2 class="judul">Profile</h2>
            <table class="tfont" id="table">
              <tr>
                <td>Username/NIK</td>
                <td style="width: 2px;">:</td>
                <td><?=$username?></th>
              </tr>
              <tr>
                <td>Nama</td>
                <td style="width: 2px;">:</td>
                <td><?=$nama?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td style="width: 2px;">:</td>
                <td><?=$status?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td style="width: 2px;">:</td>
                <td><?=$email?></td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td style="width: 2px;">:</td>
                <td><?=$tel?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td style="width: 2px;">:</td>
                <td><?=$alamat?></td>
              </tr>
            </table>
        </div>
    	</div>
    </div>
</body>

</html>