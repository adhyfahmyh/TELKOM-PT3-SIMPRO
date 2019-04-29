<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="mitra"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pengajuan | (SIMPRO)</title>
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
	<link rel="stylesheet" type="text/css" href="../../css/mitra.css">
</head>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="mitra.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>
		</div>
      	<div class="logout">
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')" style="border:none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page2.php" class=""><h4><strong>Report</strong></h4></a>
      		<a href="mage1.php" class="pageactive"><h4><strong>Progres</strong></h4></a>
            <a href="page.php" class=""><h4><strong>Update</strong></h4></a>
          	</div>
      	</div>
    </div>
    <div class="container">
    	<div class="content">
    		<div class="headregister">
    			<label>Progres Mitra</label>
    		</div>
    		<div class="form">
    			<form method="post" id="regist" class="form-style2" action="config/(mitra)input.php">
                   <div class="column" style="">
                   	<label>ID Order:</label>
                   	<select name="id_order" class="field-style field-split" required>
                        <?php
                        $namamitra=$_SESSION['nama'];
                            $q=mysqli_query($conn,"SELECT* FROM optima WHERE nmitra='$namamitra'");
                            while ($data = mysqli_fetch_assoc($q)){
                            echo '<option selected hidden="">Pilih</option><option value="'.$data['id_order'].'">'.$data['id_order'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Status Survey:</label>
                    <select name="ssurvey" class="field-style field-split" required>
                        <option selected hidden value="">Pilih</option>
                        <option value="SURVEY OK">SURVEY OK</option>
                        <option value="SURVEY NOK">SURVEY NOK</option>
                    </select>
                    <label>Nama ODP:</label>
                    <input type="text" name="namaodp" class="form-grup">
                    <label>Status UT:</label>
                    <input type="date" name="sut" class="form-grup" style="width: 50%; border-radius: 8px;border:none;height: 25px;" readonly>
				  </div>
				  <div class="column" style="">
				    <label>Nama Project:</label>
                    <select name="nproject" class="field-style field-split" required>
                        <option selected hidden value="">Pilih</option>
                        <option value="FTTH">FTTH</option>
                        <option value="WIFI">WIFI</option>
                        <option value="PT2">PT2</option>
                        <option value="HEM">HEM</option>
                        <option value="NODB">NODB</option>
                        <option value="OLO">OLO</option>
                        <option value="QE">QE</option>
                    </select>
                    <label>Status Pekerjaan Fisik:</label>
                    <select name="spfisik" class="field-style field-split" required>
                        <option selected hidden value="">Pilih</option>
                        <option value="OGP">OGP</option>
                        <option value="Closed">Closed</option>
                    </select>

                    <label>Keterangan:</label>
                    <textarea type="text" name="keterangan" class="field-style textarea" placeholder=""></textarea>
				  </div>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
    	</div>
    </div>
</body>
</html>          