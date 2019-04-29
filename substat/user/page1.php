<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="user"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pengajuan | SIMPRO</title>
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
	<link rel="stylesheet" type="text/css" href="../../css/user.css">
</head>
<script type="text/javascript">
function confirm_delete() {
  return confirm('Apakah anda yakin?');
}
function showpassword() {
var x = document.getElementById("pass");
	if (x.type == "pass") {
	    x.type = "text";
	} else {
	    x.type = "pass";
	}
}
</script>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="user.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>
		</div>
      	<div class="logout">
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')" style="border: none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page2.php" class=""><h4><strong>Report</strong></h4></a>
      		<a href="page1.php" class="pageactive"><h4><strong>Pengajuan</strong></h4></a>
          	</div>
      	</div>
    </div>
    <div class="container">
    	<div class="content">
    		<div class="headregister">
    			<label>Pengajuan Alat Produksi</label>
    		</div>
    		<div class="form">
    			<form method="post" id="regist" class="form-style2"> 
                   <div class="column" style="">
                    <label for="witel">WITEL</label>
                        <select name="witel" id="witel" required>
                            <option selected hidden value="">Pilih</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Bandung Barat"> Bandung Barat</option>
                            <option value="Karawang">Karawang</option>
                            <option value="Sukabumi">Sukabumi</option>
                            <option value="Tasikmalaya">Tasikmalaya</option>
                        </select>
                   	<label>HS/DATEL:</label>
                   	<select name="hsdatel" required>
               			<option selected hidden value="">Pilih</option>
                        <option value="HS1">HS1</option>
                        <option value="HS2">HS2</option>
                        <option value="HS3">HS3</option>
                        <option value="Datel Sumedang">Datel Sumedang</option>
                   	</select>
                    <label align="center" style="margin-top: 5%;margin-bottom: 0;">KOORDINAT</label>
                    <div class="form-grup col-md-6" style="padding: 0px;margin:0px;">
                        <label for="long" align="center">Longitude:</label>
                        <input type="text" name="long" placeholder="(Longitude)" id="long" class="form-control" style="width: 98%;" required>
                    </div>
                    <div class="form-grup col-md-6" style="padding: 0px;margin:0px;">
                        <label for="lat" align="center">Latitude:</label>
                        <input type="text" name="lat" placeholder="(Latitude)" id="lat" class="form-control" style="width: 100%;" pattern="-.+" title="Missing '-' char" required>
                    </div>
                    
                   	<div class="form-grup col-md-6" style="padding: 0px;margin:0px;">
                        <label for="unsc">Nomor UNSC:</label>
                        <input type="text" placeholder="Optional" name="unsc" id="unsc" class="form-control" style="width: 98%;">
                    </div>
                    <div class="form-grup col-md-6" style="padding: 0px;margin:0px;">
                        <label for="jodp">Jumlah ODP:</label>
                        <input type="number" placeholder="Jumlah ODP" name="jml" id="jodp" class="form-control" style="width: 100%;" required>
                    </div>

				  </div>
				  <div class="column" style="">
				    <label> STO: </label>
                    <select name="sto" class="field-style" required>
                        <option selected hidden="status">Pilih</option>
                        <option value="CCD">CCD</option>
                        <option value="LBG">LBG</option>
                        <option value="DGO">DGO</option>
                        <option value="HGH">HGH</option>
                        <option value="GGK">GGK</option>
                        <option value="TRG">TRG</option>
                        <option value="KPO">KPO</option>
                        <option value="TLE">TLE</option>
                        <option value="CJA">CJA</option>
                        <option value="UBR">UBR</option>
                        <option value="SMD">SMD</option>
                        <option value="TAS">TAS</option>
                    </select><label>Alamat:</label>
                    <textarea type="text" name="alamat" class="field-style textarea" placeholder="Masukkan alamat" required></textarea>
                    <label>Keterangan:</label>
                    <textarea type="text" name="keterangan" class="field-style textarea" placeholder="" required></textarea>
				  </div>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
    	</div>
    </div>
</body>
</html>          
<?php
	if (isset($_POST['submit'])) {
		$query = "SELECT max(idproject) as maxId FROM pengajuan";
		$result1 = mysqli_query($conn,$query)or die("Error: " . mysqli_error($conn));
		$data = mysqli_fetch_array($result1);
		$idproject = $data['maxId'];
		   
		$noId = (int) substr($idproject, 3, 3);
		$noId++;

		$char = "PRJ";

	    $localzone = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
	    $date      = $localzone->format('d/m/y, h:i:s');
	    $idproject     = $char . sprintf("%03s", $noId);
        $witel         = $_POST['witel'];
	    $hsdatel       = $_POST['hsdatel'];
	    $sto           = $_POST['sto'];
	    $nama          = $_SESSION['nama'];
	    $alamat        = $_POST['alamat'];
	    $long          = $_POST['long'];
	    $lat           = $_POST['lat'];
	    $jml           = $_POST['jml'];
	    $unsc          = $_POST['unsc'];
	    $keterangan    = $_POST['keterangan'];
		$sql      = "INSERT INTO pengajuan(`tanggalinput`,`idproject`,`witel`,`infohs`,`infosto`,`nama_user`,`alamat`,`koorlong`,`koorlati`,`jodp`,`nounsc`,`keterangan`) VALUES ('$date','$idproject','$witel','$hsdatel','$sto','$nama','$alamat','$long','$lat','$jml','$unsc','$keterangan');";
		$result   = mysqli_query($conn,$sql);
        $sql2     = "INSERT INTO daftar_order(nama_user,idproject)VALUES('$nama','$idproject')";
        $result2  = mysqli_query($conn,$sql2);
            if($result){
                echo "<script>alert('berhasil');window.location.href='page1.php';</script>";
                require_once('../../PHPMailer/PHPMailerAutoload.php');
                $query = "SELECT * FROM user where status='optima'";
                $result = mysqli_query($conn, $query);
                while ($data=mysqli_fetch_assoc($result)) {
                    $receiver=$data['email'];
                }
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->isHTML();
                $mail->Username = 'optimawb@gmail.com';
                $mail->Password = 'optimawb2018';
                $mail->SetFrom ('no-reply@telkom.com');
                $mail->Subject = '(SIMPRO) Ada permintaan alpro baru dari user!';
                $mail->Body =   '<HTML>
                                    <head>
                                        <meta http-equiv="Content-Type" content="text/html;charset="utf-8"/>
                                    </head>
                                    <body>
                                    </table><br>
                                        <<h2>Permintaan ALPRO dari user</h2>
                                        <table border="1">
                                            <tr>
                                                <th>Waktu Input</th>
                                                <th>ID Project</th>
                                                <th>Witel</th>
                                                <th>HS/Datel</th>
                                                <th>STO</th>
                                                <th>Nama User</th>
                                                <th>Alamat Lokasi</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th>Jumlah ODP</th>
                                                <th>No. UNSC</th>
                                                <th>Keterangan</th>
                                            </tr>
                                            <tr>
                                                <td>'.$date.'</td>
                                                <td>'.$idproject.'</td>
                                                <th>'.$witel.'</td>
                                                <td>'.$hsdatel.'</td>
                                                <td>'.$sto.'</td>
                                                <td>'.$nama.'</td>
                                                <td>'.$alamat.'</td>
                                                <td>'.$long.'</td>
                                                <td>'.$lat.'</td>
                                                <td>'.$jml.'</td>
                                                <td>'.$unsc.'</td>
                                                <td>'.$keterangan.'</td>
                                            </tr>
                                        </table>
                                    </body>
                                </HTML>';
                $mail->AddAddress(''.$receiver.'');
                $mail->Send();
            }else{
                echo mysql_errno($conn) . ": " . mysql_error($conn). "\n";
            }  
    }
?>                      		                            
