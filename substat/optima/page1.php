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
	<title>Pemilihan mitra | SIMPRO</title>
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
      <a href="page1.php" class="pageactive"><h4><strong>Pilih Mitra</strong></h4></a>
    </div>
  </div>
    <div class="container">
    	<div class="content">
    		<div class="headregister">
    			<label>Pemilihan Mitra</label>
    		</div>
    		<div class="form">
    			<form method="post" id="regist" class="form-style2" action="config/(optima)pilihmitra.php">
            <div class="column" style="">
             	<label>ID Project:</label>
              <select name="idproject" class="field-style field-split" required>
                <?php
                $q=mysqli_query($conn,"SELECT* FROM pengajuan");
                while ($data = mysqli_fetch_assoc($q)){
                  echo '<option selected hidden value="">Pilih ID Project</option><option value="'.$data['idproject'].'">'.$data['idproject'].'</option>';
                }?>
              </select>
             	<label>Nama Mitra:  </label>
              <select name="nmitra" class="field-style field-split" required>
                <?php
                $q=mysqli_query($conn,"SELECT* FROM user WHERE status='mitra'");
                while ($data = mysqli_fetch_assoc($q)){
                  echo '<option selected hidden value="">Pilih nama mitra</option><option value="'.$data['nama'].'">'.$data['nama'].'</option>';
                }?>
              </select>
              <input type="submit" name="submit" value="Submit">`	
	          </div>
          </form>
        </div>
    	</div>
    </div>
</body>
</html>